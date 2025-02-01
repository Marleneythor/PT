<?php
 include "../conexion/conexion.php";
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $contrasena = $_POST['password'];
    $resultado = 0;

    // Preparar la llamada al procedimiento almacenado
    $stmt = $conexion->prepare("CALL sp_IniciarSesion(?, ?, @resultado)");
    $stmt->bind_param("ss", $usuario, $contrasena);

    // Ejecutar el procedimiento
    if ($stmt->execute()) {
        $result = $conexion->query("SELECT @resultado AS resultado");
        $row = $result->fetch_assoc();
        $resultado = $row['resultado'];

        if ($resultado == 1) {
            echo "Inicio de sesión exitoso.";

        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: ../Menu\Menu.php");
        exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Error al ejecutar el procedimiento.";
    }
    $stmt->close();
}

$conn->close();


?>
