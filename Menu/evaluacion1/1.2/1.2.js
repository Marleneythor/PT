console.log('scripts cargado correctamente'); 

const descripcionesDescripcion = {
    '1.2.1.1': 'Constancia del trabajo terminado, que debe indicar que secuenta con la rúbrica de evaluación correspondiente, firmadapor el (la) jefe(a) del departamento académico correspondientecon vo.bo. de la subdirección académica. \nNota: No se contabilizan los trabajos realizados durante el Período Sabático.',
    '1.2.1.2': 'Constancia del trabajo terminado con la rúbrica de evaluacióncorrespondiente y que está siendo utilizado por la academia.Firmada por el (la) presidente(a) de academia o consejo deposgrado y por el(la) jefe(a) del departamento académicocorrespondiente con vo.bo. de la subdirección académica. \nNota: No se contabilizan los trabajos realizados durante el Período Sabático.', 
    '1.2.1.3': 'Constancia que mencione los productos obtenidos (reporte decasos, reporte de proyectos, reporte de resolución deproblemas) y el impacto en las experiencias de aprendizaje.Debe indicar que se cuenta con la rúbrica de evaluacióncorrespondiente firmada por el(la) jefe(a) del departamentoacadémico con vo.bo. de la subdirección académica. \nNota: No se contabilizan los trabajos realizados durante el Período Sabático.',
    '1.2.1.4': 'Constancia que mencione los productos obtenidos con enfoqueincluyente (reporte de casos, reporte de proyectos, reporte deresolución de problemas) y el impacto en las experiencias deaprendizaje. Debe indicar que se cuenta con la rúbrica deevaluación correspondiente firmada por el(la) jefe(a) deldepartamento académico con vo.bo. de la subdirecciónacadémica. \nNota: No se contabilizan los trabajos realizados durante el Período Sabático.', 

    '1.2.2.1': 'Constancia por el instituto tecnológico donde fue instructor que especifique el número de horas y número de registro. (a) que especifique el número de horas y número de registro.\nNota: Para el 1.2.2.1 Se debe considerar el registro interno de acuerdo con el oficio M00.2/076/2021 emitido por la Secretaría Académica, de Investigación e Innovación.',
    '1.2.2.2': 'Constancia de la Dirección de Docencia e Innovación Educativa del TecNM. \n\nNota: Para el 1.2.2.1 Se debe considerar el registro interno de acuerdo con el oficio M00.2/076/2021 emitido por la Secretaría Académica, de Investigación e Innovación.', 
    '1.2.2.3': 'Constancia de la Dirección de Docencia e Innovación Educativa del TecNM. \n\nNota: Para el 1.2.2.1 Se debe considerar el registro interno de acuerdo con el oficio M00.2/076/2021 emitido por la Secretaría Académica, de Investigación e Innovación.',
    '1.2.2.4': 'Constancia de la del TecNM. Dirección de Docencia e Innovación Educativa. \n\nNota: Para el 1.2.2.1 Se debe considerar el registro interno de acuerdo con el oficio M00.2/076/2021 emitido por la Secretaría Académica, de Investigación e Innovación.', 
    '1.2.2.5': 'Constancia de la Dirección de Docencia e Innovación Educativa del TecNM. \n\nNota: Para el 1.2.2.1 Se debe considerar el registro interno de acuerdo con el oficio M00.2/076/2021 emitido por la Secretaría Académica, de Investigación e Innovación.', 
    '1.2.2.6': 'Constancia de la del TecNM. Dirección de Docencia e Innovación Educativa del TecNM.\n\nNota: Para el 1.2.2.1 Se debe considerar el registro interno de acuerdo con el oficio M00.2/076/2021 emitido por la Secretaría Académica, de Investigación e Innovación.',
    '1.2.2.7': 'Constancia del TecNM. (la) Responsable del Proyecto Estratégico del TecNM.\n\nNota: Para el 1.2.2.1 Se debe considerar el registro interno de acuerdo con el oficio M00.2/076/2021 emitido por la Secretaría Académica, de Investigación e Innovación.', 
};
    
const puntosPuntos = {
    '1.2.1.1': '20',
    '1.2.1.2': '20', 
    '1.2.1.3': '5',
    '1.2.1.4': '10', 

    '1.2.2.1': '1 punto por hora ',
    '1.2.2.2': '1 punto por hora ', 
    '1.2.2.3': '1 punto por hora ',
    '1.2.2.4': '1 punto por hora ', 
    '1.2.2.5': '1 punto por hora ', 
    '1.2.2.6': '1 punto por hora ',
    '1.2.2.7': '1 punto por hora ', 
};
const puntosMax = {
    '1.2.1.1': '40',
    '1.2.1.2': '40', 
    '1.2.1.3': '10',
    '1.2.1.4': '20', 

    '1.2.2.1': '60',
    '1.2.2.2': '60', 
    '1.2.2.3': '80',
    '1.2.2.4': '80', 
    '1.2.2.5': '80', 
    '1.2.2.6': '80',
    '1.2.2.7': '80',  
};
function mostrarDescripcion() {
    const select = document.getElementById('document_type');
    const descripcion = document.getElementById('descripcion_documento');
    const puntos1 = document.getElementById('puntos');
    const puntos2 = document.getElementById('puntosmax');
    const valorSeleccionado = select.value;

    descripcion.value = descripcionesDescripcion[valorSeleccionado] || 'Descripción no disponible.';
    puntos1.value = puntosPuntos[valorSeleccionado] ||'Descripción no disponible.';
    puntos2.value = puntosMax[valorSeleccionado] ||'Descripción no disponible.';

    const pregunta1_2_2 = document.getElementById('pregunta1_2_2');
    const valoresPermitidos = ['1.2.2.1', '1.2.2.2', '1.2.2.3', '1.2.2.4', '1.2.2.5', '1.2.2.6', '1.2.2.7'];

    pregunta1_2_2.style.display = valoresPermitidos.includes(valorSeleccionado) ? 'flex' : 'none';

    // Mostrar u ocultar el botón según la selección
    //const botonCrearDocumento = document.getElementById('botonCrearDocumento');
    //botonCrearDocumento.style.display = (valorSeleccionado === '7') ? 'block' : 'none';

     // Calcular puntos
     const calcular = document.getElementById('calcular'); 
     const valoresPermitidos2 = ['1.2.1.1', '1.2.1.2', '1.2.1.3', '1.2.1.4'];
 
     if (valoresPermitidos2.includes(valorSeleccionado)) {
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

//function crearDocumento() { 
  //  window.location.href = 'RI7.php'; 
 //   console.log(window.location.href = 'RI7.php'); 
//}

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

    if (valorSeleccionado.startsWith("1.2.1")) {
        titulo.textContent = "1.2.1. Elaboración de material didáctico de la asignatura completa, aprobado y utilizado en la academia (100 Posibles puntos). ";
    } else if (valorSeleccionado.startsWith("1.2.2")) {
        titulo.textContent = "1.2.2. Instructor(a)/facilitador(a) en cursos de formación docente o actualización profesional para profesores(as) del tecnm (100 Posibles puntos).";
    } else {
        titulo.textContent = "Seleccione una opción";
    }
}

function actualizarText() {
    console.log("Función actualizarText llamada"); 
    const select = document.getElementById("document_type");
    const texto = document.getElementById("texto");

    if (!select || !texto) {
        console.error("Elemento no encontrado: select o texto");
        return;
    }

    const valorSeleccionado = select.value;
    console.log("Valor seleccionado:", valorSeleccionado); 
    const textos = {
        "1.2.1.1": "¿Cuántos Proyectos Integradores y/o Recursos Educativos Digitales ha realizado para una asignatura del plan de estudios oficial?",
        "1.2.1.2": "¿Cuántos manuales de prácticas elaboró para el desarrollo de competencias en los planes de estudio 2009 y posteriores?",
        "1.2.1.3": "¿Cuántas estrategias didácticas innovadoras ha implementado en el aula por asignatura, como estudio de casos, aprendizaje basado en problemas, aprendizaje basado en proyectos, aprendizaje experiencial, aula invertida, y escenarios y ambientes virtuales?",
        "1.2.1.4": "¿Cuántos materiales didácticos diseñó y desarrolló con enfoque incluyente para las asignaturas?"
    };
    texto.textContent = textos[valorSeleccionado] || " ";
}

document.getElementById("document_type").addEventListener('change', function() {
    actualizarTitulo(); 
    actualizarText();  
});

document.addEventListener('DOMContentLoaded', function () {
    const tipoSelect = document.getElementById('document_type');
    const submitBtn = document.getElementById('btn-submit');
    const fileInput = document.getElementById('file');

    const camposPorTipo = {
        '1.2.1.1': ['calcular'],
        '1.2.1.2': ['calcular'],
        '1.2.1.3': ['calcular'],
        '1.2.1.4': ['calcular'],
        '1.2.2.1': ['horas'],
        '1.2.2.2': ['horas'],
        '1.2.2.3': ['horas'], 
        '1.2.2.4': ['horas'], '1.2.2.5': ['horas'], '1.2.2.6': ['horas'], '1.2.2.7': ['horas'],
    };

    function actualizarBoton() {
        const tipo = tipoSelect.value;
        const campos = camposPorTipo[tipo] || [];

        const completos = campos.every(id => {
            const el = document.getElementById(id);
            return el && el.value.trim() !== '';
        });

        const fileOk = fileInput.value.trim() !== '';

        const todoListo = tipo && completos && fileOk;

        submitBtn.disabled = !todoListo;
        submitBtn.style.opacity = todoListo ? 1 : 0.5;
    }

    // Escuchar todos los inputs y selects
    document.querySelectorAll('input, select').forEach(el => {
        el.addEventListener('input', actualizarBoton);
        el.addEventListener('change', actualizarBoton);
    });

    actualizarBoton(); // Evaluar al inicio
});