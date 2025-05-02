<?php
session_start();
include "../conexion/conexion.php";
include "../Menu/funciones.php";

if (!isset($_SESSION['usuario'])) {
    echo json_encode(["error" => "No hay sesión activa."]);
    exit;
}

$usuario = $_SESSION['usuario'];
$stmt = $conexion->prepare("SELECT id_docente FROM docentes WHERE Usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($idDocente);
$stmt->fetch();
$stmt->close();

if (!$idDocente) {
    echo json_encode(["error" => "No se encontró el docente."]);
    exit;
}

$sumaTotal_1_1 = obtenerPuntosTotales1_1($conexion, $idDocente);
$sumaTotal_1_2 = obtenerPuntosTotales1_2($conexion, $idDocente);
$sumaTotal_1_3 = obtenerPuntosTotales1_3($conexion, $idDocente);
$sumaTotal_1_4 = obtenerPuntosTotales1_4($conexion, $idDocente);
$sumaTotal_2_1 = obtenerPuntosTotales2_1($conexion, $idDocente);
$sumaTotal_2_2 = obtenerPuntosTotales2_2($conexion, $idDocente);
$sumaTotal_2_3 = obtenerPuntosTotales2_3($conexion, $idDocente);
$sumaTotal_3_1 = obtenerPuntosTotales3_1($conexion, $idDocente);
$sumaTotal_3_2 = obtenerPuntosTotales3_2($conexion, $idDocente);
$sumaTotal_3_3 = obtenerPuntosTotales3_3($conexion, $idDocente);

// Calcular totales
$total_1 = min($sumaTotal_1_1 + $sumaTotal_1_2 + $sumaTotal_1_3 + $sumaTotal_1_4, 300);
$total_2 = min($sumaTotal_2_2 + $sumaTotal_2_1 + $sumaTotal_2_3, 600);
$total_3 = min($sumaTotal_3_1 + $sumaTotal_3_2 + $sumaTotal_3_3, 100);
$total_f = min($total_1 + $total_2 + $total_3, 1000);


echo "<div>$total_f</div>";

?>
