<?php
// Iniciar la sesión
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/PT/conexion/conexion.php";

// Verificar si hay usuario en sesión
if (!isset($_SESSION['usuario'])) {
    die("Error: Usuario no autenticado.");
}

// Verificar si hay usuario en sesión
if (!isset($_SESSION['usuario'])) {
    die("Error: Usuario no autenticado.");
}

// Verificar que el puntaje se haya enviado correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['puntajeFinal'])) {
    $usuario = $_SESSION['usuario'];
    $puntajeFinal = (int)$_POST['puntajeFinal'];
    $idActividad = '1.1'; // ID fijo para esta evaluación

    // Obtener el id_docente del usuario en sesión
    $queryDocente = "SELECT id_docente FROM docentes WHERE Usuario = ?";
    $stmtDocente = mysqli_prepare($conexion, $queryDocente);
    mysqli_stmt_bind_param($stmtDocente, "s", $usuario);
    mysqli_stmt_execute($stmtDocente);
    $resultDocente = mysqli_stmt_get_result($stmtDocente);

    if ($docente = mysqli_fetch_assoc($resultDocente)) {
        $idDocente = $docente['id_docente'];

        // Insertar la evaluación en la base de datos
        $queryEvaluacion = "INSERT INTO evaluaciones (id_docente, id_actividad, puntaje_obtenido, documento_comprobacion, fecha_evaluacion, evaluador) 
                            VALUES (?, ?, ?, NULL, NOW(), NULL)";
        $stmtEvaluacion = mysqli_prepare($conexion, $queryEvaluacion);
        mysqli_stmt_bind_param($stmtEvaluacion, "isi", $idDocente, $idActividad, $puntajeFinal);

        if (mysqli_stmt_execute($stmtEvaluacion)) {
            echo "Evaluación guardada correctamente.";
        } else {
            echo "Error al guardar la evaluación.";
        }
    } else {
        echo "Error: No se encontró el docente.";
    }

    // Cerrar conexión
    mysqli_stmt_close($stmtDocente);
    mysqli_stmt_close($stmtEvaluacion);
} else {
    echo "Error: Datos inválidos.";
}

mysqli_close($conexion);
?>
