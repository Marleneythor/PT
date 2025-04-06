console.log('scripts cargado correctamente'); 

const descripcionesDescripcion = {
    '1.1.1': 'Horarios: primer semestre 2023 y segundo semestre 2023 y constancia solicitada en el numeral 07 de la relación de requisitos de inicio. Se tomará la evidencia de los numerales 03 y 07 de los requisitos de inicio (Se tomará como máximo hasta 6 asignaturas diferentes por año).',
    '1.1.2': 'Horarios: primer semestre 2023 y segundo semestre 2023 y constancia solicitada en el numeral 07 de la relación de requisitos de inicio. Se tomará la evidencia de los numerales 03 y 07 de los requisitos de inicio.',
    '1.1.3': 'Horarios: primer semestre 2023 y segundo semestre 2023 y constancia solicitada en el numeral 07 de la relación de requisitos de inicio. Se tomará la evidencia de los numerales 03 y 07 de los requisitos de inicio.',
    '1.1.4': 'Constancia solicitada en el numeral 07 de la relación de requisitos de inicio. Se tomará la evidencia del numeral 07 de los requisitos de inicio.',
    '1.1.5': 'Constancia de cumplimiento firmada por el(la) Jefe(a) del departamento de desarrollo académico, con el vo.bo. de la subdirección académica que haga constar que se entregó en tiempo y forma el informe que contiene: \n• Número de estudiantes de licenciatura atendidos por semestre. \n• Evaluación del impacto en indicadores de eficiencia académica de la acción tutorial.',
    '1.1.6': 'Constancia de acreditación del órgano acreditador o captura de pantalla del sistema de consulta del PNPC/SNP CONAHCYT con vo.bo. de la subdirección académica.',
    '1.1.7': 'Constancia firmada por el(la) jefe(a) del departamento Correspondiente con vo.bo. de la subdirección académica, que contenga: \n• Número de dictamen de comité académico. \n• Nombre de la actividad complementaria. \n• Cantidad de créditos de la actividad. \n• Número de estudiantes atendidos.',
};

const puntosPuntos = {
    '1.1.1': '5',
    '1.1.2': '10',
    '1.1.3': '5',
    '1.1.4': 'Licenciatura = (Núm. de estudiantes x 50)/200 \nPosgrado = (Un punto por estudiante)',
    '1.1.5': '1 punto por estudiante',
    '1.1.6': '10',
    '1.1.7': '10',
};

const puntosMax = {
    '1.1.1': '30',
    '1.1.2': '20',
    '1.1.3': '20',
    '1.1.4': '50',
    '1.1.5': '50',
    '1.1.6': '20',
    '1.1.7': '20',
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
    const pregunta1_1_4 = document.getElementById('pregunta1_1_4');
    pregunta1_1_4.style.display = (valorSeleccionado === '1.1.4') ? 'flex' : 'none';
    const pregunta1_1_5 = document.getElementById('pregunta1_1_5');
    pregunta1_1_5.style.display = (valorSeleccionado === '1.1.5') ? 'flex' : 'none'
    
  

    // Calcular puntos
    const calcular = document.getElementById('calcular'); 
    const valoresPermitidos = ['1.1.1', '1.1.2', '1.1.3', '1.1.6', '1.1.7'];

    if (valoresPermitidos.includes(valorSeleccionado)) {
        calcular.style.display = 'flex';
    } else {
        calcular.style.display = 'none';
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
function actualizarText() {
    console.log("Función hol llamada"); // Para verificar si se ejecuta

    const select = document.getElementById("document_type");
    const texto = document.getElementById("texto");

    if (!select || !texto) {
        console.error("Elemento no encontrado: text");
        return;
    }

    const valorSeleccionado = select.value;
    console.log("Valor seleccionado:", valorSeleccionado); // Verifica qué valor se obtiene

    if (valorSeleccionado.startsWith("1.1.1")) {
        texto.textContent = "Número de asignaturas de licenciatura diferentes por año:";
    } else if (valorSeleccionado.startsWith("1.1.2")) {
        texto.textContent = "Número de asignaturas de licenciatura diferentes y adicional a las declaradas en el 1.1.1. (Se considerará a partir de la séptima asignatura diferente por año):";
    } else if (valorSeleccionado.startsWith("1.1.3")) {
        texto.textContent = "Número de asignaturas de posgrado diferentes por año:";
    } else if (valorSeleccionado.startsWith("1.1.6")) {
        texto.textContent = "Número de  asignaturas por programa educativo acreditado y/o en PNPC/SNP:";
    } else if (valorSeleccionado.startsWith("1.1.7")) {
        texto.textContent = "Número de actividades en créditos complementarios autorizados por el Comité Académico o por TecNM:";
    } else {
        texto.textContent = " ";
    }
}