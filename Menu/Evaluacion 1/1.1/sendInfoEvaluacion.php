<?php
// Iniciar la sesión
session_start();

include "../../../conexion/conexion.php";

// Verificar si hay usuario en sesión
if (!isset($_SESSION['usuario'])) {
    die("Error: Usuario no autenticado.");
}

// Obtener datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['preguntas'], $_POST['puntajeFinal'])) {
    $puntajeFinal = (int)$_POST['puntajeFinal'];
    $idActividad = 2; // ID fijo de actividad
    $usuario = $_SESSION['usuario'];

    // Obtener el id_docente del usuario en sesión
    $queryDocente = "SELECT id_docente FROM docentes WHERE Usuario = ?";
    $stmtDocente = mysqli_prepare($conexion, $queryDocente);
    mysqli_stmt_bind_param($stmtDocente, "s", $usuario);
    mysqli_stmt_execute($stmtDocente);
    $resultDocente = mysqli_stmt_get_result($stmtDocente);

    if ($docente = mysqli_fetch_assoc($resultDocente)) {
        $idDocente = $docente['id_docente'];

        // Insertar en la tabla evaluaciones
        $queryEvaluacion = "INSERT INTO evaluaciones (id_docente, id_actividad, puntaje_obtenido, fecha_evaluacion) 
                            VALUES (?, ?, ?, NOW())";
        $stmtEvaluacion = mysqli_prepare($conexion, $queryEvaluacion);
        mysqli_stmt_bind_param($stmtEvaluacion, "iii", $idDocente, $idActividad, $puntajeFinal);

        if (mysqli_stmt_execute($stmtEvaluacion)) {
            echo "Evaluación guardada correctamente.";
        } else {
            echo "Error al guardar la evaluación.";
        }
    } else {
        echo "Error: No se encontró el docente.";
    }

    // Cerrar las consultas
    mysqli_stmt_close($stmtDocente);
    mysqli_stmt_close($stmtEvaluacion);
} else {
    echo "Error: Datos inválidos.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
