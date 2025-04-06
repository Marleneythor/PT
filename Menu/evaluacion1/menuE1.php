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
<body class="vh-100 d-flex flex-column" style="background-color: #F1EFEC;">

    <div class="sticky-top p-3 shadow marco">
        <div class="d-flex align-items-center position-relative">
            <button class="btn btn-escape position-absolute start-0" onclick="history.back();" aria-label="Regresar a la página anterior">
                <i class="bi bi-arrow-left"></i>
            </button>
            <h1 class="text-center flex-grow-1 mb-0">1. LA DEDICACIÓN EN LAS ACTIVIDADES DE LA DOCENCIA</h1> 
        </div>
        <h2 class="text-center mt-2 mb-0">300 Posibles puntos</h2>
    </div>
  
    <div class="container-fluid mt-2 flex-grow-6 overflow-auto content-box" style="background-color: #F1EFEC;">
    <div class="row justify-content-center">
        <div class="col-lg-9"> <!-- 75% del ancho para botones -->
            <div class="card shadow- p-4 w-100 text-center  rounded-4" style="background-color: #ede2d3;">
                <div class="list-group text-center">
                    <button class="btn list-group-item list-group-item-action btn-info mb-4 py-2" onclick="window.location.href='1.1/1.1View.php'">
                        1.1 Promoción con el aprendizaje - 200 puntos
                    </button>
                    <button class="btn list-group-item list-group-item-action btn-info mb-4 py-2" onclick="window.location.href='1.2/1.2View.php'">
                        1.2 Apoyo a la docencia - 150 puntos
                    </button>
                    <button class="btn list-group-item list-group-item-action btn-info mb-4 py-2" onclick="window.location.href='1.3/1.3View.php'">
                        1.3 Asesoría para titulación integral o dirección de tesis - 100 puntos
                    </button>
                    <button class="btn list-group-item list-group-item-action btn-info mb-4 py-2" onclick="window.location.href='1.4/1.4View.php'">
                        1.4 Actividades académicas - 150 puntos
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-3 d-flex align-items-center"> <!-- 25% del ancho para puntos -->
            <div class="card shadow-lg p-4 w-100 text-center bg-gradient rounded-4 " style="background-color: #ede2d3;">
                <h2 class="fw-bold" style="color: #003366; font-size: 1.2rem;">Puntos Acumulados:</h2>
                <div class="d-flex justify-content-center align-items-center mt-6">
                    <i class="bi bi-trophy-fill text-warning fs-2 me-3"></i>
                    <p id="puntos" class="fs-5 fw-bold text-dark mb-0">Cargando...</p>
                </div>
            </div>
        </div>
    </div>
</div>



    <script>
        fetch('puntosAcumulados.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('puntos').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
