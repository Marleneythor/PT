<?php
session_start();
include "../../conexion/conexion.php";
include "../funciones.php";

if (!isset($_SESSION['usuario'])) {
    echo json_encode(["error" => "No hay sesión activa."]);
    exit;
}

$usuario = $_SESSION['usuario'];
$stmt = $conexion->prepare("SELECT id_docente FROM docentes WHERE Usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($idDocente);
$stmt->fetch();
$stmt->close();

if (!$idDocente) {
    echo json_encode(["error" => "No se encontró el docente."]);
    exit;
}

$sumaTotal_1_1 = obtenerPuntosTotales1_1($conexion, $idDocente);
$sumaTotal_1_2 = obtenerPuntosTotales1_2($conexion, $idDocente);
$sumaTotal_1_3 = obtenerPuntosTotales1_3($conexion, $idDocente);
$sumaTotal_1_4 = obtenerPuntosTotales1_4($conexion, $idDocente);
$sumaTotal_2_1 = obtenerPuntosTotales2_1($conexion, $idDocente);
$sumaTotal_2_2 = obtenerPuntosTotales2_2($conexion, $idDocente);
$sumaTotal_2_3 = obtenerPuntosTotales2_3($conexion, $idDocente);
$sumaTotal_3_1 = obtenerPuntosTotales3_1($conexion, $idDocente);
$sumaTotal_3_2 = obtenerPuntosTotales3_2($conexion, $idDocente);
$sumaTotal_3_3 = obtenerPuntosTotales3_3($conexion, $idDocente);

// Calcular totales
$total_1 = min($sumaTotal_1_1 + $sumaTotal_1_2 + $sumaTotal_1_3 + $sumaTotal_1_4, 300);
$total_2 = min($sumaTotal_2_2 + $sumaTotal_2_1 + $sumaTotal_2_3, 600);
$total_3 = min($sumaTotal_3_1 + $sumaTotal_3_2 + $sumaTotal_3_3, 100);
$total_f = min($total_1 + $total_2 + $total_3, 1000);
// Estilos para la tabla
echo "<style>
        table { 
            width: 90%; 
            margin: 50px auto; 
            border-collapse: collapse; 
            font-family: Arial, sans-serif; 
            border: 3px solid black; 
        }
        th, td { 
            border: 2px solid black; 
            padding: 10px; 
        }
        th { 
            background-color: #dcdcdc; 
            font-weight: bold; 
            text-align: center;
        }
        td { 
            text-align: left; 
        }

        /* Primera columna con alineación a la izquierda */
        td:first-child { 
            padding-left: 15px; 
            text-align: left; 
            font-weight: normal; 
        }

        /* Títulos de bloque centrados */
        td.block-title { 
            text-align: left; 
            font-weight: bold; 
            background-color: #a6a6a6;
            border: 2px solid black;
            padding-left: 10px;
        }
        td.block-title2 { 
            text-align: center; 
            font-weight: bold; 
            background-color: #a6a6a6;
            border: 2px solid black;
            padding-left: 10px;
        }

        /* Estilos para los valores numéricos alineados a la derecha */
        td.num { 
            text-align: center; 
            font-weight: bold; 
        }

        /* Estilos para las filas de total */
        td.total { 
            text-align: right; 
            font-weight: bold; 
            background-color: #dcdcdc;
        }

        /* Última fila con TOTAL */
        td.final-total {
            background-color: #a6a6a6;
            font-weight: bold;
            text-align: center;
        }
        td.footer { 
            background-color: #a6a6a6;
            font-weight: bold;
            text-align: center;
            border: 2px solid black;
        }

      </style>";

echo "<table>";
echo "<tr><th colspan='3'>PUNTUACIÓN GENERAL</th></tr>";
echo "<tr><th>CONCEPTO</th><th>MÁXIMA PUNTUACIÓN</th><th>PUNTUACIÓN ESTIMADA POR EL DOCENTE</th></tr>";

echo "<tr><td class='block-title'>1. LA DEDICACIÓN EN LAS ACTIVIDADES DE LA DOCENCIA</td> <td class='block-title2'>300</td><td class='block-title2'></td></tr>";
echo "<tr><td>1.1 PROMOCIÓN CON EL APRENDIZAJE</td><td class='num'>200</td><td class='num'>$sumaTotal_1_1</td></tr>";
echo "<tr><td>1.2 APOYO A LA DOCENCIA</td><td class='num'>150</td><td class='num'>$sumaTotal_1_2</td></tr>";
echo "<tr><td>1.3 ASESORÍA PARA TITULACIÓN INTEGRAL O DIRECCIÓN DE TESIS</td><td class='num'>100</td><td class='num'>$sumaTotal_1_3</td></tr>";
echo "<tr><td>1.4 ACTIVIDADES ACADÉMICAS</td><td class='num'>150</td><td class='num'>$sumaTotal_1_4</td></tr>";
echo "<tr><td class='total'>Total Bloque 1</td><td class='num'></td><td class='num'><strong>$total_1</strong></td></tr>";

echo "<tr><td class='block-title'>2. LA CALIDAD EN EL DESEMPEÑO DE LA DOCENCIA</td> <td class='block-title2'>600</td><td class='block-title2'></td></tr>";
echo "<tr><td>2.1 PRODUCCIÓN CIENTÍFICA, TECNOLÓGICA, CUERPOS ACADÉMICOS, REDES DE INVESTIGACIÓN DEL TECNM</td><td class='num'>250</td><td class='num'>$sumaTotal_2_1</td></tr>";
echo "<tr><td>2.2 PRODUCTOS DE INVESTIGACIÓN APLICADA CON CRÉDITO AL TECNM</td><td class='num'>150</td><td class='num'>$sumaTotal_2_2</td></tr>";
echo "<tr><td>2.3 ACTIVIDADES DE VINCULACIÓN ACADÉMICA</td><td class='num'>200</td><td class='num'>$sumaTotal_2_3</td></tr>";
echo "<tr><td class='total'>Total Bloque 2</td><td class='num'></td><td class='num'><strong>$total_2</strong></td></tr>";

echo "<tr><td class='block-title' >3. LA PERMANENCIA EN LAS ACTIVIDADES DE LA DOCENCIA</td> <td class='block-title2'>100</td><td class='block-title2'></td></tr>";
echo "<tr><td>3.1 FORMACIÓN Y ACTUALIZACIÓN ACADÉMICA</td><td class='num'>90</td><td class='num'>$sumaTotal_3_1</td></tr>";
echo "<tr><td>3.2 COMISIONES ACADÉMICAS</td><td class='num'>80</td><td class='num'>$sumaTotal_3_2</td></tr>";
echo "<tr><td>3.3 NOMBRAMIENTOS DE APOYO A LA DOCENCIA EN EL PERÍODO A EVALUAR (LOS NOMBRAMIENTOS NO SON EXCLUYENTES)</td><td class='num'>80</td><td class='num'>$sumaTotal_3_3</td></tr>";
echo "<tr><td class='total'>Total Bloque 3</td><td class='num'></td><td class='num'><strong>$total_3</strong></td></tr>";

echo "<tr><td class='final-total'>TOTAL</td><td class='num'>1000</td><td class='num'><strong>$total_f</strong></td></tr>";
echo "<tr>
        <td class='footer'>PUNTUACIÓN GENERAL</td>
        <td class='footer' colspan='2'>TOTAL<br>ESTIMADO POR EL DOCENTE</td>
      </tr>";

echo "</table>";

?>
