<?php
session_start();
include "../../../conexion/conexion.php";

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
        // Configurar la nueva ruta
        $customText = $_POST['document_type']; // Obteniendo el tipo de documento seleccionado
        $targetDir = "../../../docentes/" . $curp . "/1/" . $customText . "/";

        // Crear la carpeta si no existe
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Validaciones del archivo
        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
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

        // Generar un nombre único para el archivo
        $n = 1;
        do {
            $newFileName = $curp . "_" . $customText . "_" . $n . "." . $fileExtension;
            $targetFilePath = $targetDir . $newFileName;
            $n++;
        } while (file_exists($targetFilePath));

        // Extraer el valor de documento
        $documento = $customText;

        // Mover el archivo subido
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            // Detalles para la base de datos
            $fechaSubida = date("Y-m-d");
            $categoria = "PromociónDelAprendizaje";
            $tipoDocumento = "Constancia";
            $idActividad = 2;

            // Llamar al procedimiento almacenado
            $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissssss", $idDocente, $idActividad, $newFileName, $targetFilePath, $fechaSubida, $categoria, $tipoDocumento, $documento);
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
