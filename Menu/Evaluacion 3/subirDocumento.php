<?php
session_start();
include "../../conexion/conexion.php";

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
        $targetDir = "../../../docentes/" . $curp . "/1/1.3/" . $customText;
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

        if (isset($customText)) {
            $calculo1 = (int) ($_POST['calculo1'] ?? 0);
            $calculo3 = (int) ($_POST['calculo3'] ?? 0);
            $calculo4 = (int) ($_POST['calculo4'] ?? 0);
            $calculo5 = (int) ($_POST['calculo5'] ?? 0);
            $opcion_1 = $_POST['opcion_1'] ?? '';
            $opcion_2 = $_POST['opcion_2'] ?? '';
            $opcion_3 = $_POST['opcion_3'] ?? '';
            $opcion_4 = $_POST['opcion_4'] ?? '';
            $opcion_5 = $_POST['opcion_5'] ?? '';

            if ($customText === '3.1.1') {
                $nivelesPosgrado = [
                    '3.1.1.1' => $calculo1 * 10,
                    '3.1.1.2' => $calculo1 * 15, 
                ];
                $puntosporactividad = $nivelesPosgrado[$opcion_1] ?? 0;
                $nivelSeleccionado = $opcion_1;
            } elseif ($customText === '3.1.2') {
                $nivelesAcademico = [
                    '3.1.2.1' =>  40,
                    '3.1.2.2' =>  40, 
                ];
                $puntosporactividad = $nivelesAcademico[$opcion_2] ?? 0;
                $nivelSeleccionado = $opcion_2;
            } elseif ($customText === '3.2.1') {
                $nivelesAcademico = [
                    '3.2.1.1' => $calculo3 * 30,
                    '3.2.1.2' => $calculo3 * 20, 
                ];
                $puntosporactividad = $nivelesAcademico[$opcion_3] ?? 0;
                $nivelSeleccionado = $opcion_3;
            } elseif ($customText === '3.2.2') {
                $nivelesAcademico = [
                    '3.2.1.1' => $calculo4 * 5,
                    '3.2.1.2' => $calculo4 * 5, 
                ];
                $puntosporactividad = $nivelesAcademico[$opcion_4] ?? 0;
                $nivelSeleccionado = $opcion_4;
            } elseif ($customText === '3.3') {
                $nivelesAcademico = [
                    '3.3.1' => $calculo5 * 1.67,
                    '3.3.2' => $calculo5 * 1.67,
                    '3.3.3' => $calculo5 * 1.67,
                    '3.3.4' => $calculo5 * 3.33,
                    '3.3.5' => $calculo5 * 3.33,
                    '3.3.6' => $calculo5 * 5,
                    '3.3.7' => $calculo5 * 6.67,
                ];
                $puntosporactividad = $nivelesAcademico[$opcion_5] ?? 0;
                $nivelSeleccionado = $opcion_5;
            } else {
                $puntosPuntos = [
                    '3.1.3' => 50,
                ];
                if (isset($puntosPuntos[$customText])) {
                    $puntosporactividad = $puntosPuntos[$customText];
                }
            }
        }

        // Datos para la base de datos
        $idActividad = 1;
        $fechaSubida = date("Y-m-d");
        $categoria = "CategoriaEjemplo";
        $tipoDocumento = "Constancia";
        
        // Mover el archivo y registrar en BD
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissssssis", $idDocente, $idActividad, $newFileName, $targetFilePath, $fechaSubida, $categoria, $tipoDocumento, $customText, $puntosporactividad, $nivelSeleccionado);

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
