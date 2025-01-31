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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #F0EDCF;
            color: #000;
        }
        nav {
            background-color: #0B60B0;
            padding: 1rem;
        }
        nav .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
        }
        nav .navbar-nav .nav-link:hover {
            color: #40A2D8 !important;
        }
        .contenido {
            text-align: center;
            margin-top: 50px;
        }
        h1 {
            color: #0B60B0;
            font-weight: 500;
        }
        p {
            color: #000;
        }
        .button-container .btn {
            background-color: #40A2D8;
            border: none;
            margin: 10px;
            padding: 15px 25px;
            font-size: 1.2rem;
            font-weight: 500;
            color: #fff;
            transition: background-color 0.3s ease;
            border-radius: 8px;
        }
        .button-container .btn:hover {
            background-color: #0B60B0;
            color: #fff;
        }
        .button-container a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>

    <!-- Menú de navegación -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-white" href="#">EDD</a>
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
    <div class="contenido container">
        <h1>Bienvenido al Folder Digital EDD</h1>
        <p>Seleccione un bloque para almacenar sus documentos</p>
        <div class="button-container d-flex justify-content-center flex-wrap">
            <a href="../Menu/Evaluacion 1/MuenuE1.php" class="btn">1. La dedicación en las actividades de la docencia</a>
            <a href="2.html" class="btn">2. La calidad en el desempeño de la docencia</a>
            <a href="3.html" class="btn">3. La permanencia en las actividades de la docencia</a>
            <a href="GenerarEvaluacion/GenerarE.html" class="btn">Generar Evaluación</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-tQfZ5LU1hZksmy9HULCaWldvB5aZZ8odHlMmfF2ksmNba6uAmEzsZnnthFv0Iw4o" crossorigin="anonymous"></script>

</body>
</html>
