<?php
include '../Login/auth.php'; // Protege la página
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Menu/style.css">
</head>
<body class="vh-100 d-flex flex-column">
    <div class="sticky-top bg-white p-3 shadow titulo">

        <div class="d-flex align-items-center position-relative">
            <button class="btn btn-secondary position-absolute start-0" onclick="history.back();" aria-label="Regresar a la página anterior">
                <i class="bi bi-arrow-left"></i>
            </button>
            <h1 class="text-center flex-grow-1 mb-0">REQUISITOS DE INICIO</h1>
        </div>
    </div>
    <div class="container mt-3 flex-grow-1 overflow-auto">
        <form action="requisitosDeInicio.php" method="post" enctype="multipart/form-data" class="p-4 border rounded bg-light mb-3" id="formulario">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-md-6">
                    <label for="document_type" class="form-label">Selecciona el número de requisito:</label>
                    <select name="document_type" id="document_type" class="form-select" required onchange="cargarDocumentoSeleccionado1(); mostrarDescripcion(); ">
                        <option value="" selected disabled>-- Seleccione --</option>
                        <option value="RI1">01.- Constancia de recursos humanos</option>
                        <option value="RI2">02.- Talon de pago</option>
                        <option value="RI3">03.- Carga Academica</option>
                        <option value="RI4">04.- Carta Exclusividad</option>
                        <option value="RI5">05.- Proyecto de investigación</option>
                        <option value="RI6">06.- CV</option>
                        <option value="RI7">07.- Constancia de materias</option>
                        <option value="RI8">08.- Autorización de periodo sabatico</option>
                        <option value="RI9">09.- Licencia por gravidez</option>
                        <option value="RI10">10.- Cedula profesional</option>
                        <option value="RI11">11.- Constancia de cumplimiento actividades docentes</option>
                        <option value="RI12">12.- Carta de liberación actividades academicas</option>
                        <option value="RI13">13.- Evaluaciones departamentales</option>
                        <option value="RI14">14.- Evaluaciones de desempeño</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="descripcion_documento" class="form-label">Descripción del documento:</label>
                    <textarea id="descripcion_documento" class="form-control" rows="4" disabled>Selecciona un número de requisito para ver la descripción.</textarea>
                </div>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Selecciona un archivo (PDF, JPG o Word, máximo 500 KB):</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
            <div class="container">
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
                    <div class="col-md-6">
                        <label for="num_estudiantes" class="form-label">Número de asignaturas de licenciatura diferentes por año:</label>
                        <input type="number" name="calculo" id="calculo" class="form-control" min="0" step="1">
                    </div>
                    <div class="col-md-6">
                        <label for="num_estudiantes" class="form-label">Número de asignaturas de licenciatura diferentes y adicional a las declaradas en el 1.1.1. (Se considerará a partir de la séptima asignatura diferente por año):</label>
                        <input type="number" name="calculo2" id="calculo2" class="form-control" min="0" step="1">
                    </div>
                    <div class="col-md-6">
                        <label for="num_estudiantes" class="form-label">Número de asignaturas de posgrado diferentes por año:</label>
                        <input type="number" name="calculo3" id="calculo3" class="form-control" min="0" step="1">
                    </div>
                </div>
            </div>
          <div class="container">
            <div class="row g-3 mb-3 text-center" id="pregunta1_4_9" style="display: none;">
                <div class="col-md-6, mb-3 d-inline-block text-start w-100">
                     <label for="opcion_10" class="form-label">¿Cuál es su máximo grado de estudios en formación profesional?</label>
                     <select name="opcion_10" id="opcion_10" class="form-select">
                         <option value="" selected disabled>-- Seleccione --</option>
                         <option value="1.4.9.1">Profesor(a) con Doctorado.</option>
                         <option value="1.4.9.2">Profesor(a) con Maestría.</option>
                      </select>  
                 </div>
             </div>
         </div>


            <div class="text-center d-flex justify-content-center gap-3">
            <input type="submit" value="Subir Archivo" class="btn btn-primary" id="btn-submit" disabled style="opacity: 0.5;"> 
                <div id="botonCrearDocumento" style="display: none;">
                    <button onclick="crearDocumento()" class="btn btn-success">Crear Documento</button>
                </div>
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

            <div id="documentsContainer" class="border rounded p-3 bg-light overflow-auto" style="max-height: 40vh; display: none;">
                <!-- Aquí se cargarán los documentos -->
            </div>
        </div>
    <script src="scripts.js" defer></script>
     
</body>
</html>
