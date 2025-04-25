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
    background-color:  #003366;
}
    .color{
        background-color: #F1EFEC !important;
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
                    
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion(); actualizarTitulo(); actualizarText(); textFile();textFile2();">
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
                        <textarea id="puntos" class="form-control" rows="3" disabled></textarea>
                    </div>
                    <div class="col-md-6">  
                        <label for="puntosmax" class="form-label">Puntuacion maxima:</label>
                        <textarea id="puntosmax" class="form-control" rows="3" disabled></textarea>
                    </div>
                </div>
            <div id="subir" class="text-center" style="display: none;">
                <div class="mb-3 d-inline-block text-start w-100">
                    <label for="file" class="form-label">Subir documento (PDF, JPG o Word, máximo 500 KB):</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="subir2" style="display: none;">
                    <div class="col-md-6">
                        <label id="textfile1" class="form-label"></label>
                        <input type="file" name="file1" id="file1" class="form-control">
                    </div> 
                    <div class="col-md-6">
                        <label id="textfile2" class="form-label"></label>
                        <input type="file" name="file2" id="file2" class="form-control">
                    </div> 
                </div>
            </div>

             <!-- Seccion de selects-->
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta1" style="display: none;" >
                    <div class="col-md-6">
                        <label for="opcion1" class="form-label">Selecione el el lugar en donde impartio el evento o curso:</label>
                        <select name="opcion1" id="opcion1" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="2.3.2.1">Estatal/Regional.</option>
                            <option value="2.3.2.2">Nacional</option>
                            <option value="2.3.2.3"> Internacional (fuera del país)</option>
                        </select>  
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta2" style="display: none;" >
                    <div class="col-md-6">
                        <label for="opcion2" class="form-label">Selecione el nivel que alcanzó el proyecto que asesoro: </label>
                        <select name="opcion2" id="opcion2" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="2.3.3.1">3º Lugar Nacional.</option>
                            <option value="2.3.3.2">2º Lugar Nacional.</option>
                            <option value="2.3.3.3">1º Lugar Nacional.</option>
                            <option value="2.3.3.4">3º Lugar Internacional (fuera del país).</option>
                            <option value="2.3.3.5">2º Lugar Internacional (fuera del país).</option>
                            <option value="2.3.3.6">1º Lugar Internacional (fuera del país).</option>
                        </select>  
                    </div>
                    <div class="col-md-6">
                        <label for="calculo2" class="form-label">¿Cuántas veces desarrollo esta actividad?</label>
                        <input type="number" name="calculo2" id="calculo2" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta3" style="display: none;" >
                    <div class="col-md-6">
                        <label for="opcion3" class="form-label">Selecione la conferencia o potencia en eventos externos en que participo:</label>
                        <select name="opcion3" id="opcion3" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="2.3.5.1.1">Conferencia o ponencia en el TecNM.</option>
                            <option value="2.3.5.1.1">Conferencia o ponencia fuera del TecNM.</option>
                            <option value="2.3.5.1.3">. Conferencia o ponencia fuera del país.</option>
                        </select>  
                    </div>
                    <div class="col-md-6">
                        <label for="calculo3" class="form-label">¿Cuántas veces desarrollo esta actividad?</label>
                        <input type="number" name="calculo3" id="calculo3" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta4" style="display: none;" >
                    <div class="col-md-6">
                        <label for="opcion4" class="form-label">Selecione el servicio tecnológico en el que participo:</label>
                        <select name="opcion4" id="opcion4" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="2.3.7.1.1">Adaptación de tecnología.</option>
                            <option value="2.3.7.1.2">Diseño y desarrollo de software.</option>
                            <option value="2.3.7.1.3">Diseño y construcción de prototipos y equipos.</option>
                            <option value="2.3.7.1.4">Diseño de procesos productivos.</option>
                            <option value="2.3.7.1.5">Diseño y desarrollo de nuevos productos o materiales.</option>
                            <option value="2.3.7.1.6">Diseño para la mejora de procesos o sistemas de producción.</option>
                            <option value="2.3.7.1.7">Paquetes tecnológicos.</option>
                            <option value="2.3.7.1.8"> Proyectos llave en mano.</option>
                        </select>  
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta5" style="display: none;" >
                    <div class="col-md-6">
                        <label for="opcion5" class="form-label">Selecione el servicio técnico y certificacion externa en el que participo: </label>
                        <select name="opcion5" id="opcion5" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="2.3.7.2.1">Asesoría y/o consultoría y asistencia técnica.</option>
                            <option value="2.3.7.2.2">Evaluaciones, caracterizaciones, análisis, pruebas, certificaciones y ensayos en laboratorios y talleres.</option>
                            <option value="2.3.7.2.3">Reparación, instalación y mantenimiento de equipos y maquinaria.</option>
                            <option value="2.3.7.2.4"> Dictámenes, peritajes y pruebas de laboratorio.</option>
                            <option value="2.3.7.2.5">Cursos de capacitación por solicitud de la entidad externa.</option>
                        </select>  
                    </div>
                    <div class="col-md-6">
                        <label for="calculo5" class="form-label">¿Cuántas veces desarrollo esta actividad?</label>
                        <input type="number" name="calculo5" id="calculo5" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>

                 <!-- Seccion de puntos-->
        
            
            <div id="calcular" class="text-center" style="display: none;">
                <div class="mb-3 d-inline-block text-start w-100">
                    <label id="texto" class="form-label"></label>
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
