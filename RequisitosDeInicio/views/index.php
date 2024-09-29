<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUBIR WORD & PDF - Tabla de Archivos</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css"> 

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</head>

<body>
<div class="container">
    <div class="fixed-header">
        <h1 class="text-center my-4">Requisitos de Inicio</h1>
        <div class="button-group mb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormulario">
                Subir Archivo
            </button>
            <a href="../../Menu/Menu.html">
                <button type="button" class="btn btn-dark">Volver</button>
            </a>
        </div>
    </div>
    <div class="container" style="max-height: 400px; overflow-y: auto;">
    <table class="table table-bordered">
        <thead class="table-light sticky-header">
            <tr>
                <th class="requisito-col">Requisito</th>
                <th>Descripción</th>
                <th>Archivos Subidos</th>
                <th>Opciones</th>
            </tr>
        </thead>
      

            <tbody id="tablaArchivos">
                <?php
                require "../includes/db.php";

                for ($i = 1; $i <= 14; $i++) {
                    $consulta = mysqli_query($conexion, "SELECT descripcion, archivo, id FROM documento WHERE requisito = $i");
                    $archivos = [];
                    while ($fila = mysqli_fetch_assoc($consulta)) {
                        $archivos[] = $fila;
                    }

                    if (!empty($archivos)) {
                        ?>
                        <tr>
                            <td class="requisito-col"><?php echo $i; ?></td>
                            <td><?php echo $archivos[0]['descripcion'] ?? ''; ?></td>
                            <td>
                                <?php
                                foreach ($archivos as $archivo) {
                                    echo htmlspecialchars($archivo['archivo']) . '<br>';
                                }
                                ?>
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: column;">
                                    <?php foreach ($archivos as $archivo):  ?>
                                    <div class="archivo-item" style="margin-bottom: 10px;">
                                        <?php echo htmlspecialchars($archivo['archivo']); ?>
                                        <div style="margin-top: 5px;">
                                            <a href="../includes/download.php?id=<?php echo $archivo['id']; ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-download"></i> Descargar
                                            </a>
                                            <a href="javascript:void(0);" onclick="confirmarEliminacion(<?php echo $archivo['id']; ?>)" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                            <a href="../includes/vista_previa.php?archivo=<?php echo urlencode($archivo['archivo']); ?>" class="btn btn-info btn-sm" target="_blank">
                                                <i class="fas fa-eye"></i> Vista Previa
                                            </a>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                    } else {
                        echo "<tr>
                                <td class='requisito-col'>$i</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        </div>
        <div id="vistaPrevia" style="display: none;">
            <h3>Vista Previa del Documento</h3>
            <iframe id="iframeVistaPrevia" width="100%" height="400"></iframe>
        </div>
    </div>

    <!-- Cargar el modal desde otro archivo -->
    <div id="modalPlaceholder"></div>
    <script>
        $(document).ready(function() {
            $("#modalPlaceholder").load("modal.php");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
