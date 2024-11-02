<?php
session_start(); // Iniciar la sesión

// Verificar si existe la sesión del usuario
if (isset($_SESSION['usuario'])) {
    // Destruir todas las variables de sesión
    $_SESSION = array(); // Limpiar la sesión actual

    // Si se desea destruir la sesión completamente, también se puede usar:
    // session_destroy();

    // Redirigir al usuario a la página de inicio o de inicio de sesión
    header("Location: ../index.php"); // Cambia esto a la ruta de tu página de inicio
    exit();
} else {
    // Si no hay sesión activa, redirigir al login o a la página de inicio
    header("Location: ../index.php");
    exit();
}
?>
