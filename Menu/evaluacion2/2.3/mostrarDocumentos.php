<?php
session_start();
include "../../../conexion/conexion.php";

if (isset($_SESSION['usuario']) && isset($_GET['document_type'])) {
    $usuario = $_SESSION['usuario'];
    $documentType = $_GET['document_type'];

    // Consultar el id_docente basado en el usuario de la sesión
    $stmt = $conexion->prepare("SELECT id_docente FROM docentes WHERE Usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($idDocente);
    $stmt->fetch();
    $stmt->close();

    if ($idDocente) {

        $stmt = $conexion->prepare("
            SELECT 
                LEAST(SUM(puntosporactividad), 
                    CASE 
                        WHEN documento = '1.2.1.1' THEN 40
                        WHEN documento = '1.2.1.2' THEN 40
                        WHEN documento = '1.2.1.3' THEN 10
                        WHEN documento = '1.2.1.4' THEN 20
                        WHEN documento = '1.2.2.1' THEN 60
                        WHEN documento = '1.2.2.2' THEN 60
                        WHEN documento = '1.2.2.3' THEN 80
                        WHEN documento = '1.2.2.4' THEN 80
                        WHEN documento = '1.2.2.5' THEN 80

                        WHEN documento = '1.2.2.6' THEN 80
                        WHEN documento = '1.2.2.7' THEN 80
                        ELSE SUM(puntosporactividad) 
                    END
                ) AS puntos_totales
            FROM documentos
            WHERE id_docente = ? AND documento = ?");
        $stmt->bind_param("is", $idDocente, $documentType);
        $stmt->execute();
        $stmt->bind_result($puntosTotales);
        $stmt->fetch();
        $stmt->close();
    
        // Obtener la suma total de puntos considerando el límite de 100 para 1.2.1 y 1.2.2
        $stmt = $conexion->prepare("
            SELECT 
                LEAST(SUM(CASE WHEN documento LIKE '1.2.1%' THEN puntos_limited ELSE 0 END), 100) AS total_1_2_1,
                LEAST(SUM(CASE WHEN documento LIKE '1.2.2%' THEN puntos_limited ELSE 0 END), 100) AS total_1_2_2
            FROM (
                SELECT 
                    documento,
                    LEAST(SUM(puntosporactividad), 
                        CASE 
                            WHEN documento = '1.2.1.1' THEN 40
                            WHEN documento = '1.2.1.2' THEN 40
                            WHEN documento = '1.2.1.3' THEN 10
                            WHEN documento = '1.2.1.4' THEN 20
                            WHEN documento = '1.2.2.1' THEN 60
                            WHEN documento = '1.2.2.2' THEN 60
                            WHEN documento = '1.2.2.3' THEN 80
                            WHEN documento = '1.2.2.4' THEN 80
                            WHEN documento = '1.2.2.5' THEN 80
                            WHEN documento = '1.2.2.6' THEN 80
                            WHEN documento = '1.2.2.7' THEN 80
                            ELSE SUM(puntosporactividad) 
                        END
                    ) AS puntos_limited
                FROM documentos
                WHERE id_docente = ?
                AND documento LIKE '1.2.%'
                GROUP BY documento
            ) AS subquery
        ");
        $stmt->bind_param("i", $idDocente);
        $stmt->execute();
        $stmt->bind_result($total_1_2_1, $total_1_2_2);
        $stmt->fetch();
        $stmt->close();
    
        // Aplicar el límite global de 150
        $sumaTotal_2_3 = min($total_1_2_1 + $total_1_2_2, 150);
        

        // Mostrar ambos valores con el límite aplicado
        echo "<div class='d-flex justify-content-between align-items-center mb-2'>";
        echo "<div class='d-flex justify-content-end alert alert-primary mb-3'>Puntos Totales Acumulados: <strong>$sumaTotal_2_3</strong></div>";
        echo "<div class='d-flex justify-content-end alert alert-success mb-3'>Puntos Totales del Documento: <strong>$puntosTotales</strong></div>";
        echo "</div>";  

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
                echo "<span class='me-auto'>$nombreDocumento</span>";  // Alineado a la izquierda
                
                // Contenedor para los botones, alineados a la derecha
                echo "<div class='d-flex justify-content-end'>";
                echo "<span class='badge text-white me-2' style='background-color: #003366; font-size: 14px; padding: 6px 10px; border-radius: 5px; min-width: 50px; text-align: center; display: inline-block;'>$puntosPorActividad Puntos</span>";

                echo "<a href='$rutaArchivo' class='btn btn-sm btn-secondary me-2' target='_blank'>Ver</a>";
                echo "<a href='$rutaArchivo' class='btn btn-sm btn-primary me-2' download>Descargar</a>";
                echo "<button class='btn btn-sm btn-danger me-2' onclick='eliminarArchivo($idDocumento, \"$rutaArchivo\")'>Eliminar</button>";
                echo "</div>";  
                echo "</div>";  
            }
        } else {
            echo "<p class='text-muted'>No hay documentos disponibles para esta opción.</p>";
        }

        $stmt->close();
    } else {
        echo "<p class='text-danger'>No se encontró el ID del docente asociado al usuario.</p>";
    }
} else {
    echo "<p class='text-danger'>Error al procesar la solicitud.</p>";
}

$conexion->close();
?>
