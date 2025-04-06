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
<body class="vh-100 d-flex flex-column  " style="background-color: #ede2d3;">
  
                <center><h2 class="fw-bold" style="color: #003366; font-size: 3rem;">Puntos Acumulados:</h2></center>
                <div class=" justify-content-center align-items-center mt-6">
                    <p id="puntos" class="fs-5 fw-bold text-dark mb-0">Cargando...</p>
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
