<?php
include '../Login/auth.php'; // Protege la página
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú EDD</title>
    <link rel="icon" href="logo.jpg" type="image/jpg" sizes="16x16">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            
            color: #333;
        }
        .navbar {
            background-color: #003366;
        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: 500;
        }
        .navbar-toggler {
            border: none;
        }
        .contenido {
            text-align: center;
            margin-top: 80px;
        }
        .button-container .btn {
            background-color:#003366;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            margin: 10px;
            padding: 15px 20px;
            transition: 0.3s;
        }
        .button-container .btn:hover {
            background-color: #A1E3F9;
            color: #333;
        }
        @media (max-width: 768px) {
            .contenido h1{
                font-size: 1.8rem;
            }
            .button-container .btn {
                width: 100%;
            }
        }
        h1 {
            color: black;
            font-weight: bold;
            font-size: 60;
        }
        @media (max-width: 768px) {
    img {
        width: 70%;
     
    margin-left: -50px; 
    }
}
img {
    float: left;
    margin-right: 20px;
    width: 7%;
    max-width: 150px; /* Nunca será más grande de 300px */
    height: auto; /* Mantiene proporción */
}

    </style>
</head>
<body>
    <!-- Menú de navegación -->
    <nav class="navbar navbar-expand-lg fixed-top shadow">
        <div class="container">
           
          
            <img src="../public/images/fondo.png" class="img" alt="">
 <a class="navbar-brand" href="#">EDD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../RequisitosDeInicio/requisitosDeInicioView.php">Requisitos de Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Buscar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://edd.tecnm.mx/docentes/index.php">Ayuda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cerrarSesion/cerrarSesion.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-5 pt-5">
        <div class="contenido">
            <h1 class="mb-4">Bienvenido al Folder Digital EDD</h1>
            <p>Seleccione un bloque para almacenar sus documentos</p>
            <div class="button-container d-flex flex-wrap justify-content-center">
                <a href="../Menu/Evaluacion 1/MuenuE1.php" class="btn btn-lg">1. La dedicación en las actividades de la docencia</a>
                <a href="../Menu/evaluacion2/MenuE2.php" class="btn btn-lg">2. La calidad en el desempeño de la docencia</a>
                <a href="../Menu/Evaluacion 3/3View.php" class="btn btn-lg">3. La permanencia en las actividades de la docencia</a>
                <a href="GenerarEvaluacion/GenerarE.html" class="btn btn-lg">Generar Evaluación</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
