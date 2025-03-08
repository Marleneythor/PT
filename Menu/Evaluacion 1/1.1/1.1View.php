<?php
include '../../../Login/auth.php'; 
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto 1.1</title>
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
            <h1 class="text-center flex-grow-1 mb-0">1.1 PROMOCIÓN DEL APRENDIZAJE</h1>
        </div>
            <h2 class="text-center mb-0">200 Puntos</h2>
            
    </div>
    <div class="container mt-3 flex-grow-1 overflow-auto">
        <form action="subirDocumento.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el número de documento:</label>
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion(); actualizarText();">
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="1.1.1">1.1.1 Asignaturas de licenciatura diferentes por año. </option>
                        <option value="1.1.2">1.1.2 Profesor(a) impartiendo una asignatura adicional de licenciatura (desde la séptima por año)</option>
                        <option value="1.1.3">1.1.3 Asignaturas de posgrado diferentes por año.</option>
                        <option value="1.1.4">1.1.4 Estudiantes atendidos en la modalidad escolarizada, no escolarizada y mixta.</option>
                        <option value="1.1.5">1.1.5 Tutoría a estudiantes de licenciatura en el PIT</option>
                        <option value="1.1.6">1.1.6 Profesor(a) impartiendo asignaturas en programa acreditado o PNPC/SNP</option>
                        <option value="1.1.7">1.1.7 Profesor(a) responsable de créditos complementarios autorizados</option>
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
                        <textarea id="puntos" class="form-control" rows="2" disabled></textarea>
                    </div>
                    <div class="col-md-6">  
                        <label for="puntosmax" class="form-label">Puntuacion maxima:</label>
                        <textarea id="puntosmax" class="form-control" rows="2" disabled></textarea>
                    </div>
                </div>
            <div class="mb-3">
                <label for="file" class="form-label">Subir documento (PDF, JPG o Word, máximo 500 KB):</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
           
            
            <div class="container">
                <!-- Sección para 1.1.4 (pregunta con nivel y número de estudiantes) -->
                <div class="row g-3 mb-3 align-items-center" id="pregunta1_1_4" style="display: none;">
                    <div class="col-md-6">
                        <label for="nivel_estudiantes" class="form-label">Selecciona el nivel en que atendió a los estudiantes:</label>
                        <select name="nivel_estudiantes" id="nivel_estudiantes" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="licenciatura">Licenciatura</option>
                            <option value="posgrado">Posgrado</option>
                        </select>  
                    </div>
                    <div class="col-md-6">
                        <label for="num_estudiantes" class="form-label">Número de estudiantes atendidos:</label>
                        <input type="number" name="num_estudiantes" id="num_estudiantes" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>
            <div class="container">
                <!-- Sección para 1.1.5 -->
                <div class="row g-3 mb-3 align-items-center" id="pregunta1_1_5" style="display: none;">
                    <div class="col-md-6">
                        <label for="ciclo" class="form-label">Selecciona el periodo de estudiantes atendidos:</label>
                        <select name="ciclo" id="ciclo" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="1.1.5.1">Estudiantes atendidos en Ene-Jun.</option>
                            <option value="1.1.5.2">Estudiantes atendidos en Ago-Dic.</option>
                        </select>  
                    </div>
                    <div class="col-md-6">
                        <label for="num_estudiantes_1_1_5" class="form-label">Número de estudiantes atendidos:</label>
                        <input type="number" name="num_estudiantes_1_1_5" id="num_estudiantes_1_1_5" class="form-control"  min="0" step="1">
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

                <div class="mb-4 text-center">
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

            <div id="documentsContainer" class="border rounded p-3 bg-light overflow-auto color" style="max-height: 30vh; display: none;">
                <!-- Aquí se cargarán los documentos -->
            </div>
        </div>
        

    

    <script src="1.1.js" defer></script>
     
</body>
</html>
