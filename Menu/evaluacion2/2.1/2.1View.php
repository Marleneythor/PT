<?php
include '../../../Login/auth.php'; 
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto 2.1</title>
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
            <h2 class="text-center flex-grow-1 mb-0">2.1. PRODUCCIÓN CIENTÍFICA, TECNOLÓGICA, CUERPOS ACADÉMICOS, REDES DE INVESTIGACIÓN DEL TECNM</h2>
        </div>
            <h2 class="text-center mb-0">250 Puntos</h2>
    </div>
    <div class="container mt-3 flex-grow-1 overflow-auto">
        <form action="subirDocumento.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3">
            <div class="row g-3 mb-3 align-items-center">
                <h3 id="titulo"class="text-center flex-grow-1 mb-0"></h3>
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el número de documento:</label>
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion(); actualizarTitulo();">
                    <option value="" selected disabled>-- Seleccione --</option>
                        <option value="2.1.1.1">2.1.1.1 En revista indizada en journal citation reports o indice conahcyt (160 puntos posibles).</option>
                        <option value="2.1.1.2">2.1.1.2 En revista incluida en otros índices (80 puntos posibles).</option>
                        <option value="2.1.1.3">2.1.1.3 Artículos publicados en el período a evaluar, en extenso en memorias de congresos internacionales o nacionales con arbitraje (40 puntos posibles).</option>
                        <option value="2.1.1.4">2.1.1.4 Libros o capítulos publicados con créditos al TecNM (100 puntos posibles).</option>
                        <option value="2.1.1.5">2.1.1.5 Proyectos de investigación de ciencia básica y aplicada y/o investigación educativa, terminados en el período a evaluar (50 puntos posibles).</option>
                        <option value="2.1.2.1">2.1.2.1 Redes de investigación registradas en TecNM (100 puntos posibles).</option>
                        <option value="2.1.2.2">2.1.2.2 Miembro de Cuerpos Académicos reconocidos por el PRODEP del TecNM (100 puntos posibles).</option>
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
                <div class="row g-3 mb-3 align-items-center" id="info_1" style="display: none;">
                    <div class="col-md-6">
                        <label for="file1" class="form-label">Impresión de pantalla de la página de Clarivate:</label>
                    </div> 
                    <div class="col-md-6">
                        <label for="file2" class="form-label">Constancia emitida por el(la) jefe(a) de departamento académico con vo.bo. de la subdirección académica:</label>
                    </div> 
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="info_2" style="display: none;" >
                    <div class="col-md-6">
                        <label for="file" class="form-label">Copia del comprobante donde se indique el o los índices de la revista con vo.bo. de la subdirección académica:</label>     
                    </div> 
                    <div class="col-md-6">
                        <label for="file" class="form-label">Constancia emitida por el(la) jefe(a) de departamento académico con vo.bo. de la subdirección académica:</label>
                    </div> 
                </div>
            </div>
            
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="info_3" style="display: none;" >
                    <div class="col-md-6">
                    <label for="file" class="form-label">Copia de la carátula del artículo publicado en la cual se mencione la adscripción del autor al Tecnológico Nacional de México:</label>
                    </div> 
                    <div class="col-md-6">
                    <label for="file" class="form-label">Constancia emitida por el jefe(a) de departamento académico convo.bo. de la subdirección académica:</label>   

                    </div>  
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="info_4" style="display: none;" >
                    <div class="col-md-6">
                    <label for="file" class="form-label">Portada e índice del libro con vo.bo. por la dirección del plantel:</label>
                    </div> 
                    <div class="col-md-6">
                    <label for="file" class="form-label">Evidencia en donde se muestre que en el libro aparece la adscripción del autor al Tecnológico Nacional de México:</label>
                    </div> 
                </div>
            </div>
         
           
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="info_7" style="display: none;" >
                    <div class="col-md-6">
                    <label for="file" class="form-label">Constancia de vigencia de la red, emitida por la Dirección dePosgrado, Investigación e Innovación:</label>
                    </div> 
                    <div class="col-md-6">
                    <label for="file" class="form-label">Nombramiento del líder de la red, emitido por la Dirección dePosgrado, Investigación e Innovación:</label>
                    </div> 
                </div>
            </div>
    
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="subir2" style="display: none;">
                    <div class="col-md-6">
                        <input type="file" name="file1" id="file1" class="form-control">
                    </div> 
                    <div class="col-md-6">
                        <input type="file" name="file2" id="file2" class="form-control">
                    </div> 
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="subir21" style="display: none;">
                    <div class="col-md-6">
                        <input type="file" name="file5" id="file4" class="form-control">
                    </div> 
                    <div class="col-md-6">
                        <input type="file" name="file5" id="file5" class="form-control">
                    </div> 
                </div>
            </div>


            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="info_71" style="display: none;" >
                    <div class="col-md-6">
                    <label for="file" class="form-label">Constancia del Líder de la Red que avala la participación de(la)docente como miembro de la Red, con Vo.Bo. de la SubdirecciónAcadémica:</label>
                    </div> 
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="info_41" style="display: none;" >
                    <div class="col-md-6">
                    <label for="file" class="form-label">Constancia de libro o capítulo publicado firmada por el(la) director(a):</label>
                    </div> 
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="subir3" style="display: none;">
                    <div class="col-md-6">
                        <input type="file" name="file3" id="file3" class="form-control">
                    </div> 
                </div>
            </div>

            
            





            <div class="container">
                <!-- Sección para 1.1.4 (pregunta con nivel y número de estudiantes) -->
                <div class="row g-3 mb-3 align-items-center" id="pregunta1" style="display: none;">
                    <div class="col-md-6">
                        <label for="opcion1" class="form-label">Selecciona una opción:</label>
                        <select id="opcion1" name="opcion1" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="" disabled>2.1.1.1.1. Artículo publicado en el periodo a evaluar, en revista indizada en JOURNAL CITATION REPORTS.</option>
                            <option value="2.1.1.1.1.1">&nbsp;&nbsp;&nbsp;2.1.1.1.1.1. Autor principal o Autor de correspondencia</option>
                            <option value="2.1.1.1.1.2">&nbsp;&nbsp;&nbsp;2.1.1.1.1.2. Co-autores</option>

                            <option value="" disabled>2.1.1.1.2. Artículo publicado en el periodo a evaluar, en revistaindizada en JOURNAL CITATION REPORTS. Con participación de estudiantes inscritos en el TecNM.</option>
                            <option value="2.1.1.1.2.1">&nbsp;&nbsp;&nbsp;2.1.1.1.2.1. Autor principal o Autor de correspondencia</option>
                            <option value="2.1.1.1.2.2">&nbsp;&nbsp;&nbsp;2.1.1.1.2.2. Co-autores</option>
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="container">
                <!-- AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA-->
                <div class="row g-3 mb-3 align-items-center" id="pregunta2" style="display: none;">
                    <div class="col-md-6">
                        <label for="opcion2" class="form-label">Selecciona una opción:</label>
                        <select id="opcion2" name="opcion2" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="" disabled>2.1.1.2.1. Artículos publicados en el periodo a evaluar, en revista incluida en otros índices.</option>
                            <option value="2.1.1.2.1.1">&nbsp;&nbsp;&nbsp;2.1.1.2.1.1. Autor principal o Autor de correspondencia</option>
                            <option value="2.1.1.2.1.2">&nbsp;&nbsp;&nbsp;2.1.1.2.1.2. Co-autores</option>

                            <option value="" disabled>2.1.1.2.2. Artículos publicados en el periodo a evaluar, en revista incluida en otros índices. Con participación de estudiantes inscritos en el TecNM</option>
                            <option value="2.1.1.2.2.1">&nbsp;&nbsp;&nbsp;2.1.1.2.2.1. Autor principal o Autor de correspondencia</option>
                            <option value="2.1.1.2.2.1">&nbsp;&nbsp;&nbsp;2.1.1.2.2.2. Co-autores</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="calcular2" class="form-label">Número de estudiantes atendidos:</label>
                        <input type="number" name="calcular2" id="calcular2" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta3" style="display: none;">
                    <div class="col-md-6">
                        <label for="opciones1" class="form-label">Selecciona una opción:</label>
                        <select id="opcion3" name="opcion3" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="" disabled>2.1.1.3.1. Con ISBN o ISSN</option>
                            <option value="2.1.1.3.1.1">&nbsp;&nbsp;&nbsp;2.1.1.3.1.1. Autor principal</option>
                            <option value="2.1.1.3.1.2">&nbsp;&nbsp;&nbsp;2.1.1.3.1.2. Co-autores</option>

                            <option value="" disabled>2.1.1.3.2. Con ISBN o ISSN y participación de estudiantes inscritos en el TecNM</option>
                            <option value="2.1.1.3.2.1">&nbsp;&nbsp;&nbsp;2.1.1.3.2.1. Autor principal</option>
                            <option value="2.1.1.3.2.2">&nbsp;&nbsp;&nbsp;2.1.1.3.2.2. Co-autores</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="calcular3" class="form-label">Número de estudiantes atendidos:</label>
                        <input type="number" name="calcular3" id="calcular3" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta4" style="display: none;">
                    <div class="col-md-6">
                        <label for="opciones1" class="form-label">Selecciona una opción:</label>
                        <select id="opcion4" name="opcion4" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="2.1.1.4.2.1">&nbsp;&nbsp;&nbsp;2.1.1.4.1. Libro publicado con créditos al TecNM (impreso o electrónico), excepto; compilaciones de artículos, antologías, monografías y memorias de congresos.</option>

                            <option value="" disabled>2.1.1.4.2. Capítulo de libro publicado:</option>
                            <option value="2.1.1.4.2.1">&nbsp;&nbsp;&nbsp;2.1.1.4.2.1. Autor principal</option>
                            <option value="2.1.1.4.2.2">&nbsp;&nbsp;&nbsp;2.1.1.4.2.2. Co-autores (máximo cinco)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="calcular4" class="form-label">Número de estudiantes atendidos:</label>
                        <input type="number" name="calcular4" id="calcular4" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta5" style="display: none;">
                    <div class="col-md-6">
                        <label for="opciones1" class="form-label">Selecciona una opción:</label>
                        <select id="opcion5" name="opcion5" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="" disabled>2.1.1.5.1. Proyectos de Investigación con financiamiento</option>
                            <option value="2.1.1.5.1.1">&nbsp;&nbsp;&nbsp;2.1.1.5.1.1. Responsable o Director(a) del proyecto.</option>
                            <option value="2.1.1.5.1.2">&nbsp;&nbsp;&nbsp;2.1.1.5.1.2. Colaborador(a) del proyecto (Máximo 5 docentes).</option>

                            <option value="" disabled>2.1.2.5.2. Proyectos de Investigación Educativa o Ciencia Básica y Aplicada, autorizados por el TecNM.</option>
                            <option value="2.1.1.5.2.1">&nbsp;&nbsp;&nbsp;2.1.2.5.2.1. Responsable del proyecto.</option>
                            <option value="2.1.1.5.2.1">&nbsp;&nbsp;&nbsp;2.1.2.5.2.2. Colaborador(a) del proyecto (Máximo 5 docentes).</option>
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta6" style="display: none;">
                    <div class="col-md-6">
                        <label for="opciones1" class="form-label">Selecciona una opción:</label>
                        <select id="opcion6" name="opcion6" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="2.1.2.1.1">Regional.</option>
                            <option value="2.1.2.1.2">Nacional.</option>
                            <option value="2.1.2.1.3">Internacional.</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="calcular6" class="form-label">Número de estudiantes atendidos:</label>
                        <input type="number" name="calcular6" id="calcular6" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="pregunta7" style="display: none;">
                    <div class="col-md-6">
                        <label for="opciones1" class="form-label">Selecciona una opción:</label>
                        <select id="opcion7" name="opcion7" class="form-select">
                        <option value="" selected disabled>-- Seleccione --</option>
                            <option value="2.1.2.2.1">En Formación.</option>
                            <option value="2.1.2.2.2">En Consolidación.</option>
                            <option value="2.1.2.2.3">Consolidado.</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="calcular7" class="form-label">Número de estudiantes atendidos:</label>
                        <input type="number" name="calcular7" id="calcular7" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row g-3 mb-3 align-items-center" id="preguntax" style="display: none;">
                    <div class="col-md-6">
                        <label for="opciones1" class="form-label">Selecciona una opción:</label>
                        <select id="opcion" name="opciones1" class="form-select">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option value="" disabled></option>
                            <option value="a1">&nbsp;&nbsp;&nbsp;</option>
                            <option value="a2">&nbsp;&nbsp;&nbsp;</option>

                            <option value="" disabled></option>
                            <option value="a1">&nbsp;&nbsp;&nbsp;</option>
                            <option value="a2">&nbsp;&nbsp;&nbsp;</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="calcular" class="form-label">Número de estudiantes atendidos:</label>
                        <input type="number" name="calcular" id="calcular" class="form-control"  min="0" step="1">
                    </div>
                </div>
            </div>


            <!-- Seccion de puntos--> 

            <div id="calcular" class="text-center" style="display: none;">
                <div class="mb-3 d-inline-block text-start w-100">
                    <input type="number" name="calculo" id="calculo" class="form-control" min="0" step="1">
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

    <script src="2.1.js" defer></script>
     
</body>
</html>