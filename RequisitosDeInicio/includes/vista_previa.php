<?php
// vista_previa.php
if (isset($_GET['archivo'])) {
    $archivo = $_GET['archivo'];

    // Validar que el archivo existe
    $rutaArchivo = 'files/' . basename($archivo);
    if (file_exists($rutaArchivo)) {
        // Obtener la extensión del archivo
        $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

        // Establecer el Content-Type en función de la extensión
        switch ($extension) {
            case 'pdf':
                header('Content-Type: application/pdf');
                break;
            case 'jpg':
            case 'jpeg':
                header('Content-Type: image/jpeg');
                break;
            case 'png':
                header('Content-Type: image/png');
                break;
            case 'gif':
                header('Content-Type: image/gif');
                break;
            case 'doc':
                header('Content-Type: application/msword');
                header('Content-Disposition: inline; filename="' . basename($archivo) . '"');
                break;
            case 'docx':
                header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                header('Content-Disposition: inline; filename="' . basename($archivo) . '"');
                break;
            default:
                echo "Formato de archivo no soportado para vista previa.";
                exit;
        }

        // Leer y mostrar o descargar el archivo
        readfile($rutaArchivo);
        exit;
    } else {
        echo "Archivo no encontrado.";
    }
} else {
    echo "No se ha especificado ningún archivo.";
}
?>
