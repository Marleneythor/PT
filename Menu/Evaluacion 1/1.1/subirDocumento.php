<?php
session_start();
include "../../../conexion/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    
    // Obtener CURP, ID del docente, ApellidoPaterno y ApellidoMaterno
    $stmt = $conexion->prepare("SELECT CURP, id_docente, ApellidoPaterno, ApellidoMaterno FROM docentes WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($curp, $idDocente, $apellidoPaterno, $apellidoMaterno);
    $stmt->fetch();
    $stmt->close();
    
    if ($curp && $idDocente) {
        $customText = $_POST['document_type'] ?? '';
        $targetDir = "../../../docentes/" . $curp . "/1/1.1/" . $customText;
        // Crear la carpeta si no existe
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Validaciones del archivo
        $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        $allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        $maxFileSize = 500 * 1024; // 500 KB

        if (!in_array($fileExtension, $allowedTypes)) {
            exit("Error: Solo se permiten archivos PDF, Word o imágenes.");
        }

        if ($_FILES['file']['size'] > $maxFileSize) {
            exit("Error: El tamaño del archivo no debe exceder los 500 KB.");
        }

        // Generar nombre de archivo único utilizando ApellidoPaterno y ApellidoMaterno
        $n = 1;
        do {
            $newFileName = "{$apellidoPaterno}_{$apellidoMaterno}_{$customText}_{$n}.{$fileExtension}";
            $targetFilePath = "$targetDir/$newFileName";
            $n++;
        } while (file_exists($targetFilePath));
        
        $puntosporactividad = 0;

        if ($customText === '1.1.4' || $customText === '1.1.5') {
            $nivelEstudiantes = $_POST['nivel_estudiantes'] ?? '';
            $numEstudiantes = (int) ($_POST['num_estudiantes'] ?? 0);
            $num_estudiantes_1_1_5 = (int) ($_POST['num_estudiantes_1_1_5'] ?? 0);

            if ($customText === '1.1.5') {
                $puntosporactividad = $num_estudiantes_1_1_5; // 1 punto por estudiante
            } elseif ($nivelEstudiantes === 'licenciatura') {
                $puntosporactividad = ($numEstudiantes *50 )/200; // 2 puntos por estudiante
            } elseif ($nivelEstudiantes === 'posgrado') {
                $puntosporactividad = $numEstudiantes; // 3 puntos por estudiante
            }
        } else {
            // Puntos predeterminados para otros tipos de documento
            $puntosPuntos = [
                '1.1.1' => 5,
                '1.1.2' => 10,
                '1.1.3' => 5,
                '1.1.6' => 10,
                '1.1.7' => 10,
            ];
            
            if (isset($puntosPuntos[$customText])) {
                $puntosporactividad = $puntosPuntos[$customText];
            }
        }

        // Datos para la base de datos
        $idActividad = 1;
        $fechaSubida = date("Y-m-d");
        $categoria = "CategoriaEjemplo";
        $tipoDocumento = "Constancia";
        
        // Mover el archivo y registrar en BD
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissssssi", $idDocente, $idActividad, $newFileName, $targetFilePath, $fechaSubida, $categoria, $tipoDocumento, $customText, $puntosporactividad);

            if ($stmt->execute()) {
                echo "El archivo ha sido subido y registrado exitosamente.";
                echo "<script>history.back();</script>";
            } else {
                echo "Error al registrar el documento: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al subir el archivo.";
        }
    } else {
        echo "Error: No se encontró el CURP o ID del docente.";
    }
} else {
    echo "Error: No se ha recibido un archivo o el usuario no ha iniciado sesión.";
}

$conexion->close();
?>
