console.log('scripts cargado correctamente'); 
const descripcionesDescripcion = {
    '3.1.1': 'En ambos casos oficio de comisión: \n\n • Para los cursos impartidos en el TecNM constancia con el númerode registro de acuerdo con el oficio no. M00.2/076/2021 o constanciaemitida por la Dirección de Docencia e Innovación Educativa concódigo QR de validación. \n• Para los cursos externos constancia de la institución formadora.',
    '3.1.2': '• Documento emitido por la institución formadora con registrooficial del diplomado o Diploma emitido por la Dirección de Docenciae Innovación Educativa. \n• Documento emitido por la institución formadora del diplomado.',
    '3.1.3': '• Documento emitido por el Responsable del Proyecto Estratégico del TecNM.',
    '3.2.1': '• Constancia o Diploma o Reconocimiento de cumplimiento delTecNM indicando el período de la comisión. \n•Constancia de cumplimiento que indique las actividades realizadasy el análisis de indicadores atendidos firmada por el(la) Director(a) delplantel indicando el período de la comisión.',
    '3.2.2': '• Constancia que indique cantidad de alumnos atendidos yactividades realizadas emitida por el departamento académico con elvo.bo. de la subdirección académica.',
    '3.3': '• Constancia de vigencia del nombramiento (indicando período). Asímismo, deberá indicar las actividades realizadas y el análisis deindicadores atendidos, expedida por el(la) Director(a) del plantel.',
};

    
const puntosPuntos = {
    '3.1.1': '3.1.1.1. Formación Docente = 10  \n3.1.1.2. Actualización Profesional = 10',
    '3.1.2': '3.1.2.1. Registrados en el TecNM = 40  \n3.1.2.2. Fuera del TecNM = 40',
    '3.1.3': '50',
    '3.2.1': '3.2.1.1. Comisiones especiales del TecNM  = 30\n3.2.1.2 Responsable de comisiones especiales locales = 20',
    '3.2.2': '3.2.2.1. Participación en actividades de promoción para nuevo ingreso taller = 5  \n.3.2.2.2 Participación en actividades de admisión o inscripción para nuevo ingreso taller = 5 ',

    '3.3': '3.3.1. Jefe(a) de laboratorio o taller = 1.67  \n3.3.2. Secretario(a) de academia, consejo o claustro = 1.67 \n3.3.3. Presidente(a) de academia, consejo o claustro = 1.67 \n3.3.4. Jefe(a) de Oficina, Jefe(a) de proyecto de docencia, vinculación e investigación = 3.33  \n 3.3.5. Coordinador(a) de carrera o posgrado = 3.33 \n3.3.6. Jefe(a) de departamento o Jefe(a) de división = 5  \n 3.3.7. Subdirector(a) = 6.67',

};
const puntosMax = {
    '3.1.1': '3.1.1.1. Formación Docente = 40  \n3.1.1.2. Actualización Profesional = 40',
    '3.1.2': '3.1.2.1. Registrados en el TecNM = 40  \n3.1.2.2. Fuera del TecNM = 40',
    '3.1.3': '50',
    '3.2.1': '3.2.1.1. Comisiones especiales del TecNM  = 60\n3.2.1.2 Responsable de comisiones especiales locales = 40',
    '3.2.2': '3.2.2.1. Participación en actividades de promoción para nuevo ingreso taller = 10  \n.3.2.2.2 Participación en actividades de admisión o inscripción para nuevo ingreso taller = 10 ',
    '3.3': '3.3.1. Jefe(a) de laboratorio o taller = 20 \n3.3.2. Secretario(a) de academia, consejo o claustro = 20 \n3.3.3. Presidente(a) de academia, consejo o claustro = 20 \n3.3.4. Jefe(a) de Oficina, Jefe(a) de proyecto de docencia, vinculación e investigación = 40 \n 3.3.5. Coordinador(a) de carrera o posgrado = 40  \n3.3.6. Jefe(a) de departamento o Jefe(a) de división = 60  \n 3.3.7. Subdirector(a) = 80',
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

    //Mostrar u ocultar el botón según la selección
    const pregunta3_2_1 = document.getElementById('pregunta3_2_1');
    pregunta3_2_1.style.display = (valorSeleccionado === '3.2.1') ? 'flex' : 'none';
    const pregunta3_2_2 = document.getElementById('pregunta3_2_2');
    pregunta3_2_2.style.display = (valorSeleccionado === '3.2.2') ? 'flex' : 'none';
    const pregunta3_3 = document.getElementById('pregunta3_3');
    pregunta3_3.style.display = (valorSeleccionado === '3.3') ? 'flex' : 'none';
    const pregunta3_1_2 = document.getElementById('pregunta3_1_2');
    pregunta3_1_2.style.display = (valorSeleccionado === '3.1.2') ? 'flex' : 'none';
    const pregunta3_1_1 = document.getElementById('pregunta3_1_1');
    pregunta3_1_1.style.display = (valorSeleccionado === '3.1.1') ? 'flex' : 'none';
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

document.getElementById('file').addEventListener('change', function () {
    const file = this.files[0];
    if (file && file.size > 500 * 1024) {
        alert('El archivo supera el tamaño máximo permitido (500 KB).');
        this.value = ''; 
    }
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
        xhr.open("POST", "../Acciones/eliminarDocumento.php", true);

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
    console.log("Valor seleccionado:", valorSeleccionado); 

    if (valorSeleccionado.startsWith("1.4.8")) {
        titulo.textContent = "1.4.8. Desarrollo curricular. Licenciatura y posgrado (50 Posibles puntos).";
    
    } else {
        titulo.textContent = "";
    }
    if (valorSeleccionado.startsWith("3.1")) {
        titulo.textContent = "3.1 Formación y actualización académica (90 Posibles puntos). ";
    } else if (valorSeleccionado.startsWith("3.2")) {
        titulo.textContent = "3.2 Comisiones Académicas (80 Posibles puntos).";
    } else if (valorSeleccionado.startsWith("3.3")) {
        titulo.textContent = "3.3. Nombramientos de apoyo a la docencia en el período a evaluar (los nombramientos no son excluyentes) (80 Posibles puntos).";
    } else {
        titulo.textContent = "Seleccione una opción";
    }
    }