<?php
session_start();
include  "../../conexion/conexion.php";
include "../funciones.php";

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

$sumaTotal_2_1 = obtenerPuntosTotales2_1($conexion, $idDocente);
$sumaTotal_2_2 = obtenerPuntosTotales2_2($conexion, $idDocente);

// Guardar en sesión
$_SESSION['sumaTotal_2_1'] = $sumaTotal_2_1;
$_SESSION['sumaTotal_2_2'] = $sumaTotal_2_2;
session_write_close();

echo "<table style= width: 50%; text-align: center;'>";
echo "<tr><td>Suma 2.1</td><td>$sumaTotal_2_1</td></tr>";
echo "<tr><td>Suma 2.2</td><td>$sumaTotal_2_2</td></tr>";
$total_2 = min( $sumaTotal_2_2 + $sumaTotal_2_1, 600);
echo "<tr><td><strong>Total</strong></td><td><strong>$total_2</strong></td></tr>";
echo "</table>";

?>
