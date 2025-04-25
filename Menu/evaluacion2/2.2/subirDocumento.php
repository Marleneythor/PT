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
        $targetDir = "../../../docentes/" . $curp . "/2/2.2/" . $customText;
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        $allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        $maxFileSize = 500 * 1024; // 500 KB

        if (!in_array($fileExtension, $allowedTypes)) {
            exit("Error: Solo se permiten archivos PDF, Word o imágenes.");
        }

        if ($_FILES['file']['size'] > $maxFileSize) {
            exit("Error: El tamaño del archivo no debe exceder los 500 KB.");
        }

        $n = 1;
        do {
            $newFileName = "{$apellidoPaterno}_{$apellidoMaterno}_{$customText}_{$n}.{$fileExtension}";
            $targetFilePath = "$targetDir/$newFileName";
            $n++;
        } while (file_exists($targetFilePath));
        
        $puntosporactividad = 0;

        if (isset($customText)) {
            $calculo1 = (int) ($_POST['calculo1'] ?? 0);
            $calculo2 = (int) ($_POST['calculo2'] ?? 0);
            $opcion = $_POST['opcion'] ?? '';
            $calculo3 = (int) ($_POST['calculo3'] ?? 0);
           
           if ($customText === 'x') {
                $opciones = [
                    '2.2.2' => $calculo3 * 40,
                    '2.2.3' => $calculo3 * 40,
                    '2.2.4' => $calculo3 * 40,
                    '2.2.5' => $calculo3 * 40,
                    '2.2.6' => $calculo3 * 10,
                ];
                $puntosporactividad = $opciones [$opcion] ?? 0;
                $nivelSeleccionado = $opcion; 
           
            } else {
                $puntosPuntos = [
                    '2.2.7' => 10,
                    '2.2.9' => 50,
                    '2.2.10' => 40,
                    '2.2.1' => $calculo1 * 10,
                    '2.2.8' => $calculo2 * 30,
                ];
                if (isset($puntosPuntos[$customText])) {
                    $puntosporactividad = $puntosPuntos[$customText];
                }
            }
        }

        $idActividad = 1;
        $fechaSubida = date("Y-m-d");
        $categoria = "CategoriaEjemplo";
        $tipoDocumento = "Constancia";
        
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
