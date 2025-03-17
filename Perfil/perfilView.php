<?php
include '../Login/auth.php';
include 'perfil.php'
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Perfil Docente</title>
    </head>
    <body>
        

        <div>
            <?php
            include '../Menu/navbar.php'
            ?>
        </div>

        <div class="container mx-auto p-6">
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 text-2xl font-bold">
                        <span class="material-symbols-outlined">
                            *
                        </span>
                    </div>
                    <h2 class="ml-4 text-2xl font-semibold text-blue-900">Perfil del Docente</h2>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <h3 class="text-xl font-semibold text-blue-800">Información Personal</h3>
                        <p class="text-gray-700"><strong>Nombre:</strong> <?php echo $docente['Nombres'] . " " . $docente['ApellidoPaterno'] . " " . $docente['ApellidoMaterno']; ?></p>
                        <p class="text-gray-700"><strong>CURP:</strong> <?php echo $docente['CURP']; ?></p>
                        <p class="text-gray-700"><strong>Sexo:</strong> <?php echo $docente['Sexo']; ?></p>
                        <p class="text-gray-700"><strong>RFC:</strong> <?php echo $docente['RFC']; ?></p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <h3 class="text-xl font-semibold text-blue-800">Información de Contacto</h3>
                        <p class="text-gray-700"><strong>Celular:</strong> <?php echo $docente['Celular']; ?></p>
                        <p class="text-gray-700"><strong>Correo:</strong> <?php echo $docente['Correo']; ?></p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-lg md:col-span-2">
                        <h3 class="text-xl font-semibold text-blue-800">Detalles Académicos</h3>
                        <p class="text-gray-700"><strong>Grado de Estudio:</strong> <?php echo $docente['GradoEstudio']; ?></p>
                        <p class="text-gray-700"><strong>Escuela/Facultad:</strong> <?php echo $docente['EscuelaFacultad']; ?></p>
                        <p class="text-gray-700"><strong>Nivel Educativo:</strong> <?php echo $docente['NivelEducativo']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
