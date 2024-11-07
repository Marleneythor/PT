<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo</title>
    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="vh-100 d-flex flex-column">

    <div class="container mt-3 flex-grow-1 overflow-auto">
        <h1 class="text-center mb-3">Subir un Archivo</h1>

        <!-- Botón de Regresar -->
        <div class="text-start mb-3">
            <button class="btn btn-secondary" onclick="history.back();">Regresar</button>
        </div>

        <!-- Formulario -->
        <form action="requisitosDeInicio.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3">
            <!-- Sección de Tipo de Documento y Descripción en Línea -->
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el tipo de documento:</label>
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado()">
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="ConstanciaDeRecursosHumanos">01.- Constancia de recursos humanos</option>
                        <option value="TalonDePago">02.- Talon de pago</option>
                        <option value="CargaAcademica">03.- Carga Academica</option>
                        <option value="CartaExclusividad">04.- Carta Exclusividad</option>
                        <option value="ProyectoDeInvestigación">05.- Proyecto de investigación</option>
                        <option value="CV">06.- CV</option>
                        <option value="ConstanciaDeMaterias">07.- Constancia de materias</option>
                        <option value="AutorizacionDePeriodoSabatico">08.- Autorización de periodo sabatico</option>
                        <option value="LicenciaPorGravidez">09.- Licencia Por gravidez</option>
                        <option value="CedulaProfesional">10.- Cedula profesional</option>
                        <option value="ConstanciaDeCumplimientoActividadesDocentes">11.- Constancia de cumplimiento actividades docentes</option>
                        <option value="CartaDeLiberacionActividadesAcademicas">12.- Carta de liberación actividades academicas</option>
                        <option value="EvaluacionesDepartamentales">13.- Evaluaciones departamentales</option>
                        <option value="EvaluacionesDeDesempeno">14.- Evaluaciones de desempeño</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Descripción del documento:</label>
                    <input type="text" class="form-control" disabled value="Descripción del documento: puedes modificar este texto más tarde.">
                </div>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Selecciona un archivo (PDF o Word, máximo 500 KB):</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>

            <div class="text-center">
                <input type="submit" value="Subir Archivo" class="btn btn-primary">
            </div>
        </form>

        <!-- Sección para visualizar los documentos -->
        <div class="overflow-auto" style="max-height: 40vh;">
            <h2 class="text-center mb-3">Documentos Subidos</h2>
            <div id="documentsContainer" class="border rounded p-3 bg-light">
                <?php
                    // Incluir el archivo que contiene el código para recuperar y mostrar documentos
                    include 'mostrarDocumentos.php'; // Ajusta la ruta al archivo según tu estructura
                ?>
            </div>
        </div>

        <!-- Botón "Generar documento" -->
        <div id="botonGenerarDocumento" class="text-center mt-3" style="display: none;">
            <a href="Requisito7/RI7.html" class="btn btn-success">Generar documento</a>
        </div>

    </div>

    <!-- JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function cargarDocumentoSeleccionado() {
        const select = document.getElementById('document_type');
        const documentType = select.value; // Obtener el valor seleccionado
        const documentsContainer = document.getElementById('documentsContainer');
        const botonGenerar = document.getElementById('botonGenerarDocumento');

        // Mostrar un mensaje de carga
        documentsContainer.innerHTML = "<p class='text-info'>Cargando documentos...</p>";

        // Realizar la solicitud AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `mostrarDocumentos.php?document_type=${documentType}`, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                documentsContainer.innerHTML = xhr.responseText;
            } else if (xhr.readyState === 4) {
                documentsContainer.innerHTML = "<p class='text-danger'>Error al cargar los documentos.</p>";
            }
        };

        xhr.send();

        // Mostrar u ocultar el botón "Generar documento" si se selecciona "Constancia de materias"
        if (documentType === "ConstanciaDeMaterias") {
            botonGenerar.style.display = "block";  // Mostrar el botón
        } else {
            botonGenerar.style.display = "none";  // Ocultar el botón
        }
    }
    </script>

    <script>
    function eliminarArchivo(idDocumento, rutaArchivo) {
        if (confirm("¿Estás seguro de que deseas eliminar este archivo?")) {
            const formData = new FormData();
            formData.append("id_documento", idDocumento);
            formData.append("ruta_archivo", rutaArchivo);

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "eliminarDocumento.php", true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                    // Recargar los documentos después de la eliminación
                    document.getElementById('document_type').dispatchEvent(new Event('change'));
                }
            };

            xhr.send(formData);
        }
    }
    </script>

</body>
</html>
