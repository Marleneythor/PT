<?php
include "C:/xampp/htdocs/PT/conexion/conexion.php";


function obtenerPuntosTotales1_1($conexion, $idDocente) {
    $query = "
        SELECT LEAST(SUM(puntos_limited), 200) AS puntos_totales
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
    $stmt->bind_result($sumaTotal);
    $stmt->fetch();
    $stmt->close();

    return min($sumaTotal, 200);
}
function obtenerPuntosTotales1_2($conexion, $idDocente) {
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
    $sumaTotal_1_2 = min($total_1_2_1 + $total_1_2_2, 150);

    return $sumaTotal_1_2; // Agregar retorno de la suma calculada
}
function obtenerPuntosTotales1_3($conexion, $idDocente) {

    $query = "
    SELECT LEAST(SUM(puntos_limited), 130) AS puntos_totales
    FROM (
        SELECT '1.3.1' AS categoria, LEAST(SUM(puntos_limited), 100) AS puntos_limited
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
        ) AS subquery_1
        GROUP BY subdocumento, limite
        ) AS subquery_3
        UNION ALL
        SELECT '1.3.1' AS categoria, LEAST(SUM(puntos_limited), 30) AS puntos_limited
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
        ) AS subquery_2
        GROUP BY subdocumento, limite
        ) AS subquery_3
    ) AS final_query";

        // Ejecutar la consulta para la suma de 1.3.1 + 1.3.2
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ii", $idDocente, $idDocente);
        $stmt->execute();
        $stmt->bind_result($sumaTotal_3);
        $stmt->fetch();
        $stmt->close();
        $sumaTotal_1_3 = min($sumaTotal_3, 100);

    return $sumaTotal_1_3; // Agregar retorno de la suma calculada
}
function obtenerPuntosTotales1_4 ($conexion, $idDocente){
    $query = "
    SELECT LEAST(SUM(puntos_limited), 150) AS puntos_totales
    FROM (
        SELECT '1.4.2' AS categoria, LEAST(SUM(puntos_limited), 20) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '1.4.2.1' THEN 10
                    WHEN subdocumento = '1.4.2.2' THEN 15
                    WHEN subdocumento = '1.4.2.3' THEN 20
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '1.4.2%'
        ) AS subquery_1
        GROUP BY subdocumento, limite
        ) AS subquery_3
       
        UNION ALL
        SELECT '1.4.3' AS categoria, LEAST(SUM(puntos_limited), 50) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '1.4.3.1' THEN 30
                    WHEN subdocumento = '1.4.3.2' THEN 30
                    WHEN subdocumento = '1.4.3.3' THEN 40
                    WHEN subdocumento = '1.4.3.4' THEN 30
                    WHEN subdocumento = '1.4.3.5' THEN 35
                    WHEN subdocumento = '1.4.3.6' THEN 40
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '1.4.3%'
        ) AS subquery_2
        GROUP BY subdocumento, limite
        ) AS subquery_3

        UNION ALL
        SELECT '1.4.4' AS categoria, LEAST(SUM(puntos_limited), 35) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '1.4.4.1' THEN 20
                    WHEN subdocumento = '1.4.4.2' THEN 30
                    WHEN subdocumento = '1.4.4.3' THEN 20
                    WHEN subdocumento = '1.4.4.4' THEN 20
                    WHEN subdocumento = '1.4.4.5' THEN 20
                    WHEN subdocumento = '1.4.4.6' THEN 30
                    WHEN subdocumento = '1.4.4.7' THEN 12
                    WHEN subdocumento = '1.4.4.8' THEN 20
                    WHEN subdocumento = '1.4.4.9' THEN 24
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '1.4.4%'
        ) AS subquery_3
        GROUP BY subdocumento, limite
        ) AS subquery_3

        UNION ALL
        SELECT '1.4.5' AS categoria, LEAST(SUM(puntos_limited), 40) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '1.4.5.1' THEN 40
                    WHEN subdocumento = '1.4.5.2' THEN 30
                    WHEN subdocumento = '1.4.5.3' THEN 40
                    WHEN subdocumento = '1.4.5.4' THEN 25
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '1.4.5%'
        ) AS subquery_4
        GROUP BY subdocumento, limite
        ) AS subquery_3

        UNION ALL
        SELECT '1.4.6' AS categoria, LEAST(SUM(puntos_limited), 30) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '1.4.6.1' THEN 20
                    WHEN subdocumento = '1.4.6.2' THEN 30
                    WHEN subdocumento = '1.4.6.3' THEN 30
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '1.4.6%'
        ) AS subquery_5
        GROUP BY subdocumento, limite
        ) AS subquery_3

        UNION ALL
        SELECT '1.4.7' AS categoria, LEAST(SUM(puntos_limited), 30) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '1.4.7.1' THEN 20
                    WHEN subdocumento = '1.4.7.2' THEN 30
                    WHEN subdocumento = '1.4.7.3' THEN 30
                    WHEN subdocumento = '1.4.7.4' THEN 20
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '1.4.7%'
        ) AS subquery_6
        GROUP BY subdocumento, limite
        ) AS subquery_3

        UNION ALL
        SELECT '1.4.8' AS categoria, LEAST(SUM(puntos_limited), 50) AS puntos_limited
        FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '1.4.8.1.1' THEN 20
                        WHEN subdocumento = '1.4.8.1.2' THEN 30
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '1.4.8.1%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
    
            UNION ALL
    
            SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT documento, puntosporactividad,
                    CASE 
                        WHEN documento = '1.4.8.2' THEN 25
                        WHEN documento = '1.4.8.3' THEN 20
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND (documento LIKE '1.4.8.2%' OR documento LIKE '1.4.8.3%')
            ) AS subquery_2
            GROUP BY documento, limite 
        ) AS subquery_3
        
        UNION ALL
        SELECT '1.4.9' AS categoria, LEAST(SUM(puntos_limited), 120) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '1.4.9.1' THEN 120
                    WHEN subdocumento = '1.4.9.2' THEN 100
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '1.4.9%'
        ) AS subquery_8
        GROUP BY subdocumento, limite
        ) AS subquery_3

        UNION ALL
        SELECT '1.4.1' AS categoria, LEAST(SUM(puntos_limited), 45) AS puntos_limited
        FROM (
        SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT documento, puntosporactividad,
                CASE 
                    WHEN documento = '1.4.1' THEN 45
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '1.4.1%'
        ) AS subquery_9
        GROUP BY documento, limite 
        ) AS subquery_3
    ) AS final_query";

        // Ejecutar la consulta para la suma de 1.3.1 + 1.3.2
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("iiiiiiiiii", $idDocente, $idDocente, $idDocente, $idDocente, $idDocente, $idDocente, $idDocente, $idDocente, $idDocente, $idDocente);
        $stmt->execute();
        $stmt->bind_result($sumaTotal_4);
        $stmt->fetch();
        $stmt->close();
        $sumaTotal_1_4 = min($sumaTotal_4, 150);

        return $sumaTotal_1_4; // Agregar retorno de la suma calculada
        
}








function obtenerPuntosTotales2_1($conexion, $idDocente) {
    $query = "
    SELECT LEAST(SUM(puntos_limited), 250) AS puntos_totales
    FROM (
        
        SELECT '2.1.1' AS categoria, LEAST(SUM(puntos_limited), 250) AS puntos_limited
        FROM (
            SELECT '2.1.1.1' AS categoria, LEAST(SUM(puntos_limited), 160) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '2.1.1.1.1.1' THEN 80
                        WHEN subdocumento = '2.1.1.1.1.2' THEN 40
                        WHEN subdocumento = '2.1.1.1.2.1' THEN 100
                        WHEN subdocumento = '2.1.1.1.2.2' THEN 50
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.1.1.1%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
            ) AS subquery_3

            UNION ALL
            SELECT '2.1.1.2' AS categoria, LEAST(SUM(puntos_limited), 80) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '2.1.1.2.1.1' THEN 60
                        WHEN subdocumento = '2.1.1.2.1.2' THEN 30
                        WHEN subdocumento = '2.1.1.2.2.1' THEN 80
                        WHEN subdocumento = '2.1.1.2.2.2' THEN 40
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.1.1.2%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
            ) AS subquery_3

            UNION ALL
            SELECT '2.1.1.3' AS categoria, LEAST(SUM(puntos_limited), 80) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '2.1.1.3.1.1' THEN 20
                        WHEN subdocumento = '2.1.1.3.1.1' THEN 10 
                        WHEN subdocumento = '2.1.1.3.2.1' THEN 20
                        WHEN subdocumento = '2.1.1.3.2.1' THEN 10
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.1.1.3%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
            ) AS subquery_3

            UNION ALL
            SELECT '2.1.1.4' AS categoria, LEAST(SUM(puntos_limited), 100) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '2.1.1.4.1' THEN 100
                        WHEN subdocumento = '2.1.1.4.2.1' THEN 20 
                        WHEN subdocumento = '2.1.1.4.2.2' THEN 10
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.1.1.4%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
            ) AS subquery_3

            UNION ALL
            SELECT '2.1.1.5' AS categoria, LEAST(SUM(puntos_limited), 50) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '2.1.1.5.1.1' THEN 40
                        WHEN subdocumento = '2.1.1.5.1.2' THEN 15
                        WHEN subdocumento = '2.1.2.5.2.1' THEN 20
                        WHEN subdocumento = '2.1.2.5.2.2' THEN 10
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.1.1.5%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
            ) AS subquery_3   
        ) AS subquery_4

        UNION ALL
        SELECT '2.1.2' AS categoria, LEAST(SUM(puntos_limited), 100) AS puntos_limited
        FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '2.1.2.1.1' THEN 30
                        WHEN subdocumento = '2.1.2.1.2' THEN 40 
                        WHEN subdocumento = '2.1.2.1.3' THEN 50
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.1.2.1%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
            

            UNION ALL
            
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '2.1.2.2.1' THEN 30
                        WHEN subdocumento = '2.1.2.2.2' THEN 40 
                        WHEN subdocumento = '2.1.2.2.3' THEN 50
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.1.2.2%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
        ) AS subquery_4
       
    ) AS final_query";


        $stmt = $conexion->prepare($query);
        $stmt->bind_param("iiiiiii", $idDocente, $idDocente, $idDocente, $idDocente, $idDocente, $idDocente , $idDocente);
        $stmt->execute();
        $stmt->bind_result($sumaTotal_2_1);
        $stmt->fetch();
        $stmt->close();
        $sumaTotal_2_1 = min($sumaTotal_2_1, 250);

    return $sumaTotal_2_1; 
}

function obtenerPuntosTotales2_2($conexion, $idDocente) {

    $query = "
            SELECT LEAST(SUM(puntos_limited), 150) AS puntos_totales
            FROM (
                    SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
                    FROM (
                        SELECT subdocumento, puntosporactividad,
                            CASE 
                                WHEN subdocumento = '2.2.2' THEN 80
                                WHEN subdocumento = '2.2.3' THEN 80
                                WHEN subdocumento = '2.2.4' THEN 80
                                WHEN subdocumento = '2.2.5' THEN 80
                                WHEN subdocumento = '2.2.6' THEN 20
                                ELSE 0 
                            END AS limite
                        FROM documentos
                        WHERE id_docente = ? AND documento LIKE 'x%'
                    ) AS subquery_2
                    GROUP BY subdocumento, limite
                    UNION ALL
            
                    SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
                    FROM (
                        SELECT documento, puntosporactividad,
                            CASE 
                                WHEN documento = '2.2.1' THEN 20
                                WHEN documento = '2.2.7' THEN 10
                                WHEN documento = '2.2.8' THEN 60
                                WHEN documento = '2.2.9' THEN 50
                                WHEN documento = '2.2.10' THEN 40
                                ELSE 0 
                            END AS limite
                        FROM documentos
                        WHERE id_docente = ? AND (documento LIKE '2.2.1%' OR documento LIKE '2.2.7%' OR documento LIKE '2.2.8%' OR documento LIKE '2.2.9%' OR documento LIKE '2.2.10%')
                    ) AS subquery_2
                    GROUP BY documento, limite 
            
            ) AS final_query";

        // Ejecutar la consulta para la suma de 1.3.1 + 1.3.2
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ii", $idDocente, $idDocente);
        $stmt->execute();
        $stmt->bind_result($sumaTotal_2_2);
        $stmt->fetch();
        $stmt->close();
        $sumaTotal_2_2 = min($sumaTotal_2_2, 150);

    return $sumaTotal_2_2; // Agregar retorno de la suma calculada
}


function obtenerPuntosTotales2_3($conexion, $idDocente) {
    $query = "
    SELECT LEAST(SUM(puntos_limited), 200) AS puntos_totales
    FROM (
        SELECT '2.3.1' AS categoria, LEAST(SUM(puntos_limited), 40) AS puntos_limited
        FROM (
        SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT documento, puntosporactividad,
                CASE 
                    WHEN documento = '2.3.1.1' THEN 20
                    WHEN documento = '2.3.1.2' THEN 20
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '2.3.1%'
        ) AS subquery_9
        GROUP BY documento, limite 
        ) AS subquery_3
       
        UNION ALL
        SELECT '2.3.2' AS categoria, LEAST(SUM(puntos_limited), 20) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '2.3.2.1' THEN 10
                    WHEN subdocumento = '1.4.3.2' THEN 15
                    WHEN subdocumento = '1.4.3.3' THEN 20
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '2.3.2%'
        ) AS subquery_2
        GROUP BY subdocumento, limite
        ) AS subquery_3

        UNION ALL
        SELECT '2.3.3' AS categoria, LEAST(SUM(puntos_limited), 40) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '2.3.3.1' THEN 30
                    WHEN subdocumento = '2.3.3.2' THEN 30
                    WHEN subdocumento = '2.3.3.3' THEN 40
                    WHEN subdocumento = '2.3.3.4' THEN 30
                    WHEN subdocumento = '2.3.3.5' THEN 35
                    WHEN subdocumento = '2.3.3.6' THEN 40
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '2.3.3%'
        ) AS subquery_3
        GROUP BY subdocumento, limite
        ) AS subquery_3

        UNION ALL
        SELECT '2.3.4' AS categoria, LEAST(SUM(puntos_limited), 60) AS puntos_limited
        FROM (
        SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT documento, puntosporactividad,
                CASE 
                    WHEN documento = '2.3.4.1' THEN 60
                    WHEN documento = '2.3.4.2' THEN 60
                    WHEN documento = '2.3.4.3' THEN 60
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '2.3.4%'
        ) AS subquery_9
        GROUP BY documento, limite 
        ) AS subquery_3

        
        UNION ALL
        SELECT '2.3.5' AS categoria, LEAST(SUM(puntos_limited), 30) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '2.3.5.1.1' THEN 30
                    WHEN subdocumento = '2.3.5.1.2' THEN 30
                    WHEN subdocumento = '2.3.5.1.3' THEN 30
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '2.3.5%'
        ) AS subquery_5
        GROUP BY subdocumento, limite
        ) AS subquery_3

        UNION ALL
        SELECT '2.3.6' AS categoria, LEAST(SUM(puntos_limited), 30) AS puntos_limited
        FROM (
        SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT documento, puntosporactividad,
                CASE 
                    WHEN documento = '2.3.6.1' THEN 20
                    WHEN documento = '2.3.6.2' THEN 20
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '2.3.6%'
        ) AS subquery_9
        GROUP BY documento, limite 
        ) AS subquery_3

        UNION ALL
        SELECT '2.3.7' AS categoria, LEAST(SUM(puntos_limited), 40) AS puntos_limited
        FROM (
            SELECT '2.3.7.1' AS categoria, LEAST(SUM(puntos_limited), 20) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '2.3.7.1.1' THEN 20
                        WHEN subdocumento = '2.3.7.1.2' THEN 20
                        WHEN subdocumento = '2.3.7.1.3' THEN 20
                        WHEN subdocumento = '2.3.7.1.4' THEN 20
                        WHEN subdocumento = '2.3.7.1.5' THEN 20
                        WHEN subdocumento = '2.3.7.1.6' THEN 20
                        WHEN subdocumento = '2.3.7.1.7' THEN 20
                        WHEN subdocumento = '2.3.7.1.8' THEN 20
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.3.7.1'
            ) AS subquery_5
            GROUP BY subdocumento, limite
            ) AS subquery_3
    
            UNION ALL
    
            SELECT '2.3.7.2' AS categoria, LEAST(SUM(puntos_limited), 20) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '2.3.7.2.1' THEN 20
                        WHEN subdocumento = '2.3.7.2.2' THEN 20
                        WHEN subdocumento = '2.3.7.2.3' THEN 20
                        WHEN subdocumento = '2.3.7.2.4' THEN 20
                        WHEN subdocumento = '2.3.7.2.5' THEN 20
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.3.7.2'
            ) AS subquery_5
            GROUP BY subdocumento, limite
            ) AS subquery_3
            UNION ALL
            SELECT '2.3.7.3' AS categoria, LEAST(SUM(puntos_limited), 20) AS puntos_limited
            FROM (
            SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT documento, puntosporactividad,
                    CASE 
                        WHEN documento = '2.3.7.3' THEN 20
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.3.7.3%'
            ) AS subquery_9
            GROUP BY documento, limite 
            ) AS subquery_3
            UNION ALL
            SELECT '2.3.7.4' AS categoria, LEAST(SUM(puntos_limited), 20) AS puntos_limited
            FROM (
            SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT documento, puntosporactividad,
                    CASE 
                        WHEN documento = '2.3.7.4' THEN 20
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '2.3.7.4%'
            ) AS subquery_9
            GROUP BY documento, limite 
            ) AS subquery_3
        ) AS subquery_4
    ) AS final_query";

        $stmt = $conexion->prepare($query);
        $stmt->bind_param("iiiiiiiiii", $idDocente, $idDocente, $idDocente, $idDocente, $idDocente, $idDocente , $idDocente, $idDocente, $idDocente , $idDocente);
        $stmt->execute();
        $stmt->bind_result($sumaTotal_2_3);
        $stmt->fetch();
        $stmt->close();
        $sumaTotal_2_3 = min($sumaTotal_2_3, 250);

    return $sumaTotal_2_3; 
}




function obtenerPuntosTotales3_1($conexion, $idDocente) {

    $query = "
        SELECT '3.1' AS categoria, LEAST(SUM(puntos_limited), 90) AS puntos_limited
        FROM (
            SELECT '3.1.1' AS categoria, LEAST(SUM(puntos_limited), 40) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '3.1.1.1' THEN 40
                        WHEN subdocumento = '3.1.1.2' THEN 40
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '3.1.1%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
            ) AS subquery_3

            UNION ALL
            SELECT '3.1.2' AS categoria, LEAST(SUM(puntos_limited), 40) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '3.1.2.1' THEN 40
                        WHEN subdocumento = '3.1.2.2' THEN 40
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '3.1.2%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
            ) AS subquery_3

            UNION ALL
            SELECT '3.1.3' AS categoria, LEAST(SUM(puntos_limited), 50) AS puntos_limited
            FROM (
            SELECT documento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT documento, puntosporactividad,
                    CASE 
                        WHEN documento = '3.1.3' THEN 50
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND (documento LIKE '3.1.3%' )
            ) AS subquery_2
            GROUP BY documento, limite 
            ) AS subquery_3
    ) AS final_query";

        $stmt = $conexion->prepare($query);
        $stmt->bind_param("iii", $idDocente, $idDocente, $idDocente);
        $stmt->execute();
        $stmt->bind_result($categoria, $sumaTotal_3_1);
        $stmt->fetch();
        $stmt->close();
        $sumaTotal_3_1 = min($sumaTotal_3_1, 100);
    return $sumaTotal_3_1; 
}
function obtenerPuntosTotales3_2($conexion, $idDocente) {
    $query = "
        SELECT '3.2' AS categoria, LEAST(SUM(puntos_limited), 80) AS puntos_limited
        FROM (
            SELECT '3.2.1' AS categoria, LEAST(SUM(puntos_limited), 60) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '3.2.1.1' THEN 60
                        WHEN subdocumento = '3.2.1.2' THEN 40
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '3.2.1%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
            ) AS subquery_3

            UNION ALL
            SELECT '3.2.2' AS categoria, LEAST(SUM(puntos_limited), 20) AS puntos_limited
            FROM (
            SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
            FROM (
                SELECT subdocumento, puntosporactividad,
                    CASE 
                        WHEN subdocumento = '3.2.2.1' THEN 10
                        WHEN subdocumento = '3.2.2.2' THEN 10
                        ELSE 0 
                    END AS limite
                FROM documentos
                WHERE id_docente = ? AND documento LIKE '3.2.2%'
            ) AS subquery_2
            GROUP BY subdocumento, limite
            ) AS subquery_3
    ) AS final_query";

        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ii", $idDocente, $idDocente);
        $stmt->execute();
        $stmt->bind_result($categoria, $sumaTotal_3_2);
        $stmt->fetch();
        $stmt->close();
        $sumaTotal_3_2 = min($sumaTotal_3_2, 100);

    return $sumaTotal_3_2; 
}

function obtenerPuntosTotales3_3($conexion, $idDocente) {

    $query = "
        SELECT '3.3' AS categoria, LEAST(SUM(puntos_limited), 80) AS puntos_limited
        FROM (
        SELECT subdocumento, LEAST(SUM(puntosporactividad), limite) AS puntos_limited
        FROM (
            SELECT subdocumento, puntosporactividad,
                CASE 
                    WHEN subdocumento = '3.3.1' THEN 20
                    WHEN subdocumento = '3.3.2' THEN 20
                    WHEN subdocumento = '3.3.3' THEN 20
                    WHEN subdocumento = '3.3.4' THEN 40
                    WHEN subdocumento = '3.3.5' THEN 40
                    WHEN subdocumento = '3.3.6' THEN 60
                    WHEN subdocumento = '3.3.7' THEN 80
                    ELSE 0 
                END AS limite
            FROM documentos
            WHERE id_docente = ? AND documento LIKE '3.3%'
        ) AS subquery_8
        GROUP BY subdocumento, limite
    ) AS final_query";

        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $idDocente);
        $stmt->execute();
        $stmt->bind_result($categoria, $sumaTotal_3_3);
        $stmt->fetch();
        $stmt->close();
        $sumaTotal_3_3 = min($sumaTotal_3_3, 100);

    return $sumaTotal_3_3; 
}
?>



