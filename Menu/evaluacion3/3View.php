<?php
include '../../Login/auth.php'; 
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body{
            background-color: #F1EFEC;
          
        }
        h1{
            color: white;
            font-weight: bold;
           
        }
        h2{
            color: white; 
        }
        .menu {
    background-color:  #123458;
}
    .color{
        background-color: #F1EFEC !important;
    }
    .titulo{
        background-color: #123458 !important;
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
            <h1 class="text-center flex-grow-1 mb-0">3. LA PERMANENCIA EN LAS ACTIVIDADES DE LA DOCENCIA.</h1>
        </div>
            <h2 class="text-center mb-0">100 Puntos</h2>
            
    </div>
    <div class="container mt-3 flex-grow-1 overflow-auto">
        <form action="subirDocumento.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3">
            <div class="row g-3 mb-3 align-items-center">
            <h3 id="titulo"class="text-center flex-grow-1 mb-0"></h3>
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el número de documento:</label>
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion(); actualizarTitulo();">
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="3.1.1">3.1.1 Cursos recibidos de formación docente y actualización profesional.</option>
                        <option value="3.1.2">3.1.2 Diplomados con constancias de acreditación relacionados con su función docente.</option>
                        <option value="3.1.3">3.1.3 Diplomados relacionados con los proyectos estratégicos del tecnm</option>
                        <option value="3.2.1">3.2.1 Comisiones especiales.</option>
                        <option value="3.2.2">3.2.2 Participación en actividades de promoción, admisión o inscripción para nuevo ingreso.</option>
                        <option value="3.3">3.3 Nombramientos de apoyo a la docencia en el período a evaluar.</option>
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
                <div class="row g-3 mb-3 align-items-center" id="pregunta3_1_1" style="display: none;" >
                    <div class="col-md-6">
                        <label for="opcion_1" class="form-label">Cursos resividos como:</label>
                        <select name="opcion_1" id="nivel_poopcion_1sgrado" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="3.1.1.1">Formación docente</option>
                            <option value="3.1.1.2">Actualización Profesional</option>
                        </select>  
                    </div>
                    <div class="col-md-6">
                        <label for="calculo1" class="form-label">¿Cuántas veces participo?</label>
                        <input type="number" name="calculo1" id="calculo1" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>

            <div class="container">
                    <div class="row g-3 mb-3 text-center" id="pregunta3_1_2" style="display: none;">
                    <div class="col-md-6, mb-3 d-inline-block text-start w-100">
                        <label for="opcion_2" class="form-label">Nivel académico en que participo como sinodal para titulación u obtención de grado de estudiantes del TecNM :</label>
                        <select name="opcion_2" id="opcion_2" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="3.1.2.1">Registrados en el TecNM.</option>
                            <option value="3.1.2.2">Fuera del TecNM.</option>
                        </select>  
                    </div>
                   
                </div>
            </div>
            <div class="container">
                <!-- Sección para 1.1.4 (pregunta con nivel y número de estudiantes) -->
                <div class="row g-3 mb-3 align-items-center" id="pregunta3_2_1" style="display: none;" >
                    <div class="col-md-6">
                        <label for="opcion_3" class="form-label">Nivel de posgrado en que trabajo como Asesor(a), Director(a) o Co-Director(a):</label>
                        <select name="opcion_3" id="opcion_3" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="3.2.1.1">Comisiones especiales del TecNM.</option>
                            <option value="3.2.1.2">Responsable de comisiones especiales locales.</option>
                            
                        </select>  
                    </div>
                    <div class="col-md-6">
                        <label for="calculo" class="form-label">¿Cuántas veces participo en este nivel de posgrado?</label>
                        <input type="number" name="calculo3" id="calculo3" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>

            <div class="container">
            <div class="row g-3 mb-3 align-items-center" id="pregunta3_2_2" style="display: none;">
                    <div class="col-md-6">
                        <label for="opcion_4" class="form-label">Nivel académico en que participo como sinodal para titulación u obtención de grado de estudiantes del TecNM :</label>
                        <select name="opcion_4" id="opcion_4" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="3.2.2.1">Participación en actividades de promoción para nuevo ingreso.M.</option>
                            <option value="3.2.2.2">Participación en actividades de admisión o inscripción para nuevo ingreso.</option>
                        </select>  
                    </div>
                    <div class="col-md-6">
                        <label for="calculo2" class="form-label">¿Cuántas veces participo en este nivel académico?</label>
                        <input type="number" name="calculo4" id="calculo4" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>

           
            <div class="container">
            <div class="row g-3 mb-3 align-items-center" id="pregunta3_3" style="display: none;">
                    <div class="col-md-6">
                        <label for="opcion_5" class="form-label">Nivel académico en que participo como sinodal para titulación u obtención de grado de estudiantes del TecNM :</label>
                        <select name="opcion_5" id="opcion_5" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="3.3.1">Jefe(a) de laboratorio o taller.</option>
                            <option value="3.3.2">Secretario(a) de academia, consejo o claustro.</option>
                            <option value="3.3.3">Presidente(a) de academia, consejo o claustro.</option>
                            <option value="3.3.4">Coordinador(a) de carrera o posgrado.</option>
                            <option value="3.3.5">Registrados en el TecNM.</option>
                            <option value="3.3.6">Jefe(a) de departamento o Jefe(a) de división.</option>
                            <option value="3.3.7">Subdirector(a).</option>
                        </select>  
                    </div>
                    <div class="col-md-6">
                        <label for="calculo2" class="form-label">¿Cuántas veces participo en este nivel académico?</label>
                        <input type="number" name="calculo5" id="calculo5" class="form-control"  min="0" step="1">
                    </div>
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
        
    <script src="3.js" defer></script>
     
</body>
</html>
