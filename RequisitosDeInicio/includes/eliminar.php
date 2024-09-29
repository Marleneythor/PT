<?php
require_once "../includes/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = mysqli_query($conexion, "DELETE FROM documento WHERE id = $id");

    if ($consulta) {
        // Documento eliminado con éxito
        header("Location: ../views/index.php");
        exit();
    } else {
        // Error al eliminar el documento
        echo "Error al eliminar el documento.";
    }
} else {
    echo "ID de documento no especificado.";
}
?>
