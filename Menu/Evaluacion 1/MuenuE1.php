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
            <button class="btn  list-group-item list-group-item-action btn-info d-block w-100" type="button" onclick="window.location.href='1.1/1.1View.php'">
                1.1 PROMOCIÓN CON EL APRENDIZAJE 200
            </button>
        </div>
        
        <div class="dropdown mb-3">
            <button class="btn list-group-item list-group-item-action btn-success d-block w-100" type="button" onclick="window.location.href='1.2/1.2View.php'">
                1.2 APOYO A LA DOCENCIA 150
            </button>
        </div>

        <div class="dropdown mb-3">
            <button class="btn  list-group-item list-group-item-action btn-info d-block w-100" type="button" onclick="window.location.href='1.3/1.3View.php'">
                1.3 ASESORÍA PARA TITULACIÓN INTEGRAL O DIRECCIÓN DE TESIS 100
            </button>
        </div>

        <div class="dropdown mb-3">
            <button class="btn list-group-item list-group-item-action btn-warning mb-3 d-block w-100" type="button" onclick="window.location.href='1.4/1.4View.php'">
                1.4 ACTIVIDADES ACADÉMICAS 150
            </button>
        </div>
    </div>

    <h2>Puntos Acumulados:</h2>
    <p id="puntos">Cargando...</p>

    <script>
        fetch('puntosAcumulados.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('puntos').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    </script>


</div>

<!-- Enlazamos el script de Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
