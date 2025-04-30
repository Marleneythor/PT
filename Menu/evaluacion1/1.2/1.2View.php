<?php
include '../../../Login/auth.php'; 
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto 1.2</title>
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
            <h1 class="text-center flex-grow-1 mb-0">1.2 APOYO A LA DOCENCIA</h1>
        </div>
            <h2 class="text-center mb-0">150 Posibles puntos</h2>
            
    </div>
    <div class="container mt-3 flex-grow-1 overflow-auto">
        <form action="subirDocumento.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3">
            <div class="row g-3 mb-3 align-items-center">
            <h3 id="titulo"class="text-center flex-grow-1 mb-0"></h3>
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el número de documento:</label>
                    
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion(); actualizarTitulo(); actualizarText();">
                    <option value="" selected disabled>-- Seleccione --</option>
                        <option value="1.2.1.1">1.2.1.1 - Proyectos integradores / Recurso Educativo Digital</option>
                        <option value="1.2.1.2">1.2.1.2 - Elaboración de manual de prácticas</option>
                        <option value="1.2.1.3">1.2.1.3 - Implementación de estrategias didácticas innovadoras</option>
                        <option value="1.2.1.4">1.2.1.4 - Diseño y desarrollo de materiales didácticos incluyentes</option>

                        <option value="1.2.2.1">1.2.2.1 - Instructor(a)/Facilitador(a) de cursos de formación docente (30 horas mínimo)</option>
                        <option value="1.2.2.2">1.2.2.2 - Instructor(a)/Facilitador(a) de cursos del TecNM (30 horas mínimo)</option>
                        <option value="1.2.2.3">1.2.2.3 - Instructor(a) del Diplomado de Competencias Docentes</option>
                        <option value="1.2.2.4">1.2.2.4 - Instructor(a) del Diplomado para Formación de Tutores</option>
                        <option value="1.2.2.5">1.2.2.5 - Instructor(a) del Diplomado Recursos Educativos Virtuales</option>
                        <option value="1.2.2.6">1.2.2.6 - Instructor(a) del Diplomado en Educación Inclusiva</option>
                        <option value="1.2.2.7">1.2.2.7 - Instructor(a) de Diplomados estratégicos del TecNM</option>

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

    <script src="1.2.js" defer></script>
     
</body>
</html>
