<?php
try {
    include "../conexion/conexion.php";
    session_start();
    
    // Obtener los datos del formulario
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT 
              Usuario AS usuario,
              Nombres AS nombre,
              ApellidoPaterno AS ap1,
              ApellidoMaterno AS ap2
            FROM usuario
            WHERE Usuario = '$user' 
              AND Contrasena = '$pass'";
    
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado->num_rows == 1) {
        // Autenticación exitosa
        $row = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['ap1'] = $row['ap1'];
        $_SESSION['ap2'] = $row['ap2'];

        header("Location: ../Menu/Menu.html");
    } else {
        header("Location: ../index.php?mensaje=Error de autenticación");
    }
} catch (error $e) {
    echo $e;
}
?>
