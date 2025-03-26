<?php
include "../conexion/conexion.php";

$id_docente = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Obtener el nombre del docente
$query_docente = "SELECT CONCAT(Nombres, ' ', ApellidoPaterno, ' ', ApellidoMaterno) AS nombre_completo FROM docentes WHERE id_docente = $id_docente";
$result_docente = mysqli_query($conexion, $query_docente);
$docente = mysqli_fetch_assoc($result_docente);
$nombre_docente = $docente ? $docente['nombre_completo'] : 'Desconocido';

$query = "SELECT id_documento, nombre_documento FROM documentos WHERE id_docente = $id_docente";
$result = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos del Docente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex justify-between items-center bg-gray-800 text-white p-4">
        <h2 class="text-xl font-bold">Documentos de <?php echo htmlspecialchars($nombre_docente); ?></h2>
        <a href="admin.php" class="bg-red-600 px-4 py-2 rounded" >Regresar</a>
    </div>
    <div class="max-w-4xl mx-auto p-6">
        <h2 class="text-xl font-bold mb-4">Documentos Cargados</h2>
        <ul class="space-y-1">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <li class="flex justify-between items-center bg-white p-3 shadow rounded">
                    <span class="text-gray-800 font-medium"><?php echo htmlspecialchars($row['nombre_documento']); ?></span>
                    <div class="space-x-2">
                        <a href="ver_documento.php?id=<?php echo $row['id_documento']; ?>" class="bg-green-600 text-white px-3 py-1 rounded">Ver</a>
                        <a href="editar_documento.php?id=<?php echo $row['id_documento']; ?>" class="bg-yellow-600 text-white px-3 py-1 rounded">Editar</a>
                        <a href="eliminar_documento.php?id=<?php echo $row['id_documento']; ?>" class="bg-red-600 text-white px-3 py-1 rounded">Eliminar</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
