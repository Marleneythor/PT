<?php
include "../conexion/conexion.php";

$query = "SELECT d.id_docente, CONCAT(d.Nombres, ' ', d.ApellidoPaterno, ' ', d.ApellidoMaterno) AS nombre_completo, 
                 COALESCE(SUM(doc.puntosporactividad), 0) AS puntaje_total 
          FROM docentes d
          LEFT JOIN documentos doc ON d.id_docente = doc.id_docente
          GROUP BY d.id_docente";

$result = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex justify-between items-center bg-gray-800 text-white p-4">
        <h2 class="text-xl font-bold">Panel de Administración</h2>
        <a class="bg-red-600 px-4 py-2 rounded" href="../index.php">Cerrar sesión</a>
    </div>
    <div class="p-6">
        <div class="w-full max-w-4xl mx-auto">
            <div class="grid grid-cols-3 bg-gray-300 text-gray-800 font-bold p-3 rounded">
                <div class="text-center">Nombre</div>
                <div class="text-center">Puntaje</div>
                <div class="text-center">Acción</div>
            </div>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="grid grid-cols-3 bg-white p-3 mt-2 shadow rounded">
                    <div class="text-center"><?php echo htmlspecialchars($row['nombre_completo']); ?></div>
                    <div class="text-center"><?php echo htmlspecialchars($row['puntaje_total']); ?></div>
                    <div class="text-center">
                        <a href="detalle.php?id=<?php echo $row['id_docente']; ?>" class="bg-blue-600 text-white px-4 py-2 rounded">Ver Detalles</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
