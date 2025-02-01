<?php
session_start();
include "../../../conexion/conexion.php";

if (isset($_POST['ruta_archivo']) && isset($_POST['id_documento'])) {
    $rutaArchivo = $_POST['ruta_archivo'];
    $idDocumento = $_POST['id_documento'];

    // Eliminar el registro en la base de datos
    $stmt = $conexion->prepare("DELETE FROM documentos WHERE id_documento = ?");
    $stmt->bind_param("i", $idDocumento);
    $stmt->execute();
    $stmt->close();

    // Verificar y eliminar el archivo físico
    if (file_exists($rutaArchivo)) {
        unlink($rutaArchivo); // Eliminar el archivo físico
        echo "Archivo eliminado exitosamente.";
    } else {
        echo "Archivo no encontrado en la carpeta.";
    }
} else {
    echo "Error: Datos incompletos para eliminar el archivo.";
}

$conexion->close();
?>
