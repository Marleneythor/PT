<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" type="text/css" href="RI.css">
</head>
<body>
    <h2> Requisitos de Inicio</h2>
    <?php
    include '../conexion/conexion.php'; // Asegúrate de que esta ruta sea correcta

    if (!$conexion) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Manejar la subida de archivos
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['archivo'])) {
        $opcion = $_POST['opciones'];
        $nombre_archivo = $_FILES['archivo']['name'];
        $tipo_archivo = $_FILES['archivo']['type'];
        $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
        $nombre = $_POST['nombre'] ?? 'Nombre Predeterminado';

        // Insertar en la base de datos
        $stmt = $conexion->prepare("INSERT INTO RI (requisito, nombre, archivo, tipo_archivo, nombre_archivo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $opcion, $nombre, $archivo, $tipo_archivo, $nombre_archivo);
        $stmt->execute();
        $stmt->close();
    }

    // Seleccionar archivos de la base de datos
    $sqlSeleccionarArchivos = "SELECT * FROM RI";
    $resultado = $conexion->query($sqlSeleccionarArchivos);
    ?>

    <form id="myForm" enctype="multipart/form-data" method="POST">
        <label for="opciones">Selecciona una opción:</label>
        <select id="opciones" name="opciones" onchange="mostrarDescripcion()">
            <option value="0">Seleccione un Requisito</option>
            <option value="1">Opción 1</option>
            <option value="2">Opción 2</option>
            <option value="3">Opción 3</option>
            <option value="4">Opción 4</option>
            <option value="5">Opción 5</option>
            <option value="6">Opción 6</option>
            <option value="7">Opción 7</option>
            <option value="8">Opción 8</option>
            <option value="9">Opción 9</option>
            <option value="10">Opción 10</option>
            <option value="11">Opción 11</option>
            <option value="12">Opción 12</option>
            <option value="13">Opción 13</option>
            <option value="14">Opción 14</option>
        </select>
        <br>
        <div id="botonCrearDocumento" style="display: none;">
            <button type="button" onclick="crearDocumento()">Crear documento</button>
        </div>

        <div id="descripcion-container">
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" readonly>
        </div>
        <br>
        <div id="vistaPrevia" style="display: none;">
            <h3>Vista Previa del Documento</h3>
            <iframe id="iframeVistaPrevia" width="100%" height="400"></iframe>
        </div>

        <label for="archivo">Selecciona un archivo (PDF, Word o JPG no mayor a 700 KB):</label>
        <input type="file" id="archivo" name="archivo" accept=".pdf, .doc, .docx, .jpg" required>
        <br>

        <button type="submit">Subir Archivo</button>
    </form>

    <h2>Archivos Cargados</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Requisito</th>
                <th>Nombre</th>
                <th>Archivo</th>
                <th>Descargar</th>
                <th>Eliminar</th>
                <th>Vista Previa</th>
            </tr>
        </thead>
        <tbody id="tablaArchivos">
            <?php
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['requisito']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre_archivo']) . "</td>";
                    echo '<td><a href="descargar.php?id=' . $row['id'] . '">Descargar</a></td>';
                    echo '<td><a href="eliminar.php?id=' . $row['id'] . '">Eliminar</a></td>';
                    echo '<td><a href="#" onclick="mostrarVistaPrevia(\'' . base64_encode($row['archivo']) . '\', \'' . $row['tipo_archivo'] . '\')">Vista previa</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay archivos cargados.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        let opcionCounter = {};

        function mostrarDescripcion() {
            const opcionSeleccionada = document.getElementById('opciones').value;
            const descripciones = {
                '1': 'Desempeño a la docencia',
                '2': 'Constancia académica',
                '7': 'Opción especial 7',
            };
            const descripcionSeleccionada = descripciones[opcionSeleccionada] || 'Descripción predeterminada';
            const descripcionCampo = document.getElementById('descripcion');
            descripcionCampo.value = descripcionSeleccionada;
            const botonCrearDocumento = document.getElementById('botonCrearDocumento');
            botonCrearDocumento.style.display = (opcionSeleccionada === '7') ? 'block' : 'none';
        }

        function limpiarFormulario() {
            document.getElementById('opciones').value = '0';
            document.getElementById('botonCrearDocumento').style.display = 'none';
            document.getElementById('descripcion').value = '';
            document.getElementById('vistaPrevia').style.display = 'none';
            document.getElementById('archivo').value = '';
            document.getElementById('iframeVistaPrevia').src = '';
            document.getElementById('opciones').focus();
        }

        function mostrarVistaPrevia(archivo, tipo_archivo) {
            const vistaPreviaDiv = document.getElementById('vistaPrevia');
            const iframeVistaPrevia = document.getElementById('iframeVistaPrevia');
            if (tipo_archivo === 'application/pdf' || tipo_archivo === 'application/msword' || tipo_archivo === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                vistaPreviaDiv.style.display = 'block';
                iframeVistaPrevia.src = 'data:' + tipo_archivo + ';base64,' + archivo;
            } else {
                vistaPreviaDiv.style.display = 'none';
            }
        }

        function crearDocumento() {
            window.location.href = 'Generar_RI7.html';
        }

        function cambiarNombreArchivo(originalName, opcion) {
            const extension = originalName.split('.').pop();
            const nuevoNombre = opcion + '.' + (opcionCounter[opcion] || 1) + '.' + extension;
            opcionCounter[opcion] = (opcionCounter[opcion] || 1) + 1;
            return nuevoNombre;
        }

        function ordenarFilas() {
            const tablaArchivos = document.getElementById('tablaArchivos');
            const rows = tablaArchivos.getElementsByTagName('tr');
            const rowsArray = Array.from(rows);
            rowsArray.sort((a, b) => {
                const aValue = a.cells[0].innerHTML;
                const bValue = b.cells[0].innerHTML;
                return aValue.localeCompare(bValue, undefined, { numeric: true, sensitivity: 'base' });
            });
            for (let i = 0; i < rowsArray.length; i++) {
                tablaArchivos.appendChild(rowsArray[i]);
            }
        }
    </script>
</body>
</html>
