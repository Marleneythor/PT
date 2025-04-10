<?php
include '../Login/auth.php'; // Protege la página
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para Constancia de Estudiantes</title>
    <!-- Incluir jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- Incluir el plugin jsPDF AutoTable -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.min.js"></script>
    <style>
        .materia-details, .materia2-details {
            margin-bottom: 10px;
        }
        label {
            display: inline-block;
            width: 150px;
            vertical-align: top;
        }
        input {
            margin-bottom: 5px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Formulario para Constancia de Estudiantes Atendidos</h1>
        <form id="constanciaForm" class="p-4 border rounded bg-light shadow-sm">
    
            <div class="mb-3">
                <label for="nombreDocente" class="form-label">Nombre del Docente:</label>
                <input type="text" id="nombreDocente" name="nombreDocente" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label for="carrera" class="form-label">Carrera:</label>
                <input type="text" id="carrera" name="carrera" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" id="fecha" name="fecha" class="form-control" required>
            </div>
    
            <h3 class="mt-4">Semestre 1</h3>
            <div class="mb-3">
                <label for="semestre1" class="form-label">Nombre del Semestre 1:</label>
                <input type="text" id="semestre1" placeholder="hola" name="semestre1" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label for="nivel1" class="form-label">Nivel del semestre 1:</label>
                <input type="text" id="nivel1" name="nivel1" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label for="numMaterias" class="form-label">Número de materias:</label>
                <input type="number" id="numMaterias" name="numMaterias" min="1" class="form-control" required>
            </div>
            <div id="materiaGroup" style="display: none;"></div>
    
            <h3 class="mt-4">Semestre 2</h3>
            <div class="mb-3">
                <label for="semestre2" class="form-label">Nombre del Semestre 2:</label>
                <input type="text" id="semestre2" name="semestre2" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label for="nivel2" class="form-label">Nivel del semestre 2:</label>
                <input type="text" id="nivel2" name="nivel2" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label for="numMaterias2" class="form-label">Número de materias:</label>
                <input type="number" id="numMaterias2" name="numMaterias2" min="1" class="form-control" required>
            </div>
            <div id="materiaGroup2" style="display: none;"></div>
    
            <div class="mb-3">
                <label for="nombresFirmante1" class="form-label">Firmante 1:</label>
                <input type="text" id="nombresFirmante1" name="nombresFirmante1" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label for="nombresFirmante2" class="form-label">Firmante 2:</label>
                <input type="text" id="nombresFirmante2" name="nombresFirmante2" class="form-control" required>
            </div>
    
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Generar Evaluación</button>
            </div>
        </form>
    </div>
    

<script>
    const { jsPDF } = window.jspdf;

    // Mostrar campos de materias para Semestre 1
    document.getElementById('numMaterias').addEventListener('input', function() {
        const numMaterias = parseInt(this.value);
        const materiaGroup = document.getElementById('materiaGroup');
        materiaGroup.innerHTML = '';

        if (numMaterias > 0) {
            materiaGroup.style.display = 'block';
            for (let i = 0; i < numMaterias; i++) {
                const materiaDiv = document.createElement('div');
                materiaDiv.classList.add('materia-details');
                materiaDiv.innerHTML = `
                    <label for="materia${i+1}">Materia ${i+1}:</label>
                    <input type="text" id="materia${i+1}" name="materia${i+1}" placeholder="Nombre de la materia" required>
                    <label for="alumnos${i+1}">Alumnos:</label>
                    <input type="number" id="alumnos${i+1}" name="alumnos${i+1}" placeholder="Número de alumnos" required min="1"><br>
                    <label for="clave${i+1}">Clave:</label>
                    <input type="text" id="clave${i+1}" name="clave${i+1}" placeholder="Clave de la materia" required><br>
                `;
                materiaGroup.appendChild(materiaDiv);
            }
        } else {
            materiaGroup.style.display = 'none';
        }
    });

    // Mostrar campos de materias para Semestre 2
    document.getElementById('numMaterias2').addEventListener('input', function() {
        const numMaterias = parseInt(this.value);
        const materiaGroup = document.getElementById('materiaGroup2');
        materiaGroup.innerHTML = '';

        if (numMaterias > 0) {
            materiaGroup.style.display = 'block';
            for (let i = 0; i < numMaterias; i++) {
                const materiaDiv = document.createElement('div');
                materiaDiv.classList.add('materia2-details');
                materiaDiv.innerHTML = `
                    <label for="materia2${i+1}">Materia ${i+1}:</label>
                    <input type="text" id="materia2${i+1}" name="materia2${i+1}" placeholder="Nombre de la materia" required>
                    <label for="alumnos2${i+1}">Alumnos:</label>
                    <input type="number" id="alumnos2${i+1}" name="alumnos2${i+1}" placeholder="Número de alumnos" required min="1"><br>
                    <label for="clave2${i+1}">Clave:</label>
                    <input type="text" id="clave2${i+1}" name="clave2${i+1}" placeholder="Clave de la materia" required><br>
                `;
                materiaGroup.appendChild(materiaDiv);
            }
        } else {
            materiaGroup.style.display = 'none';
        }
    });

    

    


    document.getElementById('constanciaForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const nivel1 = document.getElementById('nivel1').value; // Capturar el nivel del semestre 1
    const nivel2 = document.getElementById('nivel2').value;
    const nombreDocente = document.getElementById('nombreDocente').value;
    const carrera = document.getElementById('carrera').value;
    const semestre1 = document.getElementById('semestre1').value;
    const semestre2 = document.getElementById('semestre2').value;
    const fecha = document.getElementById('fecha').value;
    const numMaterias = parseInt(document.getElementById('numMaterias').value);
    const numMaterias2 = parseInt(document.getElementById('numMaterias2').value);
    const nombresFirmante1 = document.getElementById('nombresFirmante1').value;
    const nombresFirmante2 = document.getElementById('nombresFirmante2').value;

    let totalEstudiantes = 0;
    let materiaDataArray = [];

    // Recolectamos los datos de las materias del Semestre 1
    for (let i = 0; i < numMaterias; i++) {
        const materia = document.getElementById(`materia${i+1}`).value;
        const alumnos = parseInt(document.getElementById(`alumnos${i+1}`).value);
        const clave = document.getElementById(`clave${i+1}`).value;

        totalEstudiantes += alumnos;
        materiaDataArray.push([materia, alumnos, clave]);
    }

    let totalEstudiantes2 = 0;
    let materia2DataArray = [];

    // Recolectamos los datos de las materias del Semestre 2
    for (let i = 0; i < numMaterias2; i++) {
        const materia2 = document.getElementById(`materia2${i+1}`).value;
        const alumnos2 = parseInt(document.getElementById(`alumnos2${i+1}`).value);
        const clave2 = document.getElementById(`clave2${i+1}`).value;

        totalEstudiantes2 += alumnos2;
        materia2DataArray.push([materia2, alumnos2, clave2]);
    }

    // Verifica si hay al menos una materia en cualquiera de los semestres
    if (materiaDataArray.length > 0 || materia2DataArray.length > 0) {
        
        const doc = new jsPDF();

      // Cargar la imagen en base64
        const img = new Image();
        img.src = 'encabezado.png'; // Ruta de la imagen
 
        // Una vez que la imagen esté cargada, la agregamos al PDF
        doc.addImage(img, 'PNG', 10, 10, 190, 30); // (imagen, formato, x, y, ancho, alto)
     
    let currentY = 80; // Ajusta según sea necesario
        // Inicializar currentY para el posicionamiento vertical

        // Cabecera personalizada
            // Establecer el tipo y tamaño de fuente
        doc.setFont("Arial", "normal");
        doc.setFontSize(12);

        // Coordenada X para la alineación derecha (ajustar según sea necesario)
        const rightAlignX = 190;  
        // Espacio inicial (sangría)
        const indentation = 100; // Ajustar este valor para más o menos sangría

        // Texto alineado a la derecha pero con sangría a la izquierda
        doc.text("Cd. Lázaro Cárdenas, Michoacán", rightAlignX - indentation, 35);
        doc.text("DEPENDENCIA: Subdirección de Planeación y Vinculación", rightAlignX - indentation, 40);
        doc.text("SECCIÓN: Depto. Servicios Escolares", rightAlignX - indentation, 45);
        doc.text(`OFICIO: DSE/ ${fecha}`, rightAlignX - indentation, 50);
        doc.text("ASUNTO: CONSTANCIA DE ESTUDIANTES ATENDIDOS", rightAlignX - indentation, 55);

        doc.setFont("Arial", "bold");
        doc.setFontSize(12);
        doc.text(`A QUIEN CORRESPONDA:`, 20, 65);
        doc.setFont("Arial", "normal");
        doc.text(`Por este medio, me permito notificar que el docente ${nombreDocente}, de la carrera de ${carrera} atendió un total de ${totalEstudiantes + totalEstudiantes2} estudiantes durante los periodos que se indican:`, 20, 70, { maxWidth: 170 });

        // Información de los semestres
        if (materiaDataArray.length > 0) {
            doc.text(`SEMESTRE: ${semestre1} NIVEL: ${nivel1}`, 20, currentY+4);
            currentY += 5;
            doc.autoTable({
                startY: currentY,
                head: [['MATERIA', 'ALUMNOS', 'CLAVE DE LA MATERIA']],
                body: materiaDataArray,
                styles: { 
                    cellPadding: 3, 
                    fontSize: 10, 
                    halign: 'center', 
                    valign: 'middle', 
                    lineColor: [0, 0, 0], 
                    lineWidth: 0.5 
                },
                headStyles: { 
                    fillColor: [255, 255, 255], 
                    textColor: [0, 0, 0], 
                    fontStyle: 'normal' 
                },
                bodyStyles: { 
                    fillColor: [255, 255, 255], 
                    textColor: [0, 0, 0] 
                },
                tableLineColor: [0, 0, 0],
                tableLineWidth: 0.5
            });
            currentY = doc.lastAutoTable.finalY + 10;
        }

        if (materia2DataArray.length > 0) {
            doc.text(`SEMESTRE: ${semestre2} NIVEL: ${nivel2}`, 20, currentY+4);
            currentY += 5;
            doc.autoTable({
                startY: currentY,
                head: [['MATERIA', 'ALUMNOS', 'CLAVE DE LA MATERIA']],
                body: materia2DataArray,
                styles: { 
                    cellPadding: 3, 
                    fontSize: 10, 
                    halign: 'center', 
                    valign: 'middle', 
                    lineColor: [0, 0, 0], 
                    lineWidth: 0.5 
                },
                headStyles: { 
                    fillColor: [255, 255, 255], 
                    textColor: [0, 0, 0], 
                    fontStyle: 'normal' 
                },
                bodyStyles: { 
                    fillColor: [255, 255, 255], 
                    textColor: [0, 0, 0] 
                },
                tableLineColor: [0, 0, 0],
                tableLineWidth: 0.5
            });
            currentY = doc.lastAutoTable.finalY + 10;
        }

       

        doc.setFontSize(12);
        doc.text("Se exige la presente a petición del interezado a los catorce dias del mes de agosto del dos mil veinticuatro", 20, currentY + 5);
        doc.setFont("Arial", "bold");
        doc.text("ATENTAMENTE", 20, currentY + 10);
        doc.text("Excelencia en educación tecnológica", 20, currentY + 15);
        doc.setFont("Arial", "italic");
        doc.text("Recibimos Sabiduría, Lograremos Desarrollo", 20, currentY + 20);

        // Tamaño de la página (ancho máximo)
        const pageWidth = doc.internal.pageSize.getWidth();

        // Definir las coordenadas para las firmas
        const leftX = 20;  // Coordenada X para la firma izquierda
        const rightX = pageWidth - 100;  // Coordenada X para la firma derecha (ajustar según sea necesario)

        // Espacio entre la línea y el nombre del firmante
        const firmaSpacing = 10;

        // Firmante 1 (izquierda)
        doc.setFontSize(12);
        doc.setFont("Arial", "bold");
        doc.text(`_____________________________________`, leftX, currentY+50);  // Línea de firma
        doc.setFont("Arial", "normal");
        doc.text(nombresFirmante1, leftX, currentY +  55);  // Nombre debajo de la línea

        // Firmante 2 (derecha)
        doc.setFontSize(12);
        doc.setFont("Arial", "bold");
        doc.text(`_____________________________________`, rightX, currentY +50);  // Línea de firma
        doc.setFont("Arial", "normal");
        doc.text(nombresFirmante2, rightX, currentY  + 55 );  // Nombre debajo de la línea

        doc.save("constancia_estudiantes.pdf");
    } else {
        alert("Por favor, ingrese al menos una materia en al menos uno de los semestres.");
    }
});

</script>

</body>
</html>
