<?php
include '../../Login/auth.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Eva.1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
   <link rel="stylesheet" href="./menu1.css">
</head>
<body class="vh-100 d-flex flex-column">
    <div class="sticky-top  p-3 shadow marco">
        <div class="d-flex align-items-center position-relative">
            <button class="btn btn-escape position-absolute start-0" onclick="history.back();" aria-label="Regresar a la página anterior">
                <i class="bi bi-arrow-left"></i>
            </button>
            <h1 class="text-center flex-grow-1 mb-0"> 1. LA DEDICACIÓN EN LAS ACTIVIDADES DE LA DOCENCIA</h1>
        </div>
        <h2 class="text-center mb-0">300 Posibles puntos</h2>
    </div>
  
    <div class="container mt-3 flex-grow-1 overflow-auto content-box">
    <br>
    <div class="list-group text-center">
        <div class="dropdown mb-3">
            <button class="btn dropdown-toggle list-group-item list-group-item-action btn-info  d-block w-100" type="button" id="dropdown1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                1.1 PROMOCIÓN CON EL APRENDIZAJE 200
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown1">
                <a class="dropdown-item" href="1.1/1.1View.php">Subir Documentación</a>
                <a class="dropdown-item" href="1.1/formulario/Form.php">Realizar Formulario</a>
            </div>
        </div>
        
        <div class="dropdown mb-3">
            <button class="btn dropdown-toggle list-group-item list-group-item-action btn-success  d-block w-100" type="button" id="dropdown2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                1.2 APOYO A LA DOCENCIA 150
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown2">
                <a class="dropdown-item" href="1.2/1.2View.php">Subir Documentación</a>
                <a class="dropdown-item" href="1.2/1.2View.php">Realizar Formulario</a>
            </div>
        </div>

        <div class="dropdown mb-3">
            <button class="btn dropdown-toggle list-group-item list-group-item-action btn-info  d-block w-100" type="button" id="dropdown3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                1.3 ASESORÍA PARA TITULACIÓN INTEGRAL O DIRECCIÓN DE TESIS 100
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown3">
                <a class="dropdown-item" href="1.3/1.3View.php">Subir Documentación</a>
                <a class="dropdown-item" href="1.3/1.3.html">Realizar Formulario</a>
            </div>
        </div>

        <div class="dropdown mb-3">
            <button class="btn dropdown-toggle list-group-item list-group-item-action btn-warning mb-3  d-block w-100" type="button" id="dropdown4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                1.4 ACTIVIDADES ACADÉMICAS 150
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown4">
                <a class="dropdown-item" href="1.4/1.4View.php">Subir Documentación</a>
                <a class="dropdown-item" href="1.4/1.4.html">Realizar Formulario</a>
            </div>
        </div>
    </div>
</div>

<!-- Enlazamos el script de Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
