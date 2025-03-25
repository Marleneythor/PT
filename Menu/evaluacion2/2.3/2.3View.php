<?php
include '../../../Login/auth.php'; 
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto 2.3</title>
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
            <h1 class="text-center flex-grow-1 mb-0">2.3. ACTIVIDADES DE VINCULACIÓN ACADÉMICA</h1>
        </div>
            <h2 class="text-center mb-0">200 Puntos posibles</h2>
            
    </div>
    <div class="container mt-3 flex-grow-1 overflow-auto">
        <form action="subirDocumento.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3">
            <div class="row g-3 mb-3 align-items-center">
            <h3 id="titulo"class="text-center flex-grow-1 mb-0"></h3>
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el número de documento:</label>
                    
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion(); actualizarTitulo(); actualizarText();">
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="2.3.1.1">2.3.1.1. Visitas a empresas o centros de investigación.</option>
                        <option value="2.3.1.2">2.3.1.2. Certificación en competencias laborales o docentes.</option>
                        <option value="2.3.2">2.3.2. Asesoría en concursos de emprendimiento o innovación.</option>
                        <option value="2.3.3">2.3.3. Asesoría en proyectos premiados o tesis destacadas.</option>
                        <option value="2.3.4.1">2.3.4.1. Asesoría en residencia profesional (no dual).</option>
                        <option value="2.3.4.2">2.3.4.2. Asesoría en educación dual (licenciatura).</option>
                        <option value="2.3.4.3">2.3.4.3. Asesoría en residencia vinculada a proyectos estratégicos.</option>
                        <option value="2.3.5.1">2.3.5.1. Conferencias o ponencias en eventos externos.</option>
                        <option value="2.3.6.1">2.3.6.1. Estancia nacional (mínimo un mes).</option>
                        <option value="2.3.6.2">2.3.6.2. Estancia en el extranjero (mínimo un mes).</option>
                        <option value="2.3.7.1">2.3.7.1. Servicios tecnológicos.</option>
                        <option value="2.3.7.2">2.3.7.2. Servicios técnicos y certificaciones externas.</option>
                        <option value="2.3.7.3">2.3.7.3. Asesoría en incubación de empresas (mínimo 3 meses).</option>
                        <option value="2.3.7.4">2.3.7.4. Asesoría en NODESS.</option>
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
                        <textarea id="puntos" class="form-control" rows="1" disabled></textarea>
                    </div>
                    <div class="col-md-6">  
                        <label for="puntosmax" class="form-label">Puntuacion maxima:</label>
                        <textarea id="puntosmax" class="form-control" rows="1" disabled></textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Subir documento (PDF, JPG o Word, máximo 500 KB):</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>

                <div class="container">
                    <div class="row g-3 mb-3 align-items-center" id="pregunta1_2_2" style="display: none;">
                        <div class="col-md-6">
                            <label for="horas" class="form-label">Número de horas:</label>
                            <input type="number" name="horas" id="horas" class="form-control" min="0" step="1">
                        </div>
                    </div>
                </div>

                 <!-- Seccion de puntos-->
            
            <div id="pregunta1_1_3" class="text-center" >
                <div class="mb-3 d-inline-block text-start w-100">
                    <label id="texto" class="form-label"></label>
                </div>
            </div>
            
            <div id="calcular" class="text-center" style="display: none;">
                <div class="mb-3 d-inline-block text-start w-100">
                    <input type="number" name="calculo" id="calculo" class="form-control" min="0" step="1">
                </div>
            </div>
           
                <div class="text-center">
                    <input type="submit" value="Subir Archivo" class="btn btn-primary">   
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

            <div id="documentsContainer" class="border rounded p-3 bg-light overflow-auto color" style="max-height: 40vh; display: none;">
                <!-- Aquí se cargarán los documentos -->
            </div>
        </div>

    </div>

    <script src="2.3.js" defer></script>
     
</body>
</html>
