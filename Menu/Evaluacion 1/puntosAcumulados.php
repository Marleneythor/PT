<?php
session_start();

$mensaje = "";

if (isset($_SESSION['suma_total1_1'])) {
    $mensaje .= "Los puntos acumulados 1 para el primer conjunto son: " . $_SESSION['suma_total1_1'] . "<br>";
} else {
    $mensaje .= "No hay puntos almacenados para el primer conjunto.<br>";
}

if (isset($_SESSION['suma_total1_2'])) {
    $mensaje .= "Los puntos acumulados 2 para el segundo conjunto son: " . $_SESSION['suma_total1_2'] . "<br>";
} else {
    $mensaje .= "No hay puntos almacenados para el segundo conjunto.<br>";
}
if (isset($_SESSION['suma_total1_3'])) {
    $mensaje .= "Los puntos acumulados 3 para el segundo conjunto son: " . $_SESSION['suma_total1_3'] . "<br>";
} else {
    $mensaje .= "No hay puntos almacenados para el segundo conjunto.<br>";
}
if (isset($_SESSION['suma_total1_4'])) {
    $mensaje .= "Los puntos acumulados 4 para el segundo conjunto son: " . $_SESSION['suma_total1_4'] . "<br>";
} else {
    $mensaje .= "No hay puntos almacenados para el segundo conjunto.<br>";
}

echo $mensaje;
?>
