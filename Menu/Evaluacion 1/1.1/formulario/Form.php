<?php
include '../../../Login/auth.php'; // Protege la página
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación y Documentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Formulario de Evaluación</h1>

        <!-- Formulario de Evaluación -->
        <form id="evaluacionForm" action="sendInfoEvaluacion.php" method="POST" class="p-4 border rounded bg-light mb-4">
            <div class="mb-3">
                <label for="p1">1.1.1 ¿Cuántas asignaturas diferentes tomó durante el año?</label>
                <input type="number" id="p1" name="preguntas[]" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="p2">1.1.2 ¿Cuántas materias diferentes adicionales al punto 1.1.1?</label>
                <input type="number" id="p2" name="preguntas[]" class="form-control" min="0" required>
            </div>
            <div>
            <label for="p3">1.1.3 ¿Cuántas asignaturas diferentes de posgrado impartió en el año?</label>
            <input type="number" id="p3" name="preguntas[]" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="p4">1.1.4 ¿Cuántos estudiantes atendió en licenciatura?</label>
                <input type="number" id="p4" name="preguntas[]" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="p5">1.1.4.1 ¿Cuántos estudiantes atendió en posgrado?</label>
                <input type="number" id="p5" name="preguntas[]" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="p6">1.1.5 ¿A cuántos estudiantes impartió tutorías?</label>
                <input type="number" id="p6" name="preguntas[]" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="p7">1.1.6 ¿Cuántas asignaturas impartió en programas educativos acreditados?</label>
                <input type="number" id="p7" name="preguntas[]" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="p8">1.1.7 ¿Cuántas actividades complementarias impartió?</label>
                <input type="number" id="p8" name="preguntas[]" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <p id="totalScore">Puntaje Total: 0</p>
            </div>
            <input type="hidden" id="puntajeFinal" name="puntajeFinal" value="0">
            <button type="submit" class="btn btn-primary">Guardar Evaluación</button>
            <a href="../MuenuE1.php" class="btn btn-primary btn-link-style">Volver</a>
        </form>

       

    <!-- JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts personalizados -->
    <!-- <script>
        function cargarDocumentoSeleccionado() {
            const select = document.getElementById('document_type');
            const documentType = select.value;
            const documentsContainer = document.getElementById('documentsContainer');
            const botonGenerar = document.getElementById('botonGenerarDocumento');

            documentsContainer.innerHTML = "<p class='text-info'>Cargando documentos...</p>";

            const xhr = new XMLHttpRequest();
            xhr.open("GET", `mostrarDocumentos.php?document_type=${documentType}`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    documentsContainer.innerHTML = xhr.responseText;
                } else if (xhr.readyState === 4) {
                    documentsContainer.innerHTML = "<p class='text-danger'>Error al cargar los documentos.</p>";
                }
            };
            xhr.send();

            botonGenerar.style.display = (documentType === "ConstanciaDeMaterias") ? "block" : "none";
        }

        function eliminarArchivo(idDocumento, rutaArchivo) {
            if (confirm("¿Estás seguro de que deseas eliminar este archivo?")) {
                const formData = new FormData();
                formData.append("id_documento", idDocumento);
                formData.append("ruta_archivo", rutaArchivo);

                const xhr = new XMLHttpRequest();
                xhr.open("POST", "eliminarDocumento.php", true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert(xhr.responseText);
                        document.getElementById('document_type').dispatchEvent(new Event('change'));
                    }
                };
                xhr.send(formData);
            }
        }
    </script> -->
</body>
</html>

















