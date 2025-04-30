console.log('scripts cargado correctamente'); 
const descripcionesDescripcion = {
    '2.2.1': '• Registro ante Indautor siendo el Titular el Tecnológico Nacional de México',
    '9': '• Título emitido por el IMPI (no se considera la solicitud ante el IMPI) siendo el Titular el Tecnológico Nacional de México',
    '2.2.7': '• Registro ante Indautor siendo el Titular el Tecnológico Nacional de México',
    '2.2.8': '• Constancia por parte del Área Central del TecNM.',
    '2.2.9': '• Constancia de la Dirección de Docencia e Innovación Educativa del TecNM.',
    '2.2.10': '• Constancia de  la Dirección del TecNM Responsable del Proyecto Estratégico del TecNM.',
};

    
const puntosPuntos = {
    '2.2.1': '10',
    '9': '2.2.2. Modelo de utilidad = 40, \n2.2.3. Patente. (Se considerará patentes durante tres años a partir de la fecha en que se obtiene) = 40, \n2.2.4. Secreto industrial = 40, \n2.2.5. Trazado de circuito integrado = 40, \n2.2.6. Registro de Marca, Signo Distintivo y Lemas Comerciales= 10',
    '2.2.7': '10',
    '2.2.8': '30',
    '2.2.9': '50',
    '2.2.10': '40',
    
};
const puntosMax = {
    '2.2.1': '20',
    '9': '2.2.2. Modelo de utilidad = 80, \n2.2.3. Patente. (Se considerará patentes durante tres años a partir de la fecha en que se obtiene) = 80, \n2.2.4. Secreto industrial = 80, \n2.2.5. Trazado de circuito integrado = 80, \n2.2.6. Registro de Marca, Signo Distintivo y Lemas Comerciales= 20',
    '2.2.7': '10',
    '2.2.8': '60',
    '2.2.9': '50',
    '2.2.10': '40',
    
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
    const pregunta = document.getElementById('pregunta');
    pregunta.style.display = (valorSeleccionado === '9') ? 'flex' : 'none';
     // Calcular puntos
     const pregunta2_2_1 = document.getElementById('pregunta2_2_1');
     pregunta2_2_1.style.display = (valorSeleccionado === '2.2.1') ? 'flex' : 'none';
     const pregunta2_2_8 = document.getElementById('pregunta2_2_8');
     pregunta2_2_8.style.display = (valorSeleccionado === '2.2.8') ? 'flex' : 'none';
  
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
