<?php
session_start();
include  "../../conexion/conexion.php";
include "../funciones.php";

if (!isset($_SESSION['usuario'])) {
    echo json_encode(["error" => "No hay sesión activa."]);
    exit;
}

$usuario = $_SESSION['usuario'];

// Obtener id_docente
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

// Obtener los puntos usando las funciones reutilizables
$sumaTotal_1_1 = obtenerPuntosTotales1_1($conexion, $idDocente);
$sumaTotal_1_2 = obtenerPuntosTotales1_2($conexion, $idDocente);
$sumaTotal_1_3 = obtenerPuntosTotales1_3($conexion, $idDocente);
$sumaTotal_1_4 = obtenerPuntosTotales1_4($conexion, $idDocente);

// Guardar en sesión
$_SESSION['suma_total1_1'] = $sumaTotal_1_1;
$_SESSION['suma_total1_2'] = $sumaTotal_1_2;
$_SESSION['suma_total1_3'] = $sumaTotal_1_3;
$_SESSION['suma_total1_4'] = $sumaTotal_1_4;
session_write_close();

// Devolver en formato JSON
echo "<table style= width: 50%; text-align: center;'>";
echo "<tr><td>Suma 1.1</td><td>$sumaTotal_1_1</td></tr>";
echo "<tr><td>Suma 1.2</td><td>$sumaTotal_1_2</td></tr>";
echo "<tr><td>Suma 1.3</td><td>$sumaTotal_1_3</td></tr>";
echo "<tr><td>Suma 1.4</td><td>$sumaTotal_1_4</td></tr>";
$total_1 = min($sumaTotal_1_1 + $sumaTotal_1_2 + $sumaTotal_1_3 + $sumaTotal_1_4, 300);
echo "<tr><td><strong>Total</strong></td><td><strong>$total_1</strong></td></tr>";
echo "</table>";

?>
