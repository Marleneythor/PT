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
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #F1EFEC;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900" style="background-color: #F1EFEC;">


        <?php
        include 'navbar.php'
        ?>


    <!-- Contenido -->
    <div class="container mx-auto mt-24 px-4 text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-black mb-4">Bienvenido al Folder Digital EDD</h1>
        <p class="text-lg text-gray-700 mb-6">Seleccione un bloque para almacenar sus documentos</p>
        
        <div class="flex flex-wrap justify-center gap-4">
            <a href="../Menu/evaluacion1/menuE1.php" class="bg-blue-900 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-300 hover:text-gray-900 transition">1. La dedicación en las actividades de la docencia</a>
            <a href="../Menu/evaluacion2/menuE2.php" class="bg-blue-900 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-300 hover:text-gray-900 transition">2. La calidad en el desempeño de la docencia</a>
            <a href="../Menu/evaluacion3/3View.php" class="bg-blue-900 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-300 hover:text-gray-900 transition">3. La permanencia en las actividades de la docencia</a>
            <a href="../Menu/generarEva/evaFinal.php" class="bg-blue-900 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-300 hover:text-gray-900 transition">Generar Evaluación</a>

        </div>
    </div>

    <script>
        document.getElementById("menu-toggle").addEventListener("click", function() {
            document.getElementById("mobile-menu").classList.toggle("hidden");
        });
    </script>
</body>
</html>
