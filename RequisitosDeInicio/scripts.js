console.log('scripts.js cargado correctamente'); 

const descripcionesDescripcion = {
        'RI1': 'Constancia de Recursos Humanos que especifique el nombramiento en estatus 10 o 95 sin titular, anterior a la quincena 07 del 2025, además deberá especificar que no ha sido acreedor a algún tipo de sanción y que cumplió con al menos el 90% deasistencia de acuerdo con su jornada y horario de trabajo durante el período a evaluar.',
        'RI2': 'Talón de pago (quincena 07 del 2025, sin la percepción o ajuste del DT o I8).', 
        'RI3': 'Cumplir con la carga académica reglamentaria, con base en lo dispuesto en el Reglamento Interior de Trabajo del Personal Docente de los Institutos Tecnológicos (Art 143, 144, 146, 147, 148 y 156) reflejado en los horarios del periodo a evaluar y del primer semestre del año de la convocatoria. Para profesores(as) que imparten clases en nivel Posgrado se debenconsiderar los Lineamientos para la Operación de los Estudios de Posgrado en el Tecnológico Nacional de México, en sunumeral 2.4.2. ',
        'RI4': 'Profesores(as) de tiempo completo presentar carta de exclusividad. Descargar formato en http://www.edd.tecnm.mx',
        'RI5': 'Los(as) docentes con plaza de profesor(a) investigador(a), deben presentar un proyecto de investigación vigente registrado ante la DPII o de la DDIE del TecNM, o un proyecto de investigación vigente de instituciones u organismos externos al TecNM (Artículo 07 Lineamientos del Programa) que incluya el Dictamen firmado por el(la) Director(a) del plantel así como la opinióndel Comité Institucional de Posgrado e Investigación (CIPI) o por el Comité Académico en caso de que no exista el CIPI. Además, debe comprobar la existencia de al menos un proyecto, con las características antes mencionadas, durante el periodo a evaluar. Los docentes que no cuentan con plaza de profesor(a) investigador(a) y que justifiquen su descarga frente a grupo por el desarrollo de un proyecto de investigación, se deberá presentar la misma documentación.',
        'RI6': 'Profesores(as) de tiempo completo, presentar constancia del(la) Jefe(a) de Dpto. de Desarrollo Académico, de tener registrado y actualizado su currículum vitae CVU-TecNM. Para ello el(la) docente deberá entregar su CVU en Extenso a dicho departamento ya sea impreso o en electrónico.',
        'RI7': 'Constancia del(la) Jefe(a) de Departamento de Servicios Escolares que indique por semestre el nivel, el nombre y la clave de las materias que impartió, así como la cantidad de los estudiantes atendidos en cada grupo durante el periodo a evaluar.',
        'RI8': 'Autorización de Período Sabático o de Licencia por Beca Comisión, si es el caso.',
        'RI9': 'Licencia por gravidez, si es el caso.',
        'RI10': 'Entregar la evidencia de la cédula profesional del grado de estudios, obtenida del portal www.cedulaprofesional.sep.gob.mx, de la Dirección General de Profesiones de la SEP; en caso de no contar con esta, se podrá considerar el acta del examen de grado para aquellos docentes que tengan un máximo de dos años de haber presentado el mismo, en cualquier caso, la evidencia deberá ser validada con la leyenda: COPIA FIEL DE LA ORIGINAL con nombre y firma del(la) docente.',
        'RI11': 'Constancias de cumplimiento de actividades docentes encomendadas en tiempo y forma mediante el formato de liberación de actividades, de los dos semestres del periodo a evaluar. Descargar formato en http://www.edd.tecnm.mx. Donde se especifique que el(la) docente está LIBERADO(A',
        'RI12': 'Carta de liberación de actividades académicas debidamente requisitada (Anexo XXXVII del Manual de Lineamientos Académicos Administrativos del TecNM), donde se indique que las actividades encomendadas por la Academia o el Consejo de Posgrado o el Claustro Doctoral fueron cumplidas al 100%. Descargar formato en http://www.edd.tecnm.mx',
        'RI13': 'Para profesores con grupos en licenciatura deben presentar las dos evaluaciones departamentales del periodo a evaluar con nombre, firma y sello por el(la) Jefe(a) de Departamento Académico incluyendo la Autoevaluación, las cuales deberán tener una calificación global mínima de SUFICIENTE. Para el caso de profesores que únicamente tienen grupos de Posgrado deberá presentar una evaluación instrumentada por la propia institución firmada por el Jefe(a) de la DEPI con el Vo. Bo. Del Subdirector(a) Académico(a), con una calificación global mínima de SUFICIENTE.',
        'RI14': 'Deberá presentar las dos evaluaciones del desempeño frente a grupo del periodo a evaluar selladas y firmadas por el Departamento de Desarrollo Académico con Vo.Bo. del (de la) Subdirector(a) Académico(a), con una calificación mínima de SUFICIENTE, las cuales deberán corresponder a la evaluación de al menos el 60% de los estudiantes atendidos por el docente (el porcentaje no aplica para grupos de posgrado).',
    };


function mostrarDescripcion() {
    const select = document.getElementById('document_type');
    const descripcion = document.getElementById('descripcion_documento');
    const valorSeleccionado = select.value;

    descripcion.value = descripcionesDescripcion[valorSeleccionado] || 'Descripción no disponible.';
   
    // Mostrar u ocultar el botón según la selección
    const botonCrearDocumento = document.getElementById('botonCrearDocumento');
    botonCrearDocumento.style.display = (valorSeleccionado === 'RI7') ? 'block' : 'none';

    const pregunta1_1_4 = document.getElementById('pregunta1_1_4');
    pregunta1_1_4.style.display = (valorSeleccionado === 'RI7') ? 'flex' : 'none';
    const pregunta1_4_9 = document.getElementById('pregunta1_4_9');
    pregunta1_4_9.style.display = (valorSeleccionado === 'RI10') ? 'flex' : 'none';
    

    if (valoresPermitidos.includes(valorSeleccionado)) {
        calcular.style.display = 'flex';
    } else {
        calcular.style.display = 'none';
    }
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
    window.location.href = 'RI7.php';  
    
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


document.addEventListener('DOMContentLoaded', function () {
    const tipoSelect = document.getElementById('document_type');
    const submitBtn = document.getElementById('btn-submit');
    const fileInput = document.getElementById('file');

    const camposPorTipo = {
        'RI7': ['nivel_estudiantes', 'num_estudiantes', 'calculo', 'calculo2', 'calculo3'],
        'RI10': ['opcion_10'],
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

    document.querySelectorAll('input, select').forEach(el => {
        el.addEventListener('input', actualizarBoton);
        el.addEventListener('change', actualizarBoton);
    });
    actualizarBoton();
});