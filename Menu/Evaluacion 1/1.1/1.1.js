console.log('scripts.js cargado correctamente'); 

const descripcionesDescripcion = {
        '1': 'Horarios: primer semestre 2023 y segundo semestre 2023 y constancia solicitada en el numeral 07 de la relación de requisitos de inicio. Se tomará la evidencia de los numerales 03 y 07 de los requisitos de inicio (Se tomará como máximo hasta 6 asignaturas diferentes por año) .',
        '2': 'Horarios: primer semestre 2023 y segundo semestre 2023 y constancia solicitada en el numeral 07 de la relación de requisitos de inicio. Se tomará la evidencia de los numerales 03 y 07 de los requisitos de inicio.', 
        '3': 'Horarios: primer semestre 2023 y segundo semestre 2023 y constancia solicitada en el numeral 07 de la relación de requisitos de inicio. Se tomará la evidencia de los numerales 03 y 07 de los requisitos de inicio. ',
        '4': 'Constancia solicitada en el numeral 07 de la relación de requisitos de inicio. Se tomará la evidencia del numeral 07 de los requisitos de inicio.',
        '5': 'Constancia de cumplimiento firmada por el(la) Jefe(a) del departamento de desarrollo académico, con el vo.bo. de la subdirección académica que haga constar que se entregó en tiempo y forma el informe que contiene: • Número de estudiantes de licenciatura atendidos por semestre • Evaluación del impacto en indicadores de eficiencia académica de la acción tutorial.',
        '6': 'Constancia de acreditación del órgano acreditador o captura de pantalla del sistema de consulta del PNPC/SNP CONAHCYT con vo.bo. de la subdirección académica.',
        '7': 'Constancia firmada por el(la) jefe(a) del departamento Correspondiente con vo.bo. de la subdirección académica, que contenga: • Número de dictamen de comité académico • Nombre de la actividad complementaria • Cantidad de créditos de la actividad • Número de estudiantes atendidos.',
        
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

