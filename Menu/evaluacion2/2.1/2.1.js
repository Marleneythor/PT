console.log('scripts cargado correctamente'); 

const descripcionesDescripcion = {
    '2.1.1.1': 'hol',
    '2.1.1.2': '',
    '2.1.1.3': '',
    '2.1.1.4': '',
    '2.1.1.5': '',
    '2.1.2.1': '',
    '2.1.2.2': '',
};

const puntosPuntos = {
    '2.1.1.1': '',
    '2.1.1.2': '',
    '2.1.1.3': '',
    '2.1.1.4': '',
    '2.1.1.5': '',
    '2.1.2.1': '',
    '2.1.2.2': '',
};

const puntosMax = {
    '2.1.1.1': '',
    '2.1.1.2': '',
    '2.1.1.3': '',
    '2.1.1.4': '',
    '2.1.1.5': '',
    '2.1.2.1': '',
    '2.1.2.2': '',
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
    const pregunta1_1_4 = document.getElementById('pregunta2_1_1_1');
    pregunta1_1_4.style.display = (valorSeleccionado === '2.1.1.1') ? 'flex' : 'none';
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

function actualizarTitulo() {
    console.log("Función actualizarTitulo llamada"); // Para verificar si se ejecuta

    const select = document.getElementById("document_type");
    const titulo = document.getElementById("titulo");

    if (!select || !titulo) {
        console.error("Elemento no encontrado: select o título");
        return;
    }

    const valorSeleccionado = select.value;
    console.log("Valor seleccionado:", valorSeleccionado); // Verifica qué valor se obtiene

    if (valorSeleccionado.startsWith("2.1.1")) {
        titulo.textContent = "2.1.1. PRODUCCIÓN CIENTÍFICA \n Nota: Ninguna obra podrá ser utilizada en más de un numeral de esta sección(250 Posibles puntos). ";
   } else if (valorSeleccionado.startsWith("2.1.2")) {
        titulo.textContent = "2.1.2. REDES DE INVESTIGACIÓN Y CUERPOS ACADÉMICOS Nota: Los puntos que se asignarán a esta actividad, será por mes de duración del reconocimiento/registro en el periodo a evaluar.(100 Posibles puntos).";
    } else {
        titulo.textContent = "Seleccione una opción";
    }
}