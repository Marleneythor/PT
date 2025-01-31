<?php
include '../../../Login/auth.php'; // Protege la página
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
        <h1 class="text-center mb-3">1.1 PROMOCIÓN DEL APRENDIZAJE</h1>
        <div class="text-start mb-3">
            <button class="btn btn-secondary" onclick="history.back();" aria-label="Regresar a la página anterior">Regresar</button>
        </div>

        <form action="subirDocumento.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el número de documento:</label>
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion();">
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="1">1.1.1 Asignaturas de licenciatura diferentes por año. </option>
                        <option value="2">1.1.2 Profesor(a) impartiendo una asignatura adicional de licenciatura (desde la séptima por año)</option>
                        <option value="3">1.1.3 Asignaturas de posgrado diferentes por año.</option>
                        <option value="4">1.1.4 Estudiantes atendidos en la modalidad escolarizada, no escolarizada y mixta.</option>
                        <option value="5">1.1.5 Tutoría a estudiantes de licenciatura en el PIT</option>
                        <option value="6">1.1.6 Profesor(a) impartiendo asignaturas en programa acreditado o PNPC/SNP</option>
                        <option value="7">1.1.7 Profesor(a) responsable de créditos complementarios autorizados</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="descripcion_documento" class="form-label">Descripción del documento:</label>
                    <textarea id="descripcion_documento" class="form-control" rows="4" disabled>Selecciona un número de documento para ver la descripción.</textarea>
                </div>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Selecciona un archivo (PDF, JPG o Word, máximo 500 KB):</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>

            <div class="text-center">
                <input type="submit" value="Subir Archivo" class="btn btn-primary">
                
            </div>
        </form>

        <div class="overflow-auto" style="max-height: 40vh;">
            <h2 class="text-center mb-3">Documentos Subidos</h2>
            <div id="documentsContainer" class="border rounded p-3 bg-light"></div>
        </div>

    </div>

    <script src="1.1.js" defer></script>
     
</body>
</html>
