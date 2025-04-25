<?php
session_start();
include "../../../conexion/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];

    // Obtener información del docente
    $stmt = $conexion->prepare("SELECT CURP, id_docente, ApellidoPaterno, ApellidoMaterno FROM docentes WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($curp, $idDocente, $apellidoPaterno, $apellidoMaterno);
    $stmt->fetch();
    $stmt->close();

    if (!$curp || !$idDocente) {
        exit("Error: No se encontró la información del docente.");
    }

    $customText = $_POST['document_type'] ?? '';
    $targetDir = "../../../docentes/" . $curp . "/2/2.3/" . $customText;

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
    $maxFileSize = 500 * 1024; // 500 KB

    function validarYSubirArchivo($fileInput, $targetDir, $apellidoPaterno, $apellidoMaterno, $customText) {
        global $allowedTypes, $maxFileSize;
        
        if (!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
    
        $fileTmpPath = $_FILES[$fileInput]['tmp_name'];
        $fileName = $_FILES[$fileInput]['name'];
        $fileSize = $_FILES[$fileInput]['size'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        if (!in_array($fileExtension, $allowedTypes)) {
            exit("Error: Tipo de archivo no permitido.");
        }
    
        if ($fileSize > $maxFileSize) {
            exit("Error: El tamaño del archivo excede los 500 KB.");
        }
    
        $baseFileName = "{$apellidoPaterno}_{$apellidoMaterno}_{$customText}";
        
        $n = 1;
        do {
            $newFileName = "{$baseFileName}_{$n}.{$fileExtension}";
            $targetFilePath = "$targetDir/$newFileName";
            $n++;
        } while (file_exists($targetFilePath));
    
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            return $targetFilePath;
        } else {
            return null;
        }
    }
    

    $archivoFinal = null;
    if (
        ($customText == "2.3.7.1" || $customText == "2.3.7.2" || $customText == "2.3.7.3"|| $customText == "2.3.7.4") &&
        isset($_FILES['file1']) &&
        isset($_FILES['file2'])
    ) {
        // Subir file1 y file2 y crear un ZIP
        $file1Path = validarYSubirArchivo('file1', $targetDir, $apellidoPaterno, $apellidoMaterno, $customText . "_1");
        $file2Path = validarYSubirArchivo('file2', $targetDir, $apellidoPaterno, $apellidoMaterno, $customText . "_2");

        if ($file1Path && $file2Path) {
            $baseZipFileName = "{$apellidoPaterno}_{$apellidoMaterno}_{$customText}";
            
            $n = 1;
            do {
                $zipFileName = "$targetDir/{$baseZipFileName}_{$n}.zip";
                $n++;
            } while (file_exists($zipFileName));

            // Crear el archivo ZIP
            $zip = new ZipArchive();

            if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->addFile($file1Path, basename($file1Path));
                $zip->addFile($file2Path, basename($file2Path));
                $zip->close();

                // Eliminar los archivos originales después de comprimir
                unlink($file1Path);
                unlink($file2Path);

                $archivoFinal = $zipFileName;
            } else {
                exit("Error al crear el archivo ZIP.");
            }
        }
    } elseif (isset($_FILES['file'])) {
        // Subir solo un archivo si no es 1.4.1
        $archivoFinal = validarYSubirArchivo('file', $targetDir, $apellidoPaterno, $apellidoMaterno, $customText);
    }

    $puntosporactividad = 0;
        
        if (isset($customText)) {
            $opcion1 = $_POST['opcion1'] ?? '';
            $opcion2 = $_POST['opcion2'] ?? '';
            $opcion3 = $_POST['opcion3'] ?? '';
            $opcion4 = $_POST['opcion4'] ?? '';
            $opcion5 = $_POST['opcion5'] ?? '';
            $calculo3 = (int) ($_POST['calculo3'] ?? 0);
            $calculo2 = (int) ($_POST['calculo2'] ?? 0);
            $calculo = (int) ($_POST['calculo'] ?? 0);

          if ($customText === '2.3.2') {
                $opciones_1_4_2 = [
                    '2.3.2.1' => 10,
                    '2.3.2.2' => 15,
                    '2.3.2.3' => 20,
                ];
                $puntosporactividad = $opciones_1_4_2 [$opcion1] ?? 0;
                $nivelSeleccionado = $opcion1;

            } elseif ($customText === '2.3.3') {
                $opciones_1_4_3 = [
                    '2.3.3.1' => $calculo2 * 10,
                    '2.3.3.2' => $calculo2 * 15,
                    '2.3.3.3' => $calculo2 * 20,
                    '2.3.3.4' => 30,
                    '2.3.3.5' => 35,
                    '2.3.3.6' => 40,
                ];
                $puntosporactividad = $opciones_1_4_3 [$opcion2] ?? 0;
                $nivelSeleccionado = $opcion2;

            } elseif ($customText === '2.3.5.1') {
                $opciones_1_4_4 = [
                    '2.3.5.1.1' => $calculo3 * 15,
                    '2.3.5.1.2' => $calculo3 * 10,
                    '2.3.5.1.3' => $calculo3 * 20,
                ];
                $puntosporactividad = $opciones_1_4_4 [$opcion3] ?? 0;
                $nivelSeleccionado = $opcion3;

            } elseif ($customText === '2.3.7.1') {
                $opciones_1_4_5 = [
                    '2.3.7.1.1' => 20,
                    '2.3.7.1.2' => 20,
                    '2.3.7.1.3' => 20,
                    '2.3.7.1.4' => 20,
                    '2.3.7.1.5' => 20,
                    '2.3.7.1.6' => 20,
                    '2.3.7.1.7' => 20,
                    '2.3.7.1.8' => 20,
                ];
                $puntosporactividad = $opciones_1_4_5 [$opcion4] ?? 0;
                $nivelSeleccionado = $opcion4;  
                
            } elseif ($customText === '2.3.7.2') {
                $opciones_1_4_5 = [
                    '2.3.7.2.1' => 20,
                    '2.3.7.2.2' => 20,
                    '2.3.7.2.3' => 20,
                    '2.3.7.2.4' => 20,
                    '2.3.7.2.5' => 20,
                ];
                $puntosporactividad = $opciones_1_4_6 [$opcion5] ?? 0;
                $nivelSeleccionado = $opcion5; 
        } else {
            $puntosPuntos = [
                '2.3.1.1' => $calculo * 10,
                '2.3.1.2' => 20,
                '2.3.4.1' => $calculo * 10,
                '2.3.4.2' => $calculo * 20,
                '2.3.4.3' => $calculo * 20,
                '2.3.6.1' => 20,
                '2.3.6.2' => 30,
                '2.3.7.3' => 20,
                '2.3.7.4' => 20,
            ];
            
            if (isset($puntosPuntos[$customText])) {
                $puntosporactividad = $puntosPuntos[$customText];
            }
        }
    }


    if ($archivoFinal) {
        $idActividad = 1;
        $fechaSubida = date("Y-m-d");
        $categoria = "CategoriaEjemplo";
        $tipoDocumento = "Constancia";

        $rutaArchivo = $archivoFinal;
        $nombreArchivo = basename($archivoFinal);

        // Insertar en la base de datos
        $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissssssis", 
            $idDocente, 
            $idActividad, 
            $nombreArchivo, 
            $rutaArchivo, 
            $fechaSubida, 
            $categoria, 
            $tipoDocumento, 
            $customText, 
            $puntosporactividad, 
            $nivelSeleccionado
        );
        if ($stmt->execute()) {
            // Mensaje de éxito y recarga de página
            echo "El archivo ha sido subido y registrado exitosamente."; 
            echo "<script>history.back();</script>";
                 
        } else {
            // Mensaje de error y recarga de página
            echo "<script>
                    alert('Error al registrar el archivo: " . $stmt->error . "');
                   // window.location.reload();  // Recarga la página
                  </script>";
        }
    
        $stmt->close();
    } else {
        // Mensaje de error si no se subió ningún archivo y recarga de página
        echo "<script>
                alert('Error: No se pudo subir ningún archivo');
               // window.location.reload();  // Recarga la página
              </script>";
    }

} else {
    echo "Error: No se ha recibido un archivo o el usuario no ha iniciado sesión.";
}

$conexion->close();
?>
