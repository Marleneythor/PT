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
        // Configurar la ruta donde se guardará el archivo
        $customText = $_POST['document_type']; // Obteniendo el tipo de documento seleccionado
        $targetDir = "../../../docentes/" . $curp . "/2/" . $customText . "/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $customText = $_POST['document_type']; // Obteniendo el tipo de documento seleccionado

        // Obtener la extensión del archivo
        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // Validar tipo de archivo y tamaño
        //$allowedTypes = ['pdf', 'doc', 'docx'];
        $allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        $maxFileSize = 500 * 1024; // 500 KB

        if (!in_array($fileExtension, $allowedTypes)) {
            echo "Solo se permiten archivos PDF y Word.";
            exit();
        }

        if ($_FILES['file']['size'] > $maxFileSize) {
            echo "El tamaño del archivo no debe exceder los 500 KB.";
            exit();
        }

        // Generar un nombre de archivo único con sufijo incremental
        $n = 1;
        do {
            $newFileName = $curp . "_" . $customText . "_" . $n . "." . $fileExtension;
            $targetFilePath = $targetDir . $newFileName;
            $n++;
        } while (file_exists($targetFilePath));

        // Extraer el valor de documento del nombre del archivo
        $documento = $customText; // Asignamos el valor de $customText a la columna `documento`

        // Mover el archivo subido a la ruta especificada
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            // Guardar detalles en la base de datos usando el procedimiento almacenado
            $fechaSubida = date("Y-m-d");
            $categoria = "CategoriaEjemplo"; // Cambia esta categoría según sea necesario
            $tipoDocumento = "Constancia"; // Cambia según sea necesario
            $idActividad = 1; // Establecemos el ID de la actividad

            // Llamar al procedimiento almacenado
            $stmt = $conexion->prepare("CALL sp_InsertarDocumento(?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissssss", $idDocente, $idActividad, $newFileName, $targetFilePath, $fechaSubida, $categoria, $tipoDocumento, $documento);
            if ($stmt->execute()) {
                echo "El archivo ha sido subido y registrado exitosamente.";
                echo "<script>history.back();</script>";  // Regresar a la página anterior
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
