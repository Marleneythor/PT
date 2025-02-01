<?php
include '../Login/auth.php'; // Protege la página
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="vh-100 d-flex flex-column">
    <div class="container mt-3 flex-grow-1 overflow-auto">
        <h1 class="text-center mb-3">REQUISITOS DE INICIO</h1>
        <div class="text-start mb-3">
            <button class="btn btn-secondary" onclick="history.back();" aria-label="Regresar a la página anterior">Regresar</button>
        </div>

        <form action="requisitosDeInicio.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el número de requisito:</label>
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion();">
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="1">01.- Constancia de recursos humanos</option>
                        <option value="2">02.- Talon de pago</option>
                        <option value="3">03.- Carga Academica</option>
                        <option value="4">04.- Carta Exclusividad</option>
                        <option value="5">05.- Proyecto de investigación</option>
                        <option value="6">06.- CV</option>
                        <option value="7">07.- Constancia de materias</option>
                        <option value="8">08.- Autorización de periodo sabatico</option>
                        <option value="9">09.- Licencia Por gravidez</option>
                        <option value="10">10.- Cedula profesional</option>
                        <option value="11">11.- Constancia de cumplimiento actividades docentes</option>
                        <option value="12">12.- Carta de liberación actividades academicas</option>
                        <option value="13">13.- Evaluaciones departamentales</option>
                        <option value="14">14.- Evaluaciones de desempeño</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="descripcion_documento" class="form-label">Descripción del documento:</label>
                    <textarea id="descripcion_documento" class="form-control" rows="4" disabled>Selecciona un número de requisito para ver la descripción.</textarea>
                </div>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Selecciona un archivo (PDF, JPG o Word, máximo 500 KB):</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>

            <div class="text-center">
                <input type="submit" value="Subir Archivo" class="btn btn-primary">
                <div id="botonCrearDocumento" class="text-center mt-3" style="display: none;">
                    <button onclick="crearDocumento()" class="btn btn-success">Crear Documento</button>
                </div>
            </div>
        </form>

        <div class="overflow-auto" style="max-height: 40vh;">
            <h2 class="text-center mb-3">Documentos Subidos</h2>
            <div id="documentsContainer" class="border rounded p-3 bg-light"></div>
        </div>

    </div>

    <script src="scripts.js" defer></script>
     
</body>
</html>
