
<?php
include '../../../../Login/auth.php'; // Protege la página
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Evaluación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Formulario de Evaluación Docente</h2>
    <form id="evaluacionForm" action="form.php" method="POST">
        <div class="form-group">
            <label>1.1.1 ¿Cuántas asignaturas diferentes tomó durante el año? (Máx: 6)</label>
            <input type="range" id="asignaturas1" name="asignaturas1" min="1" max="6" value="1" oninput="updateValue(this, 'output1')">
            <output id="output1">1</output>
        </div>

        <div class="form-group">
            <label>1.1.2 ¿Cuántas materias diferentes adicionales al punto 1.1.1? (Máx: 2)</label>
            <input type="range" id="asignaturas2" name="asignaturas2" min="0" max="2" value="0" oninput="updateValue(this, 'output2')">
            <output id="output2">0</output>
        </div>

        <div class="form-group">
            <label>1.1.3 ¿Cuántas asignaturas diferentes de posgrado impartió en el año? (Máx: 4)</label>
            <input type="range" id="asignaturas3" name="asignaturas3" min="0" max="4" value="0" oninput="updateValue(this, 'output3')">
            <output id="output3">0</output>
        </div>

        <div class="form-group">
            <label>1.1.4 ¿Cuántos estudiantes atendió en licenciatura? (Máx: 200)</label>
            <input type="range" id="estudiantes1" name="estudiantes1" min="1" max="200" value="1" oninput="updateValue(this, 'output4')">
            <output id="output4">1</output>
        </div>

        <div class="form-group">
            <label>1.1.4.1 ¿Cuántos estudiantes atendió en posgrado? (Máx: 50)</label>
            <input type="range" id="estudiantes2" name="estudiantes2" min="0" max="50" value="0" oninput="updateValue(this, 'output5')">
            <output id="output5">0</output>
        </div>

        <div class="form-group">
            <label>1.1.5 ¿A cuántos estudiantes impartió tutorías? (Máx: 50)</label>
            <input type="range" id="tutorias" name="tutorias" min="0" max="50" value="0" oninput="updateValue(this, 'output6')">
            <output id="output6">0</output>
        </div>

        <div class="form-group">
            <label>1.1.6 ¿Cuántas asignaturas impartió en programas acreditados? (Máx: 2)</label>
            <input type="range" id="asignaturas4" name="asignaturas4" min="0" max="2" value="0" oninput="updateValue(this, 'output7')">
            <output id="output7">0</output>
        </div>

        <div class="form-group">
            <label>1.1.7 ¿Cuántas actividades complementarias impartió? (Máx: 2)</label>
            <input type="range" id="actividades" name="actividades" min="0" max="2" value="0" oninput="updateValue(this, 'output8')">
            <output id="output8">0</output>
        </div>

        <input type="hidden" name="puntajeFinal" id="puntajeFinal">
        <button type="button" onclick="calcularTotal()">Enviar</button>
    </form>

    <script>
        function updateValue(input, outputId) {
            document.getElementById(outputId).textContent = input.value;
        }

        function calcularTotal() {
            let total = 0;
            total += parseInt(document.getElementById("asignaturas1").value) * 5; // Máx 30
            total += parseInt(document.getElementById("asignaturas2").value) * 10; // Máx 20
            total += parseInt(document.getElementById("asignaturas3").value) * 5; // Máx 20
            total += (parseInt(document.getElementById("estudiantes1").value) * 50) / 200; // Máx 50
            total += parseInt(document.getElementById("estudiantes2").value); // Máx 50
            total += parseInt(document.getElementById("tutorias").value); // Máx 50
            total += parseInt(document.getElementById("asignaturas4").value) * 10; // Máx 20
            total += parseInt(document.getElementById("actividades").value) * 10; // Máx 20

            // Asegurar que no pase el límite de 240
            total = Math.min(total, 240);

            // Guardar el total en el input hidden y enviar el formulario
            document.getElementById("puntajeFinal").value = total;
            document.getElementById("evaluacionForm").submit();
        }
    </script>
</body>
</html>
