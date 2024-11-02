<?php
session_start();
include "../conexion/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    
    // Obtener CURP del usuario
    $stmt = $conexion->prepare("SELECT CURP, id_docente FROM docentes WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($curp, $idDocente);
    $stmt->fetch();
    $stmt->close();

    if ($curp && $idDocente) {
        // Configurar la ruta donde se guardará el archivo
        $targetDir = "../docentes/" . $curp . "/requisitosDeInicio/";
        
        // Crear la carpeta si no existe
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $customText = $_POST['document_type']; // Obteniendo el tipo de documento seleccionado

        // Obtener la extensión del archivo
        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // Validar tipo de archivo y tamaño
        $allowedTypes = ['pdf', 'doc', 'docx'];
        $maxFileSize = 500 * 1024; // 500 KB

        if (!in_array($fileExtension, $allowedTypes)) {
            echo "Solo se permiten archivos PDF y Word.";
            exit();
        }

        if ($_FILES['file']['size'] > $maxFileSize) {
            echo "El tamaño del archivo no debe exceder los 500 KB.";
            exit();
        }

        // Renombrar el archivo con el CURP y texto personalizado
        $newFileName = $curp . "_" . $customText . "." . $fileExtension;
        $targetFilePath = $targetDir . $newFileName;

        // Mover el archivo subido a la ruta especificada
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            // Guardar detalles en la base de datos usando el procedimiento almacenado
            $fechaSubida = date("Y-m-d");
            $categoria = "CategoriaEjemplo"; // Cambia esta categoría según sea necesario
            $tipoDocumento = "Constancia"; // Cambia según sea necesario
            $idActividad = 1; // Establecemos el ID de la actividad

            // Llamar al procedimiento almacenado
            $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisssss", $idDocente, $idActividad, $newFileName, $targetFilePath, $fechaSubida, $categoria, $tipoDocumento);
            if ($stmt->execute()) {
                echo "El archivo ha sido subido y registrado exitosamente.";
            } else {
                echo "Hubo un error al registrar el documento.";
            }
            $stmt->close();
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    } else {
        echo "No se encontró el CURP o ID del docente del usuario.";
    }
} else {
    echo "No se ha recibido un archivo o el usuario no ha iniciado sesión.";
}

$conexion->close();
?>
