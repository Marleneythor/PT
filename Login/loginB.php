<?php
 include "../conexion/conexion.php";
// Verificar conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Comprobar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $contrasena = $_POST['password'];
    $resultado = 0;

    // Preparar la llamada al procedimiento almacenado
    $stmt = $conexion->prepare("CALL sp_IniciarSesion(?, ?, @resultado)");
    $stmt->bind_param("ss", $usuario, $contrasena);

    // Ejecutar el procedimiento
    if ($stmt->execute()) {
        // Obtener el resultado
        $result = $conexion->query("SELECT @resultado AS resultado");
        $row = $result->fetch_assoc();
        $resultado = $row['resultado'];

        // Verificar el resultado
        if ($resultado == 1) {
            // Inicio de sesión exitoso
            echo "Inicio de sesión exitoso.";

        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: ../Menu\Menu.html");
        exit();
        } else {
            // Fallo en el inicio de sesión
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Error al ejecutar el procedimiento.";
    }

    // Cerrar el statement
    $stmt->close();
}

// Cerrar la conexión
$conn->close();


?>
