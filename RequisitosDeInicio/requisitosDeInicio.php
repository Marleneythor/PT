<?php
session_start();
include "../conexion/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    
    // Obtener CURP e ID del docente
    $stmt = $conexion->prepare("SELECT CURP, id_docente, ApellidoPaterno, ApellidoMaterno FROM docentes WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($curp, $idDocente, $apellidoPaterno, $apellidoMaterno);
    $stmt->fetch();
    $stmt->close();
    
    if ($curp && $idDocente) {
        $targetDir = "../docentes/" . $curp . "/RI" . $customText;
        // Crear la carpeta si no existe
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $customText = $_POST['document_type'] ?? '';
        $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        $allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        $maxFileSize = 500 * 1024; // 500 KB

        // Validaciones del archivo
        if (!in_array($fileExtension, $allowedTypes)) {
            exit("Error: Solo se permiten archivos PDF, Word o imágenes.");
        }

        if ($_FILES['file']['size'] > $maxFileSize) {
            exit("Error: El tamaño del archivo no debe exceder los 500 KB.");
        }

        // Datos para la base de datos
        $idActividad = 1;
        $fechaSubida = date("Y-m-d");
        $categoria = "CategoriaEjemplo";
        $tipoDocumento = "Constancia";
        $puntosporactividad = null;
        $nivelSeleccionado = null;

        // Función para mover archivo y registrar en BD
        function guardarArchivo($conexion, $idDocente, $idActividad, $curp, $nombreArchivo, $rutaArchivo, $fechaSubida, $categoria, $tipoDocumento, $customText, $puntosporactividad, $nivelSeleccionado, $tmpName) {
            if (!is_dir($rutaArchivo)) {
                mkdir($rutaArchivo, 0777, true);
            }

            $targetFilePath = $rutaArchivo . $nombreArchivo;

            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iissssssis", $idDocente, $idActividad, $nombreArchivo, $targetFilePath, $fechaSubida, $categoria, $tipoDocumento, $customText, $puntosporactividad, $nivelSeleccionado);
                if ($stmt->execute()) {
                    echo "Archivo guardado: " . $targetFilePath . "<br>";
                } else {
                    echo "Error al registrar en BD: " . $stmt->error . "<br>";
                }
                $stmt->close();
            } else {
                echo "Error al mover el archivo a: " . $targetFilePath . "<br>";
            }
        }

        $tmpName = $_FILES['file']['tmp_name'];
        if ($customText === "RI7") {
            $n = 1;
            do {
                $newFileName = "{$apellidoPaterno}_{$apellidoMaterno}_RI7_{$n}.{$fileExtension}";
                $targetFilePath = "$targetDir/$newFileName";
                $n++;
            } while (file_exists($targetFilePath));
        
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                $puntosRI7 = null; 
                
                $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iissssssis", $idDocente, $idActividad, $newFileName, $targetFilePath, $fechaSubida, $categoria, $tipoDocumento, $customText, $puntosRI7, $nivelSeleccionado);
                $stmt->execute();
                $stmt->close();
                $calculo = (int) ($_POST['calculo'] ?? 0);
                $calculo2 = (int) ($_POST['calculo2'] ?? 0);
                $calculo3 = (int) ($_POST['calculo3'] ?? 0);
                $nivelEstudiantes = $_POST['nivel_estudiantes'] ?? '';
                $numEstudiantes = (int) ($_POST['num_estudiantes'] ?? 0);
                
                $puntosporactividad = [
                    1 => $calculo * 5,
                    2 => $calculo2 * 10,
                    3 => $calculo3 * 5,
                    4 => 0  
                ];
                if ($nivelEstudiantes === 'licenciatura') {
                    $puntosporactividad[4] = ($numEstudiantes * 50) / 200; 
                } elseif ($nivelEstudiantes === 'posgrado') {
                    $puntosporactividad[4] = $numEstudiantes; 
                }
                
                for ($i = 1; $i <= 4; $i++) {
                    $subFolder = "../docentes/" . $curp . "/1/1.1/1.1.$i/";
                    if (!is_dir($subFolder)) {
                        mkdir($subFolder, 0777, true);
                    }
                    $n = 1;
                    do {
                        $nombreNuevo = "{$apellidoPaterno}_{$apellidoMaterno}_1.1.{$i}_{$n}.{$fileExtension}";
                        $rutaDestino = $subFolder . $nombreNuevo;
                        $n++;
                    } while (file_exists($rutaDestino));
                    copy($targetFilePath, $rutaDestino);
        
                    $subCustomText = "1.1.$i";
        
                    $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iissssssis", $idDocente, $idActividad, $nombreNuevo, $rutaDestino, $fechaSubida, $categoria, $tipoDocumento, $subCustomText, $puntosporactividad[$i], $nivelSeleccionado);
                    $stmt->execute();
                    $stmt->close();
                }
        
                echo "Se subió RI7 y sus 4 copias correctamente.";
                echo "<script>history.back();</script>";
            } else {
                echo "Error al subir el archivo original RI7.";
            }


        } elseif ($customText === "RI3") {
                $n = 1;
                do {
                    $newFileName = "{$apellidoPaterno}_{$apellidoMaterno}_RI3_{$n}.{$fileExtension}";
                    $targetFilePath = "$targetDir/$newFileName";
                    $n++;
                } while (file_exists($targetFilePath));
            
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    $puntosRI7 = null; 
                    
                    $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iissssssis", $idDocente, $idActividad, $newFileName, $targetFilePath, $fechaSubida, $categoria, $tipoDocumento, $customText, $puntosRI7, $nivelSeleccionado);
                    $stmt->execute();
                    $stmt->close();
                    for ($i = 1; $i <= 3; $i++) {
                        $subFolder = "../docentes/" . $curp . "/1/1.1/1.1.$i/";
                        if (!is_dir($subFolder)) {
                            mkdir($subFolder, 0777, true);
                        }
                        $n = 1;
                        do {
                            $nombreNuevo = "{$apellidoPaterno}_{$apellidoMaterno}_1.1.{$i}_{$n}.{$fileExtension}";
                            $rutaDestino = $subFolder . $nombreNuevo;
                            $n++;
                        } while (file_exists($rutaDestino));
                        copy($targetFilePath, $rutaDestino);
            
                        $subCustomText = "1.1.$i";
            
                        $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("iissssssis", $idDocente, $idActividad, $nombreNuevo, $rutaDestino, $fechaSubida, $categoria, $tipoDocumento, $subCustomText, $puntosporactividad[$i], $nivelSeleccionado);
                        $stmt->execute();
                        $stmt->close();
                    }
            
                    echo "Se subió RI7 y sus 4 copias correctamente.";
                    echo "<script>history.back();</script>";
                } else {
                    echo "Error al subir el archivo original RI7.";
                }
        } elseif ($customText === "RI10") {
            $n = 1;
            do {
                $newFileName = "{$apellidoPaterno}_{$apellidoMaterno}_RI10_{$n}.{$fileExtension}";
                $targetFilePath = "$targetDir/$newFileName";
                $n++;
            } while (file_exists($targetFilePath));
        
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                $puntosRI7 = null; 
                $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iissssssis", $idDocente, $idActividad, $newFileName, $targetFilePath, $fechaSubida, $categoria, $tipoDocumento, $customText, $puntosRI7, $nivelSeleccionado);
                $stmt->execute();
                $stmt->close();
                $opcion_10 = $_POST['opcion_10'] ?? '';
                
                $opciones_1_4_9 = [
                    '1.4.9.1' => 120,
                    '1.4.9.2' => 100,
                ];
                $puntosporactividad = $opciones_1_4_9 [$opcion_10] ?? 0;
                $nivelSeleccionado = $opcion_10; 

                    $n = 1;
                    do {
                        $nombreNuevo = "{$apellidoPaterno}_{$apellidoMaterno}_1.4.9_{$n}.{$fileExtension}";
                        $subFolder = "../docentes/" . $curp . "/1/1.4/1.4.9/";
                        $rutaDestino = $subFolder . $nombreNuevo;
                        $n++;
                    } while (file_exists($rutaDestino));
                    copy($targetFilePath, $rutaDestino);
        
                    $subCustomText = "1.4.9";
        
                    $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iissssssis", $idDocente, $idActividad, $nombreNuevo, $rutaDestino, $fechaSubida, $categoria, $tipoDocumento, $subCustomText, $puntosporactividad, $nivelSeleccionado);
                    $stmt->execute();
                    $stmt->close();
        
                echo "Se subió RI7 y sus 4 copias correctamente.";
                echo "<script>history.back();</script>";
            } else {
                echo "Error al subir el archivo original RI7.";
            }
        } else {
    $n = 1;
    do {
        $newFileName = "{$apellidoPaterno}_{$apellidoMaterno}_{$customText}_{$n}.{$fileExtension}";
        $targetFilePath = "$targetDir/$newFileName";
        $n++;
    } while (file_exists($targetFilePath));

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
        $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissssssis", $idDocente, $idActividad, $newFileName, $targetFilePath, $fechaSubida, $categoria, $tipoDocumento, $customText, $puntosporactividad, $nivelSeleccionado);
        $stmt->execute();
        $stmt->close();
        echo "Archivo subido correctamente.";
        echo "<script>history.back();</script>";
    } else {
        echo "Error al subir el archivo.";
    }
}

    } else {
        echo "Error: No se encontró el CURP o ID del docente.";
    }
} else {
    echo "Error: No se ha recibido un archivo o el usuario no ha iniciado sesión.";
}

$conexion->close();
?>
