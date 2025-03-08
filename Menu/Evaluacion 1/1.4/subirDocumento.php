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
    $targetDir = "../../../docentes/" . $curp . "/1/1.4/" . $customText;

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
        ($customText == "1.4.1" || $customText == "1.4.3" || $customText == "1.4.8.3") &&
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
    } elseif (isset($_FILES['file'])) {
        // Subir solo un archivo si no es 1.4.1
        $archivoFinal = validarYSubirArchivo('file', $targetDir, $apellidoPaterno, $apellidoMaterno, $customText);
    }

    $puntosporactividad = 0;
        
        if (isset($customText)) {
            $num_estudiantes_1_4_1 = (int) ($_POST['num_estudiantes_1_4_1'] ?? 0);
            $opcion_1_4_2 = $_POST['opcion_1_4_2'] ?? '';
            $opcion_1_4_3 = $_POST['opcion_1_4_3'] ?? '';
            $opcion_1_4_4 = $_POST['opcion_1_4_4'] ?? '';
            $opcion_1_4_5 = $_POST['opcion_1_4_5'] ?? '';
            $opcion_1_4_6 = $_POST['opcion_1_4_6'] ?? '';
            $opcion_1_4_7 = $_POST['opcion_1_4_7'] ?? '';
            $opcion_1_4_8_1 = $_POST['opcion_1_4_8_1'] ?? '';
            $opcion_1_4_9 = $_POST['opcion_1_4_9'] ?? '';
            $calculo3 = (int) ($_POST['calculo3'] ?? 0);
            $calculo4 = (int) ($_POST['calculo4'] ?? 0);
            $calculo5 = (int) ($_POST['calculo5'] ?? 0);
            $calculo6 = (int) ($_POST['calculo6'] ?? 0);
            $calculo7 = (int) ($_POST['calculo7'] ?? 0);
            $calculo8 = (int) ($_POST['calculo8'] ?? 0);
            $calculo8_3 = (int) ($_POST['calculo8_3'] ?? 0);

            if ($customText === '1.4.1') {
                $puntosporactividad = ($num_estudiantes_1_4_1)*3; 

            } elseif ($customText === '1.4.2') {
                $opciones_1_4_2 = [
                    '1.4.2.1' => 10,
                    '1.4.2.2' => 15,
                    '1.4.2.3' => 20,
                ];
                $puntosporactividad = $opciones_1_4_2 [$opcion_1_4_2] ?? 0;
                $nivelSeleccionado = $opcion_1_4_2;

            } elseif ($customText === '1.4.3') {
                $opciones_1_4_3 = [
                    '1.4.3.1' => $calculo3 * 10,
                    '1.4.3.2' => $calculo3 * 15,
                    '1.4.3.3' => $calculo3 * 20,
                    '1.4.3.4' => $calculo3 * 30,
                    '1.4.3.5' => $calculo3 * 35,
                    '1.4.3.6' => $calculo3 * 40,
                ];
                $puntosporactividad = $opciones_1_4_3 [$opcion_1_4_3] ?? 0;
                $nivelSeleccionado = $opcion_1_4_3;

            } elseif ($customText === '1.4.4') {
                $opciones_1_4_4 = [
                    '1.4.4.1' => $calculo4 * 10,
                    '1.4.4.2' => $calculo4 * 15,
                    '1.4.4.3' => $calculo4 * 20,
                    '1.4.4.4' => $calculo4 * 5,
                    '1.4.4.5' => $calculo4 * 10,
                    '1.4.4.6' => $calculo4 * 15,
                    '1.4.4.7' => $calculo4 * 3,
                    '1.4.4.8' => $calculo4 * 5,
                    '1.4.4.9' => $calculo4 * 8,
                ];
                $puntosporactividad = $opciones_1_4_4 [$opcion_1_4_4] ?? 0;
                $nivelSeleccionado = $opcion_1_4_4;

            } elseif ($customText === '1.4.5') {
                $opciones_1_4_5 = [
                    '1.4.5.1' => $calculo5 * 10,
                    '1.4.5.2' => $calculo5 * 15,
                    '1.4.5.3' => $calculo5 * 20,
                    '1.4.5.4' => $calculo5 * 5,
                ];
                $puntosporactividad = $opciones_1_4_5 [$opcion_1_4_5] ?? 0;
                $nivelSeleccionado = $opcion_1_4_5;  
                
            } elseif ($customText === '1.4.6') {
                $opciones_1_4_6 = [
                    '1.4.6.1' => $calculo6 * 10,
                    '1.4.6.2' => $calculo6 * 15,
                    '1.4.6.3' => $calculo6 * 30,
                ];
                $puntosporactividad = $opciones_1_4_6 [$opcion_1_4_6] ?? 0;
                $nivelSeleccionado = $opcion_1_4_6; 

            } elseif ($customText === '1.4.7') {
                $opciones_1_4_7 = [
                    '1.4.7.1' => $calculo7 * 10,
                    '1.4.7.2' => $calculo7 * 15,
                    '1.4.7.3' => $calculo7 * 15,
                    '1.4.7.4' => $calculo7 * 20,
                ];
                $puntosporactividad = $opciones_1_4_7 [$opcion_1_4_7] ?? 0;
                $nivelSeleccionado = $opcion_1_4_7;  

            } elseif ($customText === '1.4.8.1') {
                $opciones_1_4_8_1 = [
                    '1.4.8.1.1' => $calculo8 * 20,
                    '1.4.8.1.2' => $calculo8 * 30,
                ];
                $puntosporactividad = $opciones_1_4_8_1 [$opcion_1_4_8_1] ?? 0;
                $nivelSeleccionado = $opcion_1_4_8_1; 
            
            } elseif ($customText === '1.4.9') {
                $opciones_1_4_9 = [
                    '1.4.9.1' => 120,
                    '1.4.9.2' => 100,
                ];
                $puntosporactividad = $opciones_1_4_9 [$opcion_1_4_9] ?? 0;
                $nivelSeleccionado = $opcion_1_4_9; 
                
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
