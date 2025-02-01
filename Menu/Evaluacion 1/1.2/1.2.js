console.log('scripts.js cargado correctamente'); 

const descripcionesDescripcion = {
    '1': '',
    '2': '', 
    '3': '',
    '4': '',
    '5': '',
    '6': '',
    '7': '',
    
};



function mostrarDescripcion() {
    const select = document.getElementById('document_type');
    const descripcion = document.getElementById('descripcion_documento');
    const valorSeleccionado = select.value;

    descripcion.value = descripcionesDescripcion[valorSeleccionado] || 'Descripción no disponible.';
   
    // Mostrar u ocultar el botón según la selección
    const botonCrearDocumento = document.getElementById('botonCrearDocumento');
    botonCrearDocumento.style.display = (valorSeleccionado === '7') ? 'block' : 'none';
}



async function cargarDocumentoSeleccionado1() {
    const documentType = document.getElementById('document_type').value;
    const documentsContainer = document.getElementById('documentsContainer');

    // Mostrar mensaje de carga
    documentsContainer.innerHTML = "<p class='text-info'>Cargando documentos...</p>";

    try {
        const response = await fetch(`mostrarDocumentos.php?document_type=${documentType}`);
        const data = await response.text();
        documentsContainer.innerHTML = data;
    } catch (error) {
        documentsContainer.innerHTML = "<p class='text-danger'>Error al cargar los documentos.</p>";
    }
}


// Verificación del tamaño del archivo
document.getElementById('file').addEventListener('change', function () {
    const file = this.files[0];
    if (file && file.size > 500 * 1024) {
        alert('El archivo supera el tamaño máximo permitido (500 KB).');
        this.value = ''; // Limpia el input
    }
});

function crearDocumento() { 
    window.location.href = 'RI7.php';  // Ruta absoluta a partir de la raíz del servidor
    console.log(window.location.href = 'RI7.php'); 
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
                // Recargar los documentos después de la eliminación
                document.getElementById('document_type').dispatchEvent(new Event('change'));
            }
        };

        xhr.send(formData);
    }
}

