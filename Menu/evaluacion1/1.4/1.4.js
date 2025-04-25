console.log('scripts cargado correctamente'); 

const descripcionesDescripcion = {
    '1.4.1': '• Programa de asesoría formalizado por el jefe(a) del departamentode ciencias básicas y registrado en desarrollo académico. \n• Constancia de cumplimiento por parte del(la) jefe(a) dedepartamento de ciencias básicas con vo.bo. de la subdirección académica.',
    '1.4.2': 'Constancia de la institución organizadora. Donde se indique elevento o concurso donde participó o en su caso, constanciaemitida por el departamento académico con vo.bo. de lasubdirección académica.', 
    '1.4.3': '• Constancia de la institución organizadora que indique elproyecto premiado.\n• Constancia emitida por el departamento académico con vo.bo.de la subdirección académica.',
    '1.4.4': 'Constancia de cumplimiento firmada por el(la) jefe(a) deldepartamento académico, especificando la función (cargo), conel vo.bo. de la subdirección académica.',
    '1.4.5': 'Constancia de la institución organizadora, con el vo.bo. de lasubdirección académica.',
    '1.4.6': 'Participación en comités para la evaluación de propuestas de proyectos de investigación o comité de evaluaciones y/o acreditaciones de programas educativos (copaes, abet, conacyt, coepes, prodep, entre otros.) Excepto comisiones consideradas en el numeral 3.2.1.1. \n• Constancia de la institución organizadora, con el vo.bo. de lasubdirección académica.', 
    '1.4.7': 'Participación en auditorías de sistemas de gestión (SGC, SGA, igualdad laboral, etc). \n• Constancia emitida por el(la) Director(a).',
    
    '1.4.8.1': '• Constancia por el (la) Director(a) del plantel. (1.4.8.1.1.) \n• Constancia de la DDIE o DPII del TecNM. (1.4.8.1.2.). \n Nota: Los programas de estudio deberán ser inéditos y actualizados, conforme al formato de programa de asignatura vigente emitido por la Dirección de Docencia e Innovación Educativa o por la Dirección de Posgrado, Investigación e Innovación del TecNM en el Diseño, Consolidación y/o Seguimiento Curricular.', 
    '1.4.8.2': 'Oficio de registro de módulos de especialidad emitido por laDirección de Docencia e Innovación Educativa del TecNM yconstancia de participación firmada por el(la) jefe(a) deldepartamento académico correspondiente, con vo.bo. de lasubdirección académica. \n Nota: Los programas de estudio deberán ser inéditos y actualizados, conforme al formato de programa de asignatura vigente emitido por la Dirección de Docencia e Innovación Educativa o por la Dirección de Posgrado, Investigación e Innovación del TecNM en el Diseño, Consolidación y/o Seguimiento Curricular.',
    '1.4.8.3': '• Constancia con los nombres de los participantes del trabajoterminado emitido por el(la) jefe(a) de departamento académicocorrespondiente, con vo.bo. del(la) subdirector(a) académico(a).• Oficio de autorización de la DDIE o DPII del TecNM.  \n Nota: Los programas de estudio deberán ser inéditos y actualizados, conforme al formato de programa de asignatura vigente emitido por la Dirección de Docencia e Innovación Educativa o por la Dirección de Posgrado, Investigación e Innovación del TecNM en el Diseño, Consolidación y/o Seguimiento Curricular.',
    '1.4.9': 'Evidencia de la cédula profesional solicitada en el numeral 10de la relación de requisitos de inicio o copia del acta de examen degrado con no más de dos años de haber sido expedida. Se tomarála evidencia del numeral 10 de los requisitos de inicio. \n(Sólo máximo grado de estudios, no acumulable)', 
};
    
const puntosPuntos = {
    '1.4.1': '3pts. por estudiante',
    '1.4.2': '1.4.2.1. Estatal/Regional = 10   \n1.4.2.2. Nacional = 15   \n1.4.2.3. Internacional (fuera del país) = 20',
    '1.4.3': '1.4.3.1. 3º Lugar Nacional = 10   \n1.4.3.2. 2º Lugar Nacional = 15   \n1.4.3.3. 1º Lugar Nacional = 20   \n1.4.3.4. 3º Lugar Internacional (fuera del país) = 30   \n1.4.3.5. 2º Lugar Internacional (fuera del país) = 35   \n1.4.3.6. 1º Lugar Internacional (fuera del país) = 40',
    '1.4.4': '1.4.4.1. Coordinador(a) general Local = 10   \n1.4.4.2. Coordinador(a) general Regional = 15   \n1.4.4.3. Coordinador(a) general Nacional o Internacional = 20   \n1.4.4.4. Coordinador(a) de cartera Local = 5   \n1.4.4.5. Coordinador(a) de cartera Regional = 10   \n1.4.4.6. Coordinador(a) de cartera Nacional o Internacional = 15   \n1.4.4.7. Colaborador(a) Local = 3   \n1.4.4.8. Colaborador(a) Regional = 5   \n1.4.4.9. Colaborador(a) Nacional o Internacional = 8',
    '1.4.5': '1.4.5.1. Local = 10   \n1.4.5.2. Estatal/Regional = 15   \n1.4.5.3. Nacional = 20   \n1.4.5.4. Internacional (fuera del país) = 25',
    '1.4.6': '1.4.6.1. Nivel Local o Regional = 10   \n1.4.6.2. Nivel Nacional = 15   \n1.4.6.3. Nivel Internacional = 30',
    '1.4.7': '1.4.7.1. Auditor interno en la Institución = 10   \n1.4.7.2. Auditor interno fuera de la institución = 15   \n1.4.7.3. Auditor líder en la institución = 15   \n1.4.7.4. Auditor líder fuera de la institución = 20',
    '1.4.8.1': '1.4.8.1.1. Local = 20   \n1.4.8.1.2. Nacional = 30',
    '1.4.8.2': '25',
    '1.4.8.3': '10',
    '1.4.9': '1.4.9.1. Profesor(a) con Doctorado = 120   \n1.4.9.2. Profesor(a) con Maestría = 100',
};

const puntosMax = {
    '1.4.1': '45',
    '1.4.2': '1.4.2.1. Estatal/Regional = 10   \n1.4.2.2. Nacional = 15   \n1.4.2.3. Internacional (fuera del país) = 20',
    '1.4.3': '1.4.3.1. 3º Lugar Nacional = 30   \n1.4.3.2. 2º Lugar Nacional = 30   \n1.4.3.3. 1º Lugar Nacional = 40   \n1.4.3.4. 3º Lugar Internacional (fuera del país) = 30   \n1.4.3.5. 2º Lugar Internacional (fuera del país) = 35   \n1.4.3.6. 1º Lugar Internacional (fuera del país) = 40',
    '1.4.4': '1.4.4.1. Coordinador(a) general Local = 20   \n1.4.4.2. Coordinador(a) general Regional = 30   \n1.4.4.3. Coordinador(a) general Nacional o Internacional = 20   \n1.4.4.4. Coordinador(a) de cartera Local = 20   \n1.4.4.5. Coordinador(a) de cartera Regional = 20   \n1.4.4.6. Coordinador(a) de cartera Nacional o Internacional = 30   \n1.4.4.7. Colaborador(a) Local = 12   \n1.4.4.8. Colaborador(a) Regional = 20   \n1.4.4.9. Colaborador(a) Nacional o Internacional = 24',
    '1.4.5': '1.4.5.1. Local = 40   \n1.4.5.2. Estatal/Regional = 30   \n1.4.5.3. Nacional = 40   \n1.4.5.4. Internacional (fuera del país) = 25',
    '1.4.6': '1.4.6.1. Nivel Local o Regional = 20   \n1.4.6.2. Nivel Nacional = 30   \n1.4.6.3. Nivel Internacional = 30',
    '1.4.7': '1.4.7.1. Auditor interno en la Institución = 20   \n1.4.7.2. Auditor interno fuera de la institución = 30   \n1.4.7.3. Auditor líder en la institución = 30   \n1.4.7.4. Auditor líder fuera de la institución = 20',
    '1.4.8.1': '1.4.8.1.1. Local = 20   \n1.4.8.1.2. Nacional = 30',
    '1.4.8.2': '25',
    '1.4.8.3': '20',
    '1.4.9': '1.4.9.1. Profesor(a) con Doctorado = 120   \n1.4.9.2. Profesor(a) con Maestría = 100',
};
function mostrarDescripcion() {
    const select = document.getElementById('document_type');
    const descripcion = document.getElementById('descripcion_documento');
    const puntos1 = document.getElementById('puntos');
    const puntos2 = document.getElementById('puntosmax');
    const valorSeleccionado = select.value;

    descripcion.value = descripcionesDescripcion[valorSeleccionado] || 'Descripción no disponible.';
    puntos1.value = puntosPuntos[valorSeleccionado] || 'Descripción no disponible.';
    puntos2.value = puntosMax[valorSeleccionado] || 'Descripción no disponible.';

    const pregunta1_4_1 = document.getElementById('pregunta1_4_1');
    pregunta1_4_1.style.display = (valorSeleccionado === '1.4.1') ? 'flex' : 'none';
    const pregunta1_4_2 = document.getElementById('pregunta1_4_2');
    pregunta1_4_2.style.display = (valorSeleccionado === '1.4.2') ? 'flex' : 'none';
    const pregunta1_4_3 = document.getElementById('pregunta1_4_3');
    pregunta1_4_3.style.display = (valorSeleccionado === '1.4.3') ? 'flex' : 'none';
    const pregunta1_4_4 = document.getElementById('pregunta1_4_4');
    pregunta1_4_4.style.display = (valorSeleccionado === '1.4.4') ? 'flex' : 'none';
    const pregunta1_4_5 = document.getElementById('pregunta1_4_5');
    pregunta1_4_5.style.display = (valorSeleccionado === '1.4.5') ? 'flex' : 'none';
    const pregunta1_4_6 = document.getElementById('pregunta1_4_6');
    pregunta1_4_6.style.display = (valorSeleccionado === '1.4.6') ? 'flex' : 'none';
    const pregunta1_4_7 = document.getElementById('pregunta1_4_7');
    pregunta1_4_7.style.display = (valorSeleccionado === '1.4.7') ? 'flex' : 'none';
    const pregunta1_4_8_1 = document.getElementById('pregunta1_4_8_1');
    pregunta1_4_8_1.style.display = (valorSeleccionado === '1.4.8.1') ? 'flex' : 'none';

    const pregunta1_4_8_3 = document.getElementById('pregunta1_4_8_3');
    pregunta1_4_8_3.style.display = (valorSeleccionado === '1.4.8.3') ? 'flex' : 'none';

    const pregunta1_4_9 = document.getElementById('pregunta1_4_9');
    pregunta1_4_9.style.display = (valorSeleccionado === '1.4.9') ? 'flex' : 'none';
    const info1_4_1 = document.getElementById('info1_4_1');
    info1_4_1.style.display = (valorSeleccionado === '1.4.1') ? 'flex' : 'none';
    const info1_4_3 = document.getElementById('info1_4_3');
    info1_4_3.style.display = (valorSeleccionado === '1.4.3') ? 'flex' : 'none';
    const info1_4_8_3 = document.getElementById('info1_4_8_3');
    info1_4_8_3.style.display = (valorSeleccionado === '1.4.8.3') ? 'flex' : 'none';
    


    // Manejo de subir archivos
    const subir1_4_1 = document.getElementById('subir1_4_1'); // Para 1.4.1 (dos archivos)
    const subir = document.getElementById('subir'); // Para otros casos (un archivo)

    const valoresPermitidos = ['1.4.2', '1.4.4', '1.4.5', '1.4.6', '1.4.7', '1.4.8.1', '1.4.8.2', '1.4.9'];

    if (valorSeleccionado === '1.4.1'||valorSeleccionado === '1.4.3'||valorSeleccionado === '1.4.8.3') {
        subir1_4_1.style.display = 'flex';
        subir.style.display = 'none';
    } else if (valoresPermitidos.includes(valorSeleccionado)) {
        subir1_4_1.style.display = 'none';
        subir.style.display = 'flex';
    } else {
        subir1_4_1.style.display = 'none';
        subir.style.display = 'none';
    }
    
}


async function cargarDocumentoSeleccionado1() {
    const documentType = document.getElementById('document_type').value;
    const documentsContainer = document.getElementById('documentsContainer');

  
    documentsContainer.innerHTML = "<p class='text-info'>Cargando documentos...</p>";

    try {
        const response = await fetch(`mostrarDocumentos.php?document_type=${documentType}`);
        const data = await response.text();
        documentsContainer.innerHTML = data;
    } catch (error) {
        documentsContainer.innerHTML = "<p class='text-danger'>Error al cargar los documentos.</p>";
    }
}



document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function () {
        const file = this.files[0];
        const maxSize = 500 * 1024; // 500 KB
        const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'application/msword', 
                              'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        if (file) {
            if (!allowedTypes.includes(file.type)) {
                alert(`Error: El tipo de archivo "${file.name}" no es válido.`);
                this.value = ''; 
            } else if (file.size > maxSize) {
                alert(`Error: "${file.name}" supera el tamaño máximo permitido (500 KB).`);
                this.value = ''; 
            }
        }
    });
});

function crearDocumento() { 
    window.location.href = 'RI7.php'; 
    console.log(window.location.href = 'RI7.php'); 
}

function eliminarArchivo(idDocumento, rutaArchivo) {
    if (confirm("¿Estás seguro de que deseas eliminar este archivo?")) {
        const formData = new FormData();
        formData.append("id_documento", idDocumento);
        formData.append("ruta_archivo", rutaArchivo);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../../Acciones/eliminarDocumento.php", true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
                
                document.getElementById('document_type').dispatchEvent(new Event('change'));
            }
        };

        xhr.send(formData);
    }
}

function toggleDocuments() {
    const container = document.getElementById('documentsContainer');
    const button = document.getElementById('toggleButton');

    if (container.style.display === 'none') {
        container.style.display = 'block';
        button.innerHTML = '▲'; 
    } else {
        container.style.display = 'none';
        button.innerHTML = '▼'; 
    }
}

function actualizarTitulo() {
    console.log("Función actualizarTitulo llamada"); 

    const select = document.getElementById("document_type");
    const titulo = document.getElementById("titulo");

    if (!select || !titulo) {
        console.error("Elemento no encontrado: select o título");
        return;
    }

    const valorSeleccionado = select.value;
    console.log("Valor seleccionado:", valorSeleccionado); // Verifica qué valor se obtiene

    if (valorSeleccionado.startsWith("1.4.8")) {
        titulo.textContent = "1.4.8. Desarrollo curricular. Licenciatura y posgrado (50 Posibles puntos).";
    
    } else {
        titulo.textContent = "";
    }
}