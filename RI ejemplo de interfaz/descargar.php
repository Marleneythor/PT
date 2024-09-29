<?php
include 'conexion/conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = $conexion->prepare("SELECT nombre_archivo, tipo_archivo, archivo FROM RI WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $query->store_result();
    $query->bind_result($nombre_archivo, $tipo_archivo, $archivo);
    $query->fetch();

    header("Content-Disposition: attachment; filename=" . $nombre_archivo);
    header("Content-Type: " . $tipo_archivo);
    echo $archivo;
    $query->close();
}
?>
