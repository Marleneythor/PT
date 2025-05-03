<?php
include '../../../Login/auth.php'; 
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto 2.2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../style.css">
</head>
<body class="vh-100 d-flex flex-column">
    <div class="sticky-top bg-white p-3 shadow titulo">
        <div class="d-flex align-items-center position-relative">
            <button class="btn btn-secondary position-absolute start-0" onclick="history.back();" aria-label="Regresar a la página anterior">
                <i class="bi bi-arrow-left"></i>
            </button>
            <h2 class="text-center flex-grow-1 mb-0">2.2. PRODUCTOS DE INVESTIGACIÓN APLICADA CON CRÉDITO AL TECNM</h2>
        </div>
            <h2 class="text-center mb-0">150 Puntos</h2>
            
    </div>
    <div class="container mt-3 flex-grow-1 overflow-auto">
        <form action="subirDocumento.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3" id="formulario">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el número de documento:</label>
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion();">
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="2.2.1">2.2.1. Desarrollo de Software (con instructivo de operación).</option>
                        <option value="9">Tipos de Propiedad Industrial y Protección de Innovaciones.</option>
                        <option value="2.2.7">2.2.7. Derechos de autor (Excepto software con reserva de derechos)</option>
                        <option value="2.2.8">2.2.8 Desarrollo de Curso Masivo en Línea (MOOCs)</option>
                        <option value="2.2.9">2.2.9. Desarrollo de Software para los Procesos de la Dirección General del TecNM.</option>
                        <option value="2.2.10">2.2.10. Diseño y desarrollo de diplomados y/o especializaciones, relacionados con los proyectos estratégicos del TecNM</option>
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
                <label for="file" class="form-label">Subir documento (PDF, JPG o Word, máximo 500 KB):</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
            <div class="container">
            <div id="pregunta2_2_1" class="text-center" style="display: none;">
                <div class="mb-3 d-inline-block text-start w-100">
                    <label for="calculo" class="form-label">¿Cuántas veces desarrollo esta actividad?</label>
                    <input type="number" name="calculo1" id="calculo1" class="form-control"  min="0" step="1">
                </div>
            </div>
        </div>
        <div class="container">
            <div id="pregunta2_2_8" class="text-center" style="display: none;">
                <div class="mb-3 d-inline-block text-start w-100">
                    <label for="calculo" class="form-label">¿Cuántas veces desarrollo esta actividad?</label>
                    <input type="number" name="calculo2" id="calculo2" class="form-control"  min="0" step="1">
                </div>
            </div>
        </div>
            
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta" style="display: none;" >
                    <div class="col-md-6">
                        <label for="opcion" class="form-label">Nivel de posgrado en que trabajo como Asesor(a), Director(a) o Co-Director(a):</label>
                        <select name="opcion" id="opcion" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="2.2.2">Modelo de utilidad.</option>
                            <option value="2.2.3">Patente. (Se considerará patentes durante tres años a partir de la fecha en que se obtiene).</option>
                            <option value="2.2.4">Secreto industrial.</option>
                            <option value="2.2.5">Trazado de circuito integrado.</option>
                            <option value="2.2.6">Registro de Marca, Signo Distintivo y Lemas Comerciales.</option>
                        </select>  
                    </div>
                    <div class="col-md-6">
                        <label for="calculo3" class="form-label">¿Cuántas veces desarrollo esta actividad?</label>
                        <input type="number" name="calculo3" id="calculo3" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>
            <div class="mb-4 text-center">
            <input type="submit" value="Subir Archivo" class="btn btn-primary" id="btn-submit" disabled style="opacity: 0.5;">
            </div> 
        </form>
        </div>
        <div class="sticky-top p-3 shadow menu">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-center mb-3 flex-grow-1">Documentos Subidos</h2>
                <button id="toggleButton" class="btn btn-secondary" onclick="toggleDocuments()">
                    ▼
                </button>
            </div>

            <div id="documentsContainer" class="border rounded p-3 bg-light overflow-auto color" style="max-height: 30vh; display: none;">
                <!-- Aquí se cargarán los documentos -->
            </div>
        </div>
        
    <script src="2.2.js" defer></script>
     
</body>
</html>
