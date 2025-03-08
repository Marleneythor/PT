<?php
        // Conexión a la base de datos
        include '../conexion/conexion.php';

        if (!isset($_SESSION['usuario'])) {
            header("Location: ../login.php"); // Redirigir si no hay sesión activa
            exit();
        }

        $usuario = $_SESSION['usuario'];
        $sql = "SELECT * FROM docentes WHERE Usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            $docente = $resultado->fetch_assoc();
        } else {
            echo "<p>No se encontraron datos.</p>";
            exit();
        }
        $stmt->close();
        $conexion->close();
    ?>