console.log('scripts cargado correctamente'); 

const descripcionesDescripcion = {
    '2.1.1.1': '• En ambos casos, impresión de pantalla de la página de Clarivate, convo.bo. de la subdirección académica donde aparece el nombre de larevista, la cual se puede obtener de la siguiente liga:http://mjl.clarivate.com para validar la pertenencia al Master JournalList. Además, copia de la carátula del artículo en la cual se mencionela adscripción del autor al Tecnológico Nacional de México con vo.bo.de la subdirección académica, de acuerdo con la circular no.D/060/2019 \n• Constancia emitida por el(la) jefe(a) de departamento académico convo.bo. de la subdirección académica donde se indique la colaboraciónde estudiantes (sólo para el apartado 2.1.1.1.2.)',
    '2.1.1.2': '• En ambos casos, copia del comprobante donde se indique el o losíndices de la revista con vo.bo. de la subdirección académica. Además,copia de la carátula del artículo en la cual se mencione la adscripcióndel autor al Tecnológico Nacional de México con vo.bo. de lasubdirección académica, de acuerdo con la circular no. D/060/2019 \n•  Constancia emitida por el(la) jefe(a) de departamento académico convo.bo. de la subdirección académica donde se indique la colaboraciónde estudiantes (sólo para el apartado 2.1.1.2.2.) \n Nota: No se consideran Artículos derivados de Memoria de Congresos (Las evidencias presentadas NO deberán contener la palabra Congreso, Coloquio, Workshop, etc)',
    '2.1.1.3': '• En ambos casos copia de la carátula del artículo publicado se mencione la adscripción del autor al Tecnológico Nacional de México, donde se indique los autores, datos del congreso e ISBN o ISSN de la memoria del congreso con vo.bo. de la subdirección académica. \n• Constancia emitida por el jefe(a) de departamento académico convo.bo. de la subdirección académica donde se indique la colaboraciónde estudiantes (sólo para el apartado 2.1.1.3.2.)',
    '2.1.1.4': '• Portada e índice del libro con vo.bo. por la dirección del plantel. \n• Evidencia en donde se muestre que en el libro aparece la adscripción del autor al Tecnológico Nacional de México. \n• Constancia de libro o capítulo publicado firmada por el(la) director(a) donde se especifique: \n ▪Autores \n ▪ISBN \n ▪Nombre de la publicación \n ▪Editorial. Se sugiere que la publicación pertenezca a una casa editorial registrada en la cámara nacional de la industria editorial mexicana (CANIEM) http://www.caniem.com) \n ▪Fecha de publicación (dentro del periodo a evaluar) \n ▪Que no es producto de periodo sabático, tesis, tesina, compilaciones o memorias de congresos, seminarios o eventos académicos y científicos. \n ▪Que el libro está relacionado con los programas que se imparten en el instituto. \n• Las evidencias se requieren para ambos casos.',
    '2.1.1.5': '• Para 2.1.1.5.1. Constancia o correo electrónico oficial comunicando la liberación u oficio de liberación de la instancia correspondiente convo.bo. de la subdirección académica. \n• Para 2.1.1.5.2. Oficio de liberación por la Dirección de Docencia eInnovación Educativa o de la Dirección de Posgrado de Investigación eInnovación.',
    '2.1.2.1': '• Constancia de vigencia de la red, emitida por la Dirección dePosgrado, Investigación e Innovación. \n• Nombramiento del líder de la red, emitido por la Dirección dePosgrado, Investigación e Innovación. \n• Constancia del Líder de la Red que avala la participación de(la)docente como miembro de la Red, con Vo.Bo. de la SubdirecciónAcadémica.',
    '2.1.2.2': '• Dictamen de PRODEP (TecNM o DGSUI) del cuerpo académico, convigencia en el período a evaluar y constancia en donde seespecifiquen los integrantes del cuerpo académico firmada por elrepresentante institucional PRODEP con vo.bo. de la subdirecciónacadémica.',
};


const puntosPuntos = {
    '2.1.1.1': '2.1.1.1.1. Artículo publicado en el periodo a evaluar, en revista indizada en JOURNAL CITATION REPORTS: \n 2.1.1.1.1.1. Autor principal o Autor de correspondencia = 80, \n 2.1.1.1.1.2. Co-autores = 40 \n2.1.1.1.2. Artículo publicado en el periodo a evaluar, en revista indizada en JOURNAL CITATION REPORTS. Con participación de estudiantes inscritos en el TecNM: \n 2.1.1.1.2.1. Autor principal o Autor de correspondencia = 100, \n 2.1.1.1.2.2. Co-autores = 50',
    '2.1.1.2': '2.1.1.2.1. Artículos publicados en el periodo a evaluar, en revista incluida en otros índices: \n 2.1.1.2.1.1. Autor principal o Autor de correspondencia = 30, \n 2.1.1.2.1.2. Co-autores = 15 \n2.1.1.2.2. Artículos publicados en el periodo a evaluar, en revista incluida en otros índices. Con participación de estudiantes inscritos en el TecNM: \n 2.1.1.2.2.1. Autor principal o Autor de correspondencia = 40, 2.1.1.2.2.2. Co-autores = 20',
    '2.1.1.3': '2.1.1.3.1. Con ISBN o ISSN: \n 2.1.1.3.1.1. Autor principal = 10, \n 2.1.1.3.1.2. Co-autores = 5,\n2.1.1.3.2. Con ISBN o ISSN y participación de estudiantes inscritos en el TecNM:\n 2.1.1.3.2.1. Autor principal = 20, \n 2.1.1.3.2.2. Co-autores = 10',
    '2.1.1.4': '2.1.1.4.1. Libro publicado con créditos al TecNM (impreso o electrónico), excepto; compilaciones de artículos, antologías, monografías y memorias de congresos. = 100, \n 2.1.1.4.2. Capítulo de libro publicado: \n 2.1.1.4.2.1. Autor principal = 10, \n 2.1.1.4.2.2. Co-autores (máximo cinco) = 5',
    '2.1.1.5': '2.1.1.5.1. Proyectos de Investigación con financiamiento: \n 2.1.1.5.1.1. Responsable o Director(a) del proyecto = 40, \n 2.1.1.5.1.2. Colaborador(a) del proyecto (Máximo 5 docentes) = 15, \n2.1.2.5.2. Proyectos de Investigación Educativa o Ciencia Básica y Aplicada, autorizados por el TecNM:\n 2.1.2.5.2.1. Responsable del proyecto = 40, \n 2.1.2.5.2.2. Colaborador(a) del proyecto (Máximo 5 docentes) = 15',
    '2.1.2.1': '2.1.2.1.1. Regional = 2.5, \n2.1.2.1.2. Nacional = 3.33, \n2.1.2.1.3. Internacional = 4.16',
    '2.1.2.2': '2.1.2.2.1. En Formación = 2.5, \n 2.1.2.2.2. En Consolidación = 3.33, \n 2.1.2.2.3. Consolidado = 4.16',
};

const puntosMax = {
    '2.1.1.1': '2.1.1.1.1. Artículo publicado en el periodo a evaluar, en revista indizada en JOURNAL CITATION REPORTS: \n 2.1.1.1.1.1. Autor principal o Autor de correspondencia = 80, \n 2.1.1.1.1.2. Co-autores = 40 \n2.1.1.1.2. Artículo publicado en el periodo a evaluar, en revista indizada en JOURNAL CITATION REPORTS. Con participación de estudiantes inscritos en el TecNM: \n 2.1.1.1.2.1. Autor principal o Autor de correspondencia = 100, \n 2.1.1.1.2.2. Co-autores = 50',
    '2.1.1.2': '2.1.1.2.1. Artículos publicados en el periodo a evaluar, en revista incluida en otros índices: \n 2.1.1.2.1.1. Autor principal o Autor de correspondencia = 60, \n 2.1.1.2.1.2. Co-autores = 30 \n2.1.1.2.2. Artículos publicados en el periodo a evaluar, en revista incluida en otros índices. Con participación de estudiantes inscritos en el TecNM: \n 2.1.1.2.2.1. Autor principal o Autor de correspondencia = 80, 2.1.1.2.2.2. Co-autores = 40',
    '2.1.1.3': '2.1.1.3.1. Con ISBN o ISSN: \n 2.1.1.3.1.1. Autor principal = 20, \n 2.1.1.3.1.2. Co-autores = 10,\n2.1.1.3.2. Con ISBN o ISSN y participación de estudiantes inscritos en el TecNM:\n 2.1.1.3.2.1. Autor principal = 20, \n 2.1.1.3.2.2. Co-autores = 10',
    '2.1.1.4': '2.1.1.4.1. Libro publicado con créditos al TecNM (impreso o electrónico), excepto; compilaciones de artículos, antologías, monografías y memorias de congresos. = 100, \n 2.1.1.4.2. Capítulo de libro publicado: \n 2.1.1.4.2.1. Autor principal = 20, \n 2.1.1.4.2.2. Co-autores (máximo cinco) = 10',
    '2.1.1.5': '2.1.1.5.1. Proyectos de Investigación con financiamiento: \n 2.1.1.5.1.1. Responsable o Director(a) del proyecto = 40, \n 2.1.1.5.1.2. Colaborador(a) del proyecto (Máximo 5 docentes) = 15, \n2.1.2.5.2. Proyectos de Investigación Educativa o Ciencia Básica y Aplicada, autorizados por el TecNM:\n 2.1.2.5.2.1. Responsable del proyecto = 40, \n 2.1.2.5.2.2. Colaborador(a) del proyecto (Máximo 5 docentes) = 15',
    '2.1.2.1': '2.1.2.1.1. Regional = 30, \n2.1.2.1.2. Nacional = 40, \n2.1.2.1.3. Internacional = 50',
    '2.1.2.2': '2.1.2.2.1. En Formación = 30, \n 2.1.2.2.2. En Consolidación = 40, \n 2.1.2.2.3. Consolidado = 50',
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

    const pregunta1 = document.getElementById('pregunta1');
    pregunta1.style.display = (valorSeleccionado === '2.1.1.1') ? 'flex' : 'none';
    const pregunta2 = document.getElementById('pregunta2');
    pregunta2.style.display = (valorSeleccionado === '2.1.1.2') ? 'flex' : 'none';
    const pregunta3 = document.getElementById('pregunta3');
    pregunta3.style.display = (valorSeleccionado === '2.1.1.3') ? 'flex' : 'none';
    const pregunta4 = document.getElementById('pregunta4');
    pregunta4.style.display = (valorSeleccionado === '2.1.1.4') ? 'flex' : 'none';
    const pregunta5 = document.getElementById('pregunta5');
    pregunta5.style.display = (valorSeleccionado === '2.1.1.5') ? 'flex' : 'none';
    const pregunta6 = document.getElementById('pregunta6');
    pregunta6.style.display = (valorSeleccionado === '2.1.2.1') ? 'flex' : 'none';
    const pregunta7 = document.getElementById('pregunta7');
    pregunta7.style.display = (valorSeleccionado === '2.1.2.2') ? 'flex' : 'none';


     // Manejo de subir archivos
     const subir2 = document.getElementById('subir2'); // Para 1.4.1 (dos archivos)
     const subir = document.getElementById('subir'); // Para otros casos (un archivo)
     const subir3 = document.getElementById('subir3')
     const subir21 = document.getElementById('subir21');
 
     const valoresPermitidos = ['2.1.1.1', '2.1.1.2', '2.1.1.3'];
 
     if (valoresPermitidos.includes(valorSeleccionado)) {
        subir2.style.display = 'flex';
        subir.style.display = 'none';
        subir3.style.display = 'none';
        subir21.style.display = 'none';
    } else if (valorSeleccionado === '2.1.2.2'||valorSeleccionado === '2.1.1.5' ) {
        subir2.style.display = 'none';
         subir.style.display = 'flex';
        subir21.style.display = 'none';
        subir3.style.display = 'none';
         
        subir3.style.display = 'none';
    } else if (valorSeleccionado === '2.1.1.4'||valorSeleccionado === '2.1.2.1' ) {
        subir.style.display = 'none';
        subir2.style.display = 'none';
        subir21.style.display = 'flex';
        subir3.style.display = 'flex';
    } else {
        subir2.style.display = 'none';
         subir.style.display = 'none';
         
        subir21.style.display = 'none';
        subir3.style.display = 'none';
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
function textFile() {
    const select = document.getElementById("document_type");
    const textfile1 = document.getElementById("textfile1");
    const valorSeleccionado = select.value;

    if (valorSeleccionado.startsWith("2.1.1.1")) {
        textfile1.textContent = "Impresión de pantalla de la página de Clarivate:";
    } else if (valorSeleccionado.startsWith("2.1.1.2")) {
        textfile1.textContent = "Copia del comprobante donde se indique el o los índices de la revista con vo.bo. de la subdirección académica:";
    } else if (valorSeleccionado.startsWith("2.1.1.3")) {
        textfile1.textContent = "Copia de la carátula del artículo publicado en la cual se mencione la adscripción del autor al Tecnológico Nacional de México:";
    } else {
        textfile1.textContent = " ";
    }
}
function textFile2() {
    const select = document.getElementById("document_type");
    const textfile2 = document.getElementById("textfile2");
    const valorSeleccionado = select.value;

    if (valorSeleccionado.startsWith("2.1.1.1")) {
        textfile2.textContent = "Constancia emitida por el(la) jefe(a) de departamento académico con vo.bo. de la subdirección académica:";
    } else if (valorSeleccionado.startsWith("2.1.1.2")) {
        textfile2.textContent = "Constancia emitida por el(la) jefe(a) de departamento académico con vo.bo. de la subdirección académica:";
    } else if (valorSeleccionado.startsWith("2.1.1.3")) {
        textfile2.textContent = "Constancia emitida por el(la) jefe(a) de departamento académico convo.bo. de la subdirección académica:";
    } else {
        textfile2.textContent = " ";
    }
}
function textFile4() {
    const select = document.getElementById("document_type");
    const textfile3 = document.getElementById("textfile3");
    const valorSeleccionado = select.value;

    if (valorSeleccionado.startsWith("2.1.1.4")) {
        textfile3.textContent = "Portada e índice del libro con vo.bo. por la dirección del plantel:";
    } else if (valorSeleccionado.startsWith("2.1.2.1")) {
        textfile3.textContent = "Constancia de vigencia de la red, emitida por la Dirección dePosgrado, Investigación e Innovación:";
    } else {
        textfile3.textContent = " ";
    }
}
function textFile5() {
    const select = document.getElementById("document_type");
    const textfile4 = document.getElementById("textfile4");
    const valorSeleccionado = select.value;

    if (valorSeleccionado.startsWith("2.1.1.4")) { 
        textfile4.textContent = "Evidencia en donde se muestre que en el libro aparece la adscripción del autor al Tecnológico Nacional de México:";
    } else if (valorSeleccionado.startsWith("2.1.2.1")) {
        textfile4.textContent = "Nombramiento del líder de la red, emitido por la Dirección dePosgrado, Investigación e Innovación:";
    } else {
        textfile4.textContent = " ";
    }
}
function textFile3() {
    const select = document.getElementById("document_type");
    const textfile5 = document.getElementById("textfile5");
    const valorSeleccionado = select.value;

    if (valorSeleccionado.startsWith("2.1.1.4")) {  
        textfile5.textContent = "Constancia de libro o capítulo publicado firmada por el(la) director(a):";
    } else if (valorSeleccionado.startsWith("2.1.2.1")) {
        textfile5.textContent = "Constancia del Líder de la Red que avala la participación de(la)docente como miembro de la Red, con Vo.Bo. de la SubdirecciónAcadémica:";
    } else {
        textfile5.textContent = " ";
    }
}


document.addEventListener('DOMContentLoaded', function () {
    const tipoSelect = document.getElementById('document_type');
    const submitBtn = document.getElementById('btn-submit');
    const fileInput = document.getElementById('file');
    const file1Input = document.getElementById('file1');
    const file2Input = document.getElementById('file2');
    const file3Input = document.getElementById('file3');
    const file4Input = document.getElementById('file4');
    const file5Input = document.getElementById('file5');

    const camposPorTipo = {
        '2.1.1.1': ['opcion1'],
        '2.1.1.2': ['opcion2'],
        '2.1.1.3': ['opcion3', 'calcular3'],
        '2.1.1.4': ['opcion4', 'calcular4'],
        '2.1.1.5': ['opcion5'],
        '2.1.2.1': ['opcion6', 'calcular6'],
        '2.1.2.2': ['opcion7', 'calcular7'],
    };

    const tiposConDosArchivos = ['2.1.1.5', '2.1.2.2'];
    const tiposConDosArchivos2 = ['2.1.2.1', '2.1.1.4'];
    function actualizarBoton() {
        const tipo = tipoSelect.value;
        const campos = camposPorTipo[tipo] || [];

        const completos = campos.every(id => {
            const el = document.getElementById(id);
            return el && el.value.trim() !== '';
        });

        // Verificar archivos según el tipo
        let archivosOk = false;
        if (tiposConDosArchivos.includes(tipo)) {
            archivosOk = fileInput.value.trim() !== '';
        } else if (tiposConDosArchivos2.includes(tipo)) {
            archivosOk = file3Input.value.trim() !== '' && file4Input.value.trim() !== '' && file5Input.value.trim() !== '';
        }else {
            archivosOk = file1Input.value.trim() !== '' && file2Input.value.trim() !== '';
        }

        const todoListo = tipo && completos && archivosOk;

        submitBtn.disabled = !todoListo;
        submitBtn.style.opacity = todoListo ? 1 : 0.5;
    }

    document.querySelectorAll('input, select').forEach(el => {
        el.addEventListener('input', actualizarBoton);
        el.addEventListener('change', actualizarBoton);
    });

    actualizarBoton();
});


