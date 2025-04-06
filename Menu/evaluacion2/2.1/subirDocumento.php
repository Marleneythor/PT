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
    $targetDir = "../../../docentes/" . $curp . "/2/2.1/" . $customText;

    // Crear la carpeta si no existe
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
    
        // Generar nombre base del archivo
        $baseFileName = "{$apellidoPaterno}_{$apellidoMaterno}_{$customText}";
        
        // Crear un nombre único de archivo incrementando el número si ya existe el archivo
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

   // if ($customText == "1.4.1" && isset($_FILES['file1']) && isset($_FILES['file2'])) {
    if (
        ($customText == "2.1.1.1" || $customText == "2.1.1.2" || $customText == "2.1.1.3") &&
        isset($_FILES['file1']) &&
        isset($_FILES['file2'])
    ) {
        // Subir file1 y file2 y crear un ZIP
        $file1Path = validarYSubirArchivo('file1', $targetDir, $apellidoPaterno, $apellidoMaterno, $customText . "_1");
        $file2Path = validarYSubirArchivo('file2', $targetDir, $apellidoPaterno, $apellidoMaterno, $customText . "_2");

        if ($file1Path && $file2Path) {
            // Generar nombre base para el archivo ZIP
            $baseZipFileName = "{$apellidoPaterno}_{$apellidoMaterno}_{$customText}";
            
            // Crear un nombre único para el archivo ZIP incrementando el número si ya existe
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
    } elseif (
            ($customText == "2.1.1.4" || $customText == "2.1.2.1") &&
            isset($_FILES['file5']) &&
            isset($_FILES['file4'])&&
            isset($_FILES['file3'])
        ) {
            // Subir file1 y file2 y crear un ZIP
            $file5Path = validarYSubirArchivo('file5', $targetDir, $apellidoPaterno, $apellidoMaterno, $customText . "_1");
            $file4Path = validarYSubirArchivo('file4', $targetDir, $apellidoPaterno, $apellidoMaterno, $customText . "_2");
            $file3Path = validarYSubirArchivo('file3', $targetDir, $apellidoPaterno, $apellidoMaterno, $customText . "_3");
    
            if ($file5Path && $file4Path && $file3Path) {
                $baseZipFileName = "{$apellidoPaterno}_{$apellidoMaterno}_{$customText}";
                
                $n = 1;
                do {
                    $zipFileName = "$targetDir/{$baseZipFileName}_{$n}.zip";
                    $n++;
                } while (file_exists($zipFileName));
    
                $zip = new ZipArchive();
    
                if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
                    $zip->addFile($file5Path, basename($file5Path));
                    $zip->addFile($file4Path, basename($file4Path));
                    $zip->addFile($file3Path, basename($file3Path));
                    $zip->close();
    
                    // Eliminar los archivos originales después de comprimir
                    unlink($file5Path);
                    unlink($file4Path);
                    unlink($file3Path);
    
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
            $opcion6 = $_POST['opcion6'] ?? '';
            $opcion7 = $_POST['opcion7'] ?? '';
            $calcular3 = (int) ($_POST['calcular3'] ?? 0);
            $calcular4 = (int) ($_POST['calcular4'] ?? 0);
            $calcular6 = (int) ($_POST['calcular6'] ?? 0);
            $calcular7 = (int) ($_POST['calcular7'] ?? 0);
            $calcular2 = (int) ($_POST['calcular2'] ?? 0);

            if ($customText === '2.1.1.1') {
                $opciones_1_4_3 = [
                    '2.1.1.1.1.1' => 80,
                    '2.1.1.1.1.2' => 40,
                    '2.1.1.1.2.1' => 100,
                    '2.1.1.1.2.2' => 50,
                ];
                $puntosporactividad = $opciones_1_4_3 [$opcion1] ?? 0;
                $nivelSeleccionado = $opcion1;

            } elseif ($customText === '2.1.1.2') {
                $opciones_1_4_7 = [
                    '2.1.1.2.1.1' => $calcular2 * 30,
                    '2.1.1.2.1.2' => $calcular2 * 15,
                    '2.1.1.2.2.1' => $calcular2 * 40,
                    '2.1.1.2.2.2' => $calcular2 * 20,
                ];
                $puntosporactividad = $opciones_1_4_7 [$opcion2] ?? 0;
                $nivelSeleccionado = $opcion2;  

            } elseif ($customText === '2.1.3') {
                $opciones_1_4_8_1 = [
                    '2.1.1.3.1.1' => $calcular3 * 10,
                    '2.1.1.3.1.2' => $calcular3 * 5,
                    '2.1.1.3.2.1' =>  20,
                    '2.1.1.3.2.2' =>  10,
                ];
                $puntosporactividad = $opciones_1_4_8_1 [$opcion3] ?? 0;
                $nivelSeleccionado = $opcion3; 
            
            } elseif ($customText === '2.1.1.4') {
                $opciones_1_4_9 = [
                    '2.1.1.4.1' => 120,
                    '2.1.1.4.2.1' => $calcular4 * 10,
                    '2.1.1.4.2.2' => $calcular4 * 5,
                ];
                $puntosporactividad = $opciones_1_4_9 [$opcion4] ?? 0;
                $nivelSeleccionado = $opcion4; 
            }elseif ($customText === '2.1.1.5') {
                $opciones_1_4_9 = [
                    '2.1.1.5.1.1' => 40,
                    '2.1.1.5.1.2' =>  15,
                    '2.1.1.5.2.1' =>  40,
                    '2.1.1.5.2.2' =>  15,
                ];
                $puntosporactividad = $opciones_1_4_9 [$opcion5] ?? 0;
                $nivelSeleccionado = $opcion5; 
            } elseif ($customText === '2.1.2.1') {
                $opciones_1_4_9 = [
                    '2.1.2.1.1' => $calcular6 * 2.5,
                    '2.1.2.1.2' =>  $calcular6 * 3.33,
                    '2.1.2.1.3' =>  $calcular6 * 4.16,
                ];
                $puntosporactividad = $opciones_1_4_9 [$opcion6] ?? 0;
                $nivelSeleccionado = $opcion6;        
            } elseif ($customText === '2.1.2.2') {
                $opciones_1_4_9 = [
                    '2.1.2.2.1' => $calcular7 * 2.5,
                    '2.1.2.2.2' =>  $calcular7 * 3.33,
                    '2.1.2.2.3' =>  $calcular7 * 4.16,
                ];
                $puntosporactividad = $opciones_1_4_9 [$opcion7] ?? 0;
                $nivelSeleccionado = $opcion7;      
        } else {
            $puntosPuntos = [
                '1.4.8.2' => 25,
                '1.4.8.3' => $calculo8_3 * 10,
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
