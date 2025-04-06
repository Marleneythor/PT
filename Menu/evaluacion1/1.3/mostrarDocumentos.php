<?php
session_start();
include "../../../conexion/conexion.php";
include "../../funciones.php";

if (!isset($_SESSION['usuario']) || !isset($_GET['document_type'])) {
    echo "<p class='text-danger'>Error al procesar la solicitud.</p>";
    exit;
}

$usuario = $_SESSION['usuario'];
$documentType = htmlspecialchars($_GET['document_type']); // Seguridad en la entrada

// Consultar el id_docente basado en el usuario de la sesión
$stmt = $conexion->prepare("SELECT id_docente FROM docentes WHERE Usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($idDocente);
$stmt->fetch();
$stmt->close();

if (empty($idDocente)) {
    echo "<p class='text-danger'>No se encontró el ID del docente asociado al usuario.</p>";
    exit;
}

// Obtener los puntos acumulados
$sumaTotal_1_3 = obtenerPuntosTotales1_3($conexion, $idDocente);
$_SESSION['suma_total1_3'] = $sumaTotal_1_3;

        // Definir la consulta SQL dependiendo del tipo de documento
        if ($documentType == "1.3.1") {
            $query = "
                SELECT LEAST(SUM(puntos_limited), 100) AS puntos_totales
                FROM (
                    SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
                    FROM (
                        SELECT subdocumento, puntosporactividad,
                            CASE 
                                WHEN subdocumento = '1.3.1.1' THEN 80
                                WHEN subdocumento = '1.3.1.2' THEN 75
                                WHEN subdocumento = '1.3.1.3' THEN 80
                                WHEN subdocumento = '1.3.1.4' THEN 60
                                WHEN subdocumento = '1.3.1.5' THEN 100
                                WHEN subdocumento = '1.3.1.6' THEN 80
                                ELSE 0 
                            END AS limite
                        FROM documentos
                        WHERE id_docente = ? AND documento LIKE '1.3.1%'
                    ) AS subquery
                    GROUP BY subdocumento, limite
                ) AS final_query";
        } elseif ($documentType == "1.3.2") {
            $query = "
                SELECT LEAST(SUM(puntos_limited), 30) AS puntos_totales
                FROM (
                    SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
                    FROM (
                        SELECT subdocumento, puntosporactividad,
                            CASE 
                                WHEN subdocumento = '1.3.2.1' THEN 30
                                WHEN subdocumento = '1.3.2.2' THEN 30
                                WHEN subdocumento = '1.3.2.3' THEN 30
                                WHEN subdocumento = '1.3.2.4' THEN 30
                                WHEN subdocumento = '1.3.2.5' THEN 30
                                ELSE 0 
                            END AS limite
                        FROM documentos
                        WHERE id_docente = ? AND documento LIKE '1.3.2%'
                    ) AS subquery
                    GROUP BY subdocumento, limite
                ) AS final_query";
        } else {
            echo "<p class='text-danger'>Tipo de documento no válido.</p>";
            exit;
        }

        // Ejecutar la consulta del tipo de documento seleccionado
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $idDocente);
        $stmt->execute();
        $stmt->bind_result($puntosTotales);
        $stmt->fetch();
        $stmt->close();
        if (!isset($puntosTotales)) {
            $puntosTotales = 0; // O cualquier valor predeterminado
        }
        
        // Mostrar los puntos acumulados según la opción seleccionada
        echo "<div class='d-flex justify-content-between align-items-center mb-2'>";
        echo "<div class='d-flex justify-content-end alert alert-success mb-3'>Puntos Acumulados: <strong>$sumaTotal_1_3</strong></div>";
        echo "<div class='d-flex justify-content-end alert alert-primary mb-3'>Puntos Totales del Documento ($documentType): <strong>$puntosTotales</strong></div>";
        echo "</div>";

        // Consulta para obtener los documentos y sus puntos
        $stmt = $conexion->prepare("SELECT id_documento, nombre_documento, ruta_archivo, puntosporactividad, subdocumento FROM documentos WHERE id_docente = ? AND documento = ?");
        $stmt->bind_param("is", $idDocente, $documentType);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $idDocumento = $row['id_documento'];
                $nombreDocumento = $row['nombre_documento'];
                $rutaArchivo = $row['ruta_archivo'];
                $puntosPorActividad = $row['puntosporactividad'];
                $subdocumento = $row['subdocumento'];

                echo "<div class='d-flex justify-content-between align-items-center mb-2'>";
                echo "<span class='me-auto'>$nombreDocumento</span>";  // Alineado a la izquierda
                
                // Contenedor para los botones, alineados a la derecha
                echo "<div class='d-flex justify-content-end'>";
                echo "<span class='badge text-white me-2' style='background-color: #003366; font-size: 14px; padding: 6px 10px; border-radius: 5px; min-width: 50px; text-align: center; display: inline-block;'> ($subdocumento): $puntosPorActividad Puntos</span>";

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
    $conexion->close();
?>
