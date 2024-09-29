<?php

session_start();

// Comprobar si se han cargado archivos
if (isset($_FILES['archivo'])) {
    extract($_POST);
    $requisito = $_POST['opciones']; // Cambia 'requisito' a 'opciones'
    $descripcion = $_POST['descripcion'];

    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Incluir la conexión a la base de datos
    include "db.php";

    // Obtener el nombre y apellido desde la sesión
    $nombre_usuario = $_SESSION['ap1'];
    $apellido_usuario = $_SESSION['ap2'];

    // Contar cuántos archivos ya hay para el requisito
    $sql_count = "SELECT COUNT(*) AS total FROM documento WHERE requisito = '$requisito'";
    $resultado_count = mysqli_query($conexion, $sql_count);
    $fila_count = mysqli_fetch_assoc($resultado_count);
    $contador_archivos = $fila_count['total']; // Número de archivos ya subidos para el requisito

    // Validar y mover los archivos
    foreach ($_FILES['archivo']['tmp_name'] as $key => $tmp_name) {
        $nombre_archivo = basename($_FILES["archivo"]["name"][$key]);
        $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

        // Validar la extensión del archivo
        if ($extension == "pdf" || $extension == "doc" || $extension == "docx" || $extension == "jpg") {
            // Incrementar el contador para obtener el nuevo nombre
            $contador_archivos++; // Incrementar el contador

            // Crear un nuevo nombre para el archivo basado en el nombre, apellido, y número de requisito
            $nuevo_nombre_archivo = $nombre_usuario . "_" . $apellido_usuario . "_R" . $requisito . "." . $contador_archivos . "." . $extension;

            // Mover el archivo a la carpeta de destino
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"][$key], $carpeta_destino . $nuevo_nombre_archivo)) {
                // Insertar la información del archivo en la base de datos
                $sql = "INSERT INTO documento (requisito, descripcion, archivo) 
                VALUES ('$requisito', '$descripcion', '$nuevo_nombre_archivo')";
                $resultado = mysqli_query($conexion, $sql);
                
                if (!$resultado) {
                    echo "<script language='JavaScript'>
                    alert('Error al subir el archivo: $nuevo_nombre_archivo');
                    location.assign('../views/index.php');
                    </script>";
                    exit;
                }
            } else {
                echo "<script language='JavaScript'>
                alert('Error al mover el archivo: $nuevo_nombre_archivo.');
                location.assign('../views/index.php');
                </script>";
                exit;
            }
        } else {
            echo "<script language='JavaScript'>
            alert('Solo se permiten archivos PDF, DOC, DOCX o JPG.');
            location.assign('../views/index.php');
            </script>";
            exit;
        }
    }

    echo "<script language='JavaScript'>
    alert('Archivos Subidos');
    location.assign('../views/index.php');
    </script>";
}
?>
