<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php"); // Redirige al login si no hay sesión
    exit();
}
?>
