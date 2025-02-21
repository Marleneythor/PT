<?php
session_start();
include "../../../conexion/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    
    // Obtener CURP e ID del docente
    $stmt = $conexion->prepare("SELECT CURP, id_docente FROM docentes WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($curp, $idDocente);
    $stmt->fetch();
    $stmt->close();
    
    if ($curp && $idDocente) {
        $customText = $_POST['document_type'] ?? '';
        $targetDir = "../../../docentes/" . $curp . "/1/1.3/" . $customText . "/";
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

        // Generar nombre de archivo único
        $n = 1;
        do {
            $newFileName = "{$curp}_{$customText}_{$n}.{$fileExtension}";
            $targetFilePath = "$targetDir/$newFileName";
            $n++;
        } while (file_exists($targetFilePath));
        
        $puntosporactividad = 0;

        if ($customText === '1.3.1' || $customText === '1.3.2') {
            $nivel_Posgrado = $_POST['nivel_posgrado'] ?? '';
            $nivel_academico = $_POST['nivel_academico'] ?? '';
            
            if ($customText === '1.3.1') {
                $nivelesPosgrado = [
                    'licenciatura' => 20,
                    'Especialización' => 25,
                    'Maestria' => 40,
                    'Maestria.Co-Director' => 30,
                    'Doctorado' => 50,
                    'Doctorado.Co-Director' => 40,
                ];
                
                // Asigna el valor correspondiente según el nivel seleccionado
                $puntosporactividad = $nivelesPosgrado[$nivel_Posgrado] ?? 0; // Si el nivel no existe, asigna 0 puntos
            } elseif ($customText === '1.3.2') {
                $nivelesAcademico = [
                    'TecnicoSuperior' => 5,
                    'licenciatura' => 10,
                    'Especialización' => 15,
                    'Maestria' => 15,
                    'Doctorado' => 30,
                ];
                
                // Asigna el valor correspondiente según el nivel seleccionado
                $puntosporactividad = $nivelesAcademico[$nivel_academico] ?? 0; // Si el nivel no existe, asigna 0 puntos
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