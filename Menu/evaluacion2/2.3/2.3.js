console.log('scripts cargado correctamente'); 

const descripcionesDescripcion = {
    '2.3.1.1': '• Constancia de las visitas realizadas mencionando empresa visitada, fecha de la visita, asignatura y número de estudiantes, emitida por eldepartamento de gestión tecnológica y vinculación, con vo.bo. de lasubdirección académica. ',
    '2.3.1.2': '• Certificado expedido por algún organismo o institución certificador(a) con vo.bo. de la subdirección académica.',
    '2.3.2': '• Constancia de la institución organizadora donde se indique el evento o concurso donde participó o en su caso, constancia emitida por el departamento académico con vo.bo. de la subdirección académica. ',
    '2.3.3': '• Constancia de la institución organizadora que indique el proyecto premiado con vo.bo. de la subdirección académica. ',
    '2.3.4.1': ' • Constancia de cumplimiento especificando nombre de los residentes, empresas y períodos, expedida por el(la) jefe(a) de departamento académico correspondiente con vo.bo. de la subdirección académica. ',
    '2.3.4.2': '• Constancia de cumplimiento especificando nombre de losestudiantes, empresas y con un mínimo de 1,000 horas de acuerdocon el modelo, expedida por el(la) jefe(a) de departamentoacadémico correspondiente con vo.bo. de la subdirecciónacadémica. ',
    '2.3.4.3': '• Constancia de cumplimiento especificando nombre del proyectoestratégico de impacto, nombre de los residentes, empresas yperíodos, expedida por el(la) jefe(a) de departamento académicocorrespondiente con vo.bo. de la subdirección académica. ',
    '2.3.5.1': '• Constancia emitida por el comité organizador del evento profesional,académico con vo.bo. de la subdirección académica y oficio decomisión. Para eventos fuera del país debe incluir la autorización deCOMEXTRA (para eventos atendidos de manera virtual no esnecesario el COMEXTRA).\n• Este numeral no aplica en periodos vacacionales.',
    '2.3.6.1': '• Oficio de comisión firmado por el(la) Director(a) y constancia que mencione las actividades y los resultados de impacto para el plantel de adscripción, emitida por la empresa, institución o centro de investigación en hoja membretada, con sello y RFC.',
    '2.3.6.2': '• Autorización COMEXTRA y constancia de cumplimiento en donde seindiquen las actividades y los resultados de impacto para el plantel deadscripción, emitida por la empresa institución o centro deinvestigación en hoja membretada y sello.',
    '2.3.7.1': '• Constancia emitida por el(la) Director(a) indicando: \n• Tipo del convenio entre instancias involucradas \n• Vigencia del convenio o servicio \n• Cláusula de responsabilidad económica entre entidades \n• Hacer constar que los servicios realizados son para una entidadexterna al centro de trabajo de adscripción.\n• El(la) responsable del servicio y las funciones de los(as)colaboradores(as).\n• Constancia que mencione los servicios tecnológicos recibidos y establecidos en el acuerdo/convenio en hoja membretada, con sello y RFC, firmada por el representante de la entidad externa.',
    '2.3.7.2': '• Constancia emitida por el(la) Director(a) indicando: \n• Tipo del convenio entre instancias involucradas \n• Vigencia del convenio o servicio \n• Cláusula de responsabilidad económica entre entidades \n• Hacer constar que los servicios realizados son para una entidadexterna al centro de trabajo de adscripción. \n• El(la) responsable del servicio y las funciones de los(as)colaboradores(as). \n• Constancia que mencione los servicios técnicos o certificaciones externas recibidas y establecidos en el acuerdo/convenio, en hoja membretada, con sello y RFC, firmada por el representante de la entidad externa.',
    '2.3.7.3': '• Constancia de proyecto terminado donde se indique el tiempo de laasesoría firmada por parte del(la) jefe(a) del departamento de gestióntecnológica y vinculación con vo.bo. de la subdirección académica. \n• Registro de la incubadora emitido por la unidad de desarrolloproductivo de la secretaría de economía.',
    '2.3.7.4': '• Oficio de acreditación del NODESS con folio del registro por parte delINAES. \n• Constancia de participación del(la) jefe(a) del departamento degestión tecnológica y vinculación con vo.bo. de la subdirecciónacadémica',

};
    
const puntosPuntos = {
    '2.3.1.1': '10',
    '2.3.1.2': '20',
    '2.3.2': '2.3.2.1. Estatal/Regional = 10, \n2.3.2.2. Nacional = 15, \n2.3.2.3. Internacional (fuera del país) = 20',
    '2.3.3': '2.3.3.1. 3º Lugar Nacional = 10, \n2.3.3.2. 2º Lugar Nacional = 15, \n2.3.3.3. 1º Lugar Nacional = 20, \n2.3.3.4. 3º Lugar Internacional (fuera del país) = 30, \n2.3.3.5. 2º Lugar Internacional (fuera del país) = 35, \n2.3.3.6. 1º Lugar Internacional (fuera del país) = 40',   
    '2.3.4.1': '10',
    '2.3.4.2': '20',
    '2.3.4.3': '20',
    '2.3.5.1': '2.3.5.1.1. Conferencia o ponencia en el TecNM = 15, \n2.3.5.1.2. Conferencia o ponencia fuera del TecNM = 10, \n2.3.5.1.3. Conferencia o ponencia fuera del país = 20',
    '2.3.6.1': '20',
    '2.3.6.2': '30',
    '2.3.7.1': '20',
    '2.3.7.2': '20',
    '2.3.7.3': '20',
    '2.3.7.4': '20',
};
const puntosMax = {
    '2.3.1.1': '20',
    '2.3.1.2': '20',
    '2.3.2': '2.3.2.1. Estatal/Regional = 10, \n2.3.2.2. Nacional = 15, \n2.3.2.3. Internacional (fuera del país) = 20',
    '2.3.3': '2.3.3.1. 3º Lugar Nacional = 30, \n2.3.3.2. 2º Lugar Nacional = 30, \n2.3.3.3. 1º Lugar Nacional = 40, \n2.3.3.4. 3º Lugar Internacional (fuera del país) = 30, \n2.3.3.5. 2º Lugar Internacional (fuera del país) = 35, \n2.3.3.6. 1º Lugar Internacional (fuera del país) = 40',
    '2.3.4.1': '60',
    '2.3.4.2': '60',
    '2.3.4.3': '60',
    '2.3.5.1': '2.3.5.1.1. Conferencia o ponencia en el TecNM = 30, \n2.3.5.1.2. Conferencia o ponencia fuera del TecNM = 30, \n2.3.5.1.3. Conferencia o ponencia fuera del país = 30',
    '2.3.6.1': '20',
    '2.3.6.2': '30',
    '2.3.7.1': '20',
    '2.3.7.2': '20',
    '2.3.7.3': '20',
    '2.3.7.4': '20',
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

    const pregunta1 = document.getElementById('pregunta1');
    pregunta1.style.display = (valorSeleccionado === '2.3.2') ? 'flex' : 'none';
    const pregunta2 = document.getElementById('pregunta2');
    pregunta2.style.display = (valorSeleccionado === '2.3.3') ? 'flex' : 'none';
    const pregunta3 = document.getElementById('pregunta3');
    pregunta3.style.display = (valorSeleccionado === '2.3.5.1') ? 'flex' : 'none';
    const pregunta4 = document.getElementById('pregunta4');
    pregunta4.style.display = (valorSeleccionado === '2.3.7.1') ? 'flex' : 'none';
    const pregunta5 = document.getElementById('pregunta5');
    pregunta5.style.display = (valorSeleccionado === '2.3.7.2') ? 'flex' : 'none';
 


    // Mostrar u ocultar el botón según la selección
    //const botonCrearDocumento = document.getElementById('botonCrearDocumento');
    //botonCrearDocumento.style.display = (valorSeleccionado === '7') ? 'block' : 'none';

     // Calcular puntos
     const calcular = document.getElementById('calcular'); 
     const valoresPermitidos2 = ['2.3.1.1', '2.3.3', '2.3.4.1', '2.3.4.2', '2.3.4.3', '2.3.5.1'];
 
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

    if (valorSeleccionado.startsWith("2.3.1")) {
        titulo.textContent = "2.3.1. Vinculación para el aprendizaje (40 puntos posibles).";
    } else if (valorSeleccionado.startsWith("2.3.4")) {
        titulo.textContent = "2.3.4. Asesoría a estudiantes en residencias profesionales o de estudiantes en proyecto de formación dual \nnota: Para proyectos de residencias y dual de participación múltiple, se considera por proyecto y es independiente al número de estudiantes (60 puntos posibles).";
    } else if (valorSeleccionado.startsWith("2.3.5")) {
        titulo.textContent = "2.3.5 Participación con el entorno en actividades de vinculación (30 puntos posibles).";
    } else if (valorSeleccionado.startsWith("2.3.6")) {
        titulo.textContent = "2.3.6 Estancia en empresas, industrias, instituciones de educación superior o centros de investigación, relacionado con su profesión o su función institucional. \nNota: Sólo se considera una estancia en el periodo a evaluar. No se otorgan puntos en estancias por Período Sabático. (30 puntos posibles).";    
    } else if (valorSeleccionado.startsWith("2.3.7")) {
        titulo.textContent = "2.3.7. Actividades de vinculación para la innovación \nNota: Sólo se consideran los servicios realizados para una entidad externa al centro de trabajo de adscripción (40 puntos posibles).";    
    } else {
        titulo.textContent = "";
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

    if (valorSeleccionado.startsWith("2.3.1.1")) {
        texto.textContent = "hola";
    } else if (valorSeleccionado.startsWith("2.3.3")) {
        texto.textContent = "";
    } else if (valorSeleccionado.startsWith("2.3.4.1")) {
        texto.textContent = "";
    } else if (valorSeleccionado.startsWith("2.3.4.2")) {
        texto.textContent = "";
    } else if (valorSeleccionado.startsWith("2.3.4.3")) {
        texto.textContent = "";
    } else if (valorSeleccionado.startsWith("2.3.5.1")) {
        texto.textContent = "";
    } else {
        texto.textContent = " ";
    }
}

