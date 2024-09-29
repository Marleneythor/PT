<?php
include 'conexion/conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = $conexion->prepare("DELETE FROM RI WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $query->close();
    header("Location: ../RI.php");
}
?>
