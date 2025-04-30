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
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion(); actualizarTitulo(); textFile();textFile2();">
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="1.4.1">1.4.1. Asesoría en ciencias básicas (45 Posibles puntos).</option>
                        <option value="1.4.2">1.4.2. Asesoría en concursos académicos (20 Posibles puntos).</option>
                        <option value="1.4.3">1.4.3. Asesoría a estudiantes premiados (50 Posibles puntos).</option>
                        <option value="1.4.4">1.4.4. Coordinación en eventos académicos (35 Posibles puntos).</option>
                        <option value="1.4.5">1.4.5. Jurado en eventos académicos (40 Posibles puntos).</option>
                        <option value="1.4.6">1.4.6. Evaluación de proyectos y acreditaciones (30 Posibles puntos).</option>
                        <option value="1.4.7">1.4.7. Participación en auditorías (30 Posibles puntos).</option>

                        <option value="1.4.8.1">1.4.8.1. Planes y programas de estudio</option>
                        <option value="1.4.8.2">1.4.8.2. Diseño de módulos de especialidad</option>
                        <option value="1.4.8.3">1.4.8.3. Estudios de factibilidad</option>

                        <option value="1.4.9">1.4.9. Formación profesional (120 Posibles puntos).</option>
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
           <!-- Subir dos archivos  -->
            <div id="subir" class="text-center" style="display: none;">
                <div class="mb-3 d-inline-block text-start w-100">
                    <label for="file" class="form-label">Subir documento (PDF, JPG o Word, máximo 500 KB):</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
            </div>
            
           
    
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="subir1_4_1" style="display: none;">
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
    

           
         <!-- Preguntas segun la opcion-->
         <div class="container">
            <div class="row g-3 mb-3 text-center" id="pregunta1_4_1" style="display: none;">
                <div class="col-md-6, mb-3 d-inline-block text-start w-100">
                    <label for="num_estudiantes_1_4_1" class="form-label">Número de estudiantes del TecNM ha asesorado en asignaturas de Ciencias Básicas:</label>
                    <input type="number" name="num_estudiantes_1_4_1" id="num_estudiantes_1_4_1" class="form-control">
                </div>
            </div>
         </div>
         
         <div class="container">
                <div class="row g-3 mb-3 text-center" id="pregunta1_4_2" style="display: none;">
                    <div class="col-md-6, mb-3 d-inline-block text-start w-100">
                     <label for="opcion_1_4_2" class="form-label">Nivel de competencia en que ha brindado asesoría a estudiantes del TecNM en concursos o eventos académicos de ciencias (ENECB, ANFEI, ANFECA, entre otros):</label>
                     <select name="opcion_1_4_2" id="opcion_1_4_2" class="form-select">
                         <option value="" selected disabled>-- Seleccione --</option>
                         <option value="1.4.2.1">Estal/Regional.</option>
                         <option value="1.4.2.2">Nacional.</option>
                         <option value="1.4.2.3">Internacional (fuera del país)</option>
                     </select>  
                 </div>
             </div>
         </div>

         <div class="container">
            <div class="row g-3 mb-3 align-items-center" id="pregunta1_4_3" style="display: none;">
            <div class="col-md-6">
                     <label for="opcion_1_4_3" class="form-label">¿En qué nivel y categoría ha asesorado a estudiantes del TecNM que han sido premiados en concursos o eventos de ciencias (ENECB, ANFEI, ANFECA, entre otros)?</label>
                     <select name="opcion_1_4_3" id="opcion_1_4_3" class="form-select">
                         <option value="" selected disabled>-- Seleccione --</option>
                         <option value="1.4.3.1">3º Lugar Nacional.</option>
                         <option value="1.4.3.2">2º Lugar Nacional.</option>
                         <option value="1.4.3.3">1º Lugar Nacional.</option>
                         <option value="1.4.3.4">3º Lugar Internacional (fuera del país).</option>
                         <option value="1.4.3.5">2º Lugar Internacional (fuera del país).</option>
                         <option value="1.4.3.6">1º Lugar Internacional (fuera del país).</option>
                     </select>  
                 </div>
                 <div class="col-md-6">
                    <label for="calculo" class="form-label">Número de estudiantes que ha brindado asesoría:</label>
                    <input type="number" name="calculo3" id="calculo3" class="form-control"  min="0" step="1">
                </div>
             </div>
         </div>
         <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta1_4_4" style="display: none;">
                    <div class="col-md-6">
                     <label for="opcion_1_4_4" class="form-label">¿En qué rol y nivel ha participado en la coordinación o colaboración de concursos o eventos académicos, innovación tecnológica o emprendimiento (InnovaTecNM, Copa de Ciencias, Robótica, etc.)?</label>
                     <select name="opcion_1_4_4" id="opcion_1_4_4" class="form-select">
                         <option value="" selected disabled>-- Seleccione --</option>
                         <option value="1.4.4.1">Coordinador(a) general Local..</option>
                         <option value="1.4.4.2">Coordinador(a) general Regional.</option>
                         <option value="1.4.4.3">Coordinador(a) general Nacional o Internacional.</option>
                         <option value="1.4.4.4">Coordinador(a) de cartera Local.</option>
                         <option value="1.4.4.5">Coordinador(a) de cartera Regional.</option>
                         <option value="1.3.4.6">Coordinador(a) de cartera Nacional o Internacional.</option>
                         <option value="1.4.4.7">Colaborador(a) Local</option>
                         <option value="1.4.4.8">Colaborador(a) Regional.</option>
                         <option value="1.4.4.9">Coordinador(a) Nacional o Internacional.</option>
                     </select>  
                 </div>
                 <div class="col-md-6">
                    <label for="calculo" class="form-label">¿Cuántas veces ha participado en la coordinación o colaboración de concursos o eventos académicos?</label>
                    <input type="number" name="calculo4" id="calculo4" class="form-control"  min="0" step="1">
                </div>
             </div>
         </div>
         <div class="container">
             <div class="row g-3 mb-3 align-items-center" id="pregunta1_4_5" style="display: none;" >
                    <div class="col-md-6">
                     <label for="opcion_1_4_5" class="form-label">¿En qué nivel ha participado como jurado en eventos académicos (ciencias, innovación tecnológica, concursos de tesis, entre otros)?</label>
                     <select name="opcion_1_4_5" id="opcion_1_4_5" class="form-select">
                         <option value="" selected disabled>-- Seleccione --</option>
                         <option value="1.4.5.1">Local.</option>
                         <option value="1.4.5.2">Estal/Regional.</option>
                         <option value="1.4.5.3">Nacional.</option>
                         <option value="1.4.5.4">Internacional (fuera del país)</option>
                     </select>  
                 </div>
                 <div class="col-md-6">
                    <label for="calculo" class="form-label">¿Cuántas veces ha participado como jurado?</label>
                    <input type="number" name="calculo5" id="calculo5" class="form-control"  min="0" step="1">
                </div>
             </div>
         </div>
         <div class="container">
             <div class="row g-3 mb-3 align-items-center" id="pregunta1_4_6" style="display: none;" >
                    <div class="col-md-6">
                     <label for="opcion_1_4_6" class="form-label">¿En qué nivel ha participado en comités para la evaluación de propuestas de proyectos de investigación o evaluación/acreditación de programas educativos (COPAES, ABET, CONAHCYT, COEPES, PRODEP, entre otros)?</label>
                     <select name="opcion_1_4_6" id="opcion_1_4_6" class="form-select">
                         <option value="" selected disabled>-- Seleccione --</option>
                         <option value="1.4.6.1">Nivel Estal o Regional.</option>
                         <option value="1.4.6.2">Nivel Nacional.</option>
                         <option value="1.4.6.3">Nivel Internacional.</option>
                     </select>  
                 </div>
                 <div class="col-md-6">
                    <label for="calculo" class="form-label">¿Cuántas veces ha participado?</label>
                    <input type="number" name="calculo6" id="calculo6" class="form-control"  min="0" step="1">
                </div>
             </div>
         </div>
         <div class="container">
             <div class="row g-3 mb-3 align-items-center" id="pregunta1_4_7" style="display: none;" >
                    <div class="col-md-6">
                     <label for="opcion_1_4_7" class="form-label">¿En qué tipo de auditoría de sistemas de gestión ha participado (SGC, SGA, SGIG, Igualdad Laboral, ¿entre otros)?</label>
                     <select name="opcion_1_4_7" id="opcion_1_4_7" class="form-select">
                         <option value="" selected disabled>-- Seleccione --</option>
                         <option value="1.4.7.1">Auditor interno en la Institución.</option>
                         <option value="1.4.7.2">Auditor interno fuera de la institución.</option>
                         <option value="1.4.7.3">Auditor líder en la institución.</option>
                         <option value="1.4.7.4">Auditor líder fuera de la institución.</option>
                     </select>  
                 </div>
                 <div class="col-md-6">
                    <label for="calculo" class="form-label">¿Cuántas veces ha participado?</label>
                    <input type="number" name="calculo7" id="calculo7" class="form-control"  min="0" step="1">
                </div>
             </div>
         </div>
         <div class="container">
             <div class="row g-3 mb-3 align-items-center" id="pregunta1_4_8_1" style="display: none;" >
                    <div class="col-md-6">
                     <label for="opcion_1_4_8_1" class="form-label">¿En qué nivel ha participado en la elaboración de planes y programas de estudios y/o seguimiento curricular?</label>
                     <select name="opcion_1_4_8_1" id="opcion_1_4_8_1" class="form-select">
                         <option value="" selected disabled>-- Seleccione --</option>
                         <option value="1.4.8.1.1">Local.</option>
                         <option value="1.4.8.1.2">Nacional.</option>
                      </select>  
                 </div>
                 <div class="col-md-6">
                    <label for="calculo" class="form-label">¿Cuántas veces ha participado en la elaboración de planes y programas de estudios y/o seguimiento curricular?</label>
                    <input type="number" name="calculo8" id="calculo8" class="form-control"  min="0" step="1">
                </div>
             </div>
         </div>
         <div class="container">
            <div class="row g-3 mb-3 text-center" id="pregunta1_4_9" style="display: none;">
                <div class="col-md-6, mb-3 d-inline-block text-start w-100">
                     <label for="opcion_1_4_9" class="form-label">¿Cuál es su máximo grado de estudios en formación profesional?</label>
                     <select name="opcion_1_4_9" id="opcion_1_4_9" class="form-select">
                         <option value="" selected disabled>-- Seleccione --</option>
                         <option value="1.4.9.1">Profesor(a) con Doctorado.</option>
                         <option value="1.4.9.2">Profesor(a) con Maestría.</option>
                      </select>  
                 </div>
             </div>
         </div>
        <div class="container">
            <div id="pregunta1_4_8_3" class="text-center" style="display: none;">
                <div class="mb-3 d-inline-block text-start w-100">
                    <label for="calculo" class="form-label">¿Cuántas veces ha elaborado estudios de factibilidad para la apertura de un programa educativo a nivel licenciatura o posgrado?</label>
                    <input type="number" name="calculo8_3" id="calculo8_3" class="form-control"  min="0" step="1">
                </div>
            </div>
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