console.log('scripts cargado correctamente'); 
const descripcionesDescripcion = {
    '1.3.1': '• Para Licenciatura: Copia del documento del libro de actas de examen profesional o de grado en la que aparezca como Presidente(a) del jurado.No se consideran participaciones como Secretario y/o Vocal.\n• Para Posgrado: Acta de examen de grado en donde se especifique la Dirección o Co-Dirección.\n• Titulaciones en otras instituciones requieren copia de convenio de colaboración académico y de investigación.\nNota: No se reconocerá la asesoría a estudiantes que se titulen por la opción por Promedio, EGEL, Escolaridad por Estudios de Posgrado.',
    
    '1.3.2': 'Constancia emitida por el Departamento de Servicios Escolares que especifique folio del acta, fecha del examen, nombre del estudiante y programa educativo.\nSe expedirá una sola constancia por todas las sinodalías realizadas de estudiantes titulados durante el período a evaluar.\nNota: Este rubro no aplica para directores(as), asesores(as) o co-directores(as).'
};

    
const puntosPuntos = {
    '1.3.1': '1.3.1.1. Licenciatura = 20   \n1.3.1.2. Especialización = 25  \n1.3.1.3. Maestría = 40   \n1.3.1.4. Maestría Co-Director = 30   \n1.3.1.5. Doctorado = 50   \n1.3.1.6. Doctorado. Co-Director = 40 ',
    '1.3.2': '1.3.2.1. Técnico Superior = 5   \n1.3.2.2. Licenciatura = 10   \n1.3.2.3. Especialización = 15    \n1.3.2.4. Maestría = 15    \n1.3.2.5. Doctorado = 30 ',
   
    
};
const puntosMax = {
    '1.3.1': '1.3.1.1. Licenciatura = 80   \n1.3.1.2. Especialización = 75  \n1.3.1.3. Maestría = 80   \n1.3.1.4. Maestría Co-Director = 60   \n1.3.1.5. Doctorado = 100   \n1.3.1.6. Doctorado. Co-Director = 80 ', 
    '1.3.2': '1.3.2.1. Técnico Superior = 30   \n1.3.2.2. Licenciatura = 30  \n1.3.2.3. Especialización = 30   \n1.3.2.4. Maestría = 30    \n1.3.2.5. Doctorado = 30 ', 

    
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
    const pregunta1_1_4 = document.getElementById('pregunta1_3_1');
    pregunta1_1_4.style.display = (valorSeleccionado === '1.3.1') ? 'flex' : 'none';
    const pregunta1_1_5 = document.getElementById('pregunta1_3_2');
   pregunta1_1_5.style.display = (valorSeleccionado === '1.3.2') ? 'flex' : 'none';
  
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
