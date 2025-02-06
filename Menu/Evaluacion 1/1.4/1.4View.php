<?php
include '../../../Login/auth.php'; 
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto 1.4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body{
            background-color: #D1F8EF;
          
        }
        h1{
            color: white;
            font-weight: bold;
           
        }
        h2{
            color: white; 
        }
        .menu {
    background-color:  #003366;
}
    .color{
        background-color: #D1F8EF !important;
    }
    .titulo{
        background-color: #003366 !important;
    }
    .form-label{
        font-weight: bold;
    }
    </style>
</head>
<body class="vh-100 d-flex flex-column">
    <div class="sticky-top bg-white p-3 shadow titulo">
        <div class="d-flex align-items-center position-relative">
            <button class="btn btn-secondary position-absolute start-0" onclick="history.back();" aria-label="Regresar a la página anterior">
                <i class="bi bi-arrow-left"></i>
            </button>
            <h1 class="text-center flex-grow-1 mb-0">1.4 ACTIVIDADES ACADÉMICAS</h1>
        </div>
            <h2 class="text-center mb-0">150 Puntos</h2>
    </div>
    <div class="container mt-3 flex-grow-1 overflow-auto">
        <form action="subirDocumento.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3">
            <div class="row g-3 mb-3 align-items-center">
            <h3 id="titulo"class="text-center flex-grow-1 mb-0"></h3>
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el número de documento:</label>
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion(); actualizarTitulo();">
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="1.4.1">1.4.1. Asesoría en ciencias básicas</option>
                        <option value="1.4.2">1.4.2. Asesoría en concursos académicos</option>
                        <option value="1.4.3">1.4.3. Asesoría a estudiantes premiados</option>
                        <option value="1.4.4">1.4.4. Coordinación en eventos académicos</option>
                        <option value="1.4.5">1.4.5. Jurado en eventos académicos</option>
                        <option value="1.4.6">1.4.6. Evaluación de proyectos y acreditaciones</option>
                        <option value="1.4.7">1.4.7. Participación en auditorías</option>

                        <option value="1.4.8.1">1.4.8.1. Planes y programas de estudio</option>
                        <option value="1.4.8.2">1.4.8.2. Diseño de módulos de especialidad</option>
                        <option value="1.4.8.3">1.4.8.3. Estudios de factibilidad</option>

                        <option value="1.4.9">1.4.9. Formación profesional</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="descripcion_documento" class="form-label">Descripción del documento:</label>
                    <textarea id="descripcion_documento" class="form-control" rows="4" disabled>Selecciona un número de documento para ver la descripción.</textarea>
                </div>
            </div>
            <div  class="row g-3 mb-3 align-items-center">
                    <div class="col-md-6">
                        <label for="puntos" class="form-label">Puntos por actividad:</label>
                        <textarea id="puntos" class="form-control" rows="3" disabled></textarea>
                    </div>
                    <div class="col-md-6">  
                        <label for="puntosmax" class="form-label">Puntuacion maxima:</label>
                        <textarea id="puntosmax" class="form-control" rows="3" disabled></textarea>
                    </div>
                </div>
            <div class="mb-3">
                <label for="file" class="form-label">Selecciona un archivo (PDF, JPG o Word, máximo 500 KB):</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
           
                <div class="text-center">
                    <input type="submit" value="Subir Archivo" class="btn btn-primary">   
                </div> 
            </div>
        </form>

        <div class="sticky-top p-3 shadow menu">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-center mb-3 flex-grow-1">Documentos Subidos</h2>
                <button id="toggleButton" class="btn btn-secondary" onclick="toggleDocuments()">
                    ▼
                </button>
            </div>

            <div id="documentsContainer" class="border rounded p-3 bg-light overflow-auto color" style="max-height: 40vh; display: none;">
                <!-- Aquí se cargarán los documentos -->
            </div>
        </div>

    </div>

    <script src="1.4.js" defer></script>
     
</body>
</html>
