<?php
session_start();
include "../../../conexion/conexion.php";

if (isset($_SESSION['suma_total1_1'])) {
    $mensaje .= "Los puntos acumulados 1 para el primer conjunto son: " . $_SESSION['suma_total1_1'] . "<br>";
} else {
    $mensaje .= "No hay puntos almacenados para el primer conjunto.<br>";
}


if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];

    // Obtener id_docente
    $stmt = $conexion->prepare("SELECT id_docente FROM docentes WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($idDocente);
    $stmt->fetch();
    $stmt->close();

    if ($idDocente) {
        // Inicializar sumaTotal en 0 por si no hay registros
        $sumaTotal_1_1 = 0;

        // Consulta de la suma total
        $query = "
            SELECT LEAST(SUM(puntos_limited), 250) AS puntos_totales
            FROM (
                SELECT '1.1.5' AS categoria, LEAST(SUM(puntos_limited), 50) AS puntos_limited
                FROM (
                    SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
                    FROM (
                        SELECT subdocumento, puntosporactividad,
                            CASE 
                                WHEN subdocumento = '1.1.5.1' THEN 25
                                WHEN subdocumento = '1.1.5.2' THEN 25
                                ELSE 0 
                            END AS limite
                        FROM documentos
                        WHERE id_docente = ? AND documento LIKE '1.1.5%'
                    ) AS subquery_2
                    GROUP BY subdocumento, limite
                ) AS subquery_3  

                UNION ALL

                SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
                FROM (
                    SELECT documento, puntosporactividad,
                        CASE 
                            WHEN documento = '1.1.1' THEN 30
                            WHEN documento = '1.1.2' THEN 20
                            WHEN documento = '1.1.3' THEN 20
                            WHEN documento = '1.1.4' THEN 50
                            WHEN documento = '1.1.6' THEN 20
                            WHEN documento = '1.1.7' THEN 20
                            ELSE 0 
                        END AS limite
                    FROM documentos
                    WHERE id_docente = ? 
                    AND (documento LIKE '1.1.1%' OR documento LIKE '1.1.2%' OR documento LIKE '1.1.3%' OR 
                         documento LIKE '1.1.4%' OR documento LIKE '1.1.6%' OR documento LIKE '1.1.7%')
                ) AS subquery_2
                GROUP BY documento, limite 
            ) AS final_query";

        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ii", $idDocente, $idDocente);
        $stmt->execute();
        $stmt->bind_result($sumaTotal_1);
        $stmt->fetch();
        $stmt->close();

        // Aplicar límite máximo de 200
        $sumaTotal_1_1 = min($sumaTotal_1, 200);

        // Guardar en sesión para usarlo en otro archivo
        $_SESSION['suma_total1_1'] = $sumaTotal_1_1;
        session_write_close();

        // Mostrar SIEMPRE el total acumulado
        echo "<div class='d-flex justify-content-end alert alert-success mb-3'>Puntos Acumulados: <strong>$sumaTotal_1_1</strong></div>";

        // Si no se ha seleccionado un documento, terminamos aquí
        if (!isset($_GET['document_type'])) {
            return;
        }

        $documentType = $_GET['document_type'];

        // Lógica para documentos individuales
        if ($documentType == "1.1.5") {
            $query = "
                SELECT LEAST(SUM(puntos_limited), 50) AS puntos_totales
                FROM (
                    SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
                    FROM (
                        SELECT subdocumento, puntosporactividad,
                        CASE 
                            WHEN subdocumento = '1.1.5.1' THEN 25
                            WHEN subdocumento = '1.1.5.2' THEN 25
                            ELSE 0 
                        END AS limite
                        FROM documentos
                        WHERE id_docente = ? AND documento LIKE ?
                    ) AS subquery
                    GROUP BY subdocumento, limite
                ) AS final_query";
            $stmt = $conexion->prepare($query);
            $documentoLike = "1.1.5%";
            $stmt->bind_param("is", $idDocente, $documentoLike);

        } elseif (in_array($documentType, ['1.1.1','1.1.2', '1.1.3','1.1.4','1.1.6', '1.1.7']))  {
            $query = "
                SELECT LEAST(SUM(puntos_limited), 200) AS puntos_totales
                FROM (
                    SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
                    FROM (
                        SELECT documento, puntosporactividad,
                            CASE 
                                WHEN documento = '1.1.1' THEN 30
                                WHEN documento = '1.1.2' THEN 20
                                WHEN documento = '1.1.3' THEN 20
                                WHEN documento = '1.1.4' THEN 50
                                WHEN documento = '1.1.6' THEN 20
                                WHEN documento = '1.1.7' THEN 20
                                ELSE 0 
                            END AS limite
                        FROM documentos
                        WHERE id_docente = ? AND documento = ?
                    ) AS subquery
                    GROUP BY documento, limite
                ) AS final_query";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("is", $idDocente, $documentType);
        } else {
            echo "<p class='text-danger'>Tipo de documento no válido.</p>";
            exit;
        }

        $stmt->execute();
        $stmt->bind_result($puntosTotales);
        $puntosTotales = 0; // Inicializar en caso de que no haya resultados
        $stmt->fetch();
        $stmt->close();

        // Mostrar los puntos del documento seleccionado
        echo "<div class='d-flex justify-content-end alert alert-primary mb-3'>Puntos Totales del Documento ($documentType): <strong>$puntosTotales</strong></div>";

        // Consulta para obtener los documentos y sus puntos
        $stmt = $conexion->prepare("SELECT id_documento, nombre_documento, ruta_archivo, puntosporactividad FROM documentos WHERE id_docente = ? AND documento = ?");
        $stmt->bind_param("is", $idDocente, $documentType);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $idDocumento = $row['id_documento'];
                $nombreDocumento = $row['nombre_documento'];
                $rutaArchivo = $row['ruta_archivo'];
                $puntosPorActividad = $row['puntosporactividad'];

                echo "<div class='d-flex justify-content-between align-items-center mb-2'>";
                echo "<span class='me-auto'>$nombreDocumento</span>";
                echo "<div class='d-flex justify-content-end'>";
                echo "<span class='badge bg-primary me-2'>$puntosPorActividad Puntos</span>";
                echo "<a href='$rutaArchivo' class='btn btn-sm btn-secondary me-2' target='_blank'>Ver</a>";
                echo "<button class='btn btn-sm btn-danger' onclick='eliminarArchivo($idDocumento, \"$rutaArchivo\")'>Eliminar</button>";
                echo "</div></div>";
            }
        } else {
            echo "<p class='text-muted'>No hay documentos disponibles.</p>";
        }

        $stmt->close();
    }
}

$conexion->close();
?>
