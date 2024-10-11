function confirmarEliminacion(id) {
    if (confirm("¿Seguro que deseas eliminar este documento?")) {
        window.location.href = "../includes/eliminar.php?id=" + id;
    }
}

function mostrarVistaPrevia(archivoUrl) {
    const vistaPreviaDiv = document.getElementById('vistaPrevia');
    const iframeVistaPrevia = document.getElementById('iframeVistaPrevia');

}

function mostrarDescripcion() {
    const opcionSeleccionada = document.getElementById('opciones').value;

    // Descripciones para el campo "Nombre"
    const descripcionesNombre = {
        '1': 'Constancia de Recursos Humanos',
        '2': 'Talon de pago',
        '3': 'Carga académica reglamentaria',
        '4': 'Carta de exclusividad',
        '5': 'Docente con plaza de profesor',
        '6': 'Currículum vite CVU',
        '7': 'Constancia del (la) Jefe(a) de Departamento de Servicios Escolares',
        '8': 'Período Sabático por Beca Comisión',
        '9': 'Licencia por gravidez',
        '10': 'Cedula profesional del grado de estudios',
        '11': 'Cumplimiento de actividades docentes',
        '12': 'Liberación de actividades académicas',
        '13': 'Evaluaciones departamentales',
        '14': 'Evaluaciones del desempeño frente al grupo',
    };

    // Descripciones adicionales para el campo "Descripción"
    const descripcionesDescripcion = {
        '1': 'Constancia de Recursos Humanos que especifique el nombramiento en estatus 10 o 95 sin titular, anterior a la quincena 07 del 2024, además deberá especificar que no ha sido acreedor a algún tipo de sanción y que cumplió con al menos el 90% deasistencia de acuerdo con su jornada y horario de trabajo durante el período a evaluar.',
        '2': 'Talón de pago (quincena 07 del 2024, sin la percepción o ajuste del DT o I8).', 
        '3': 'Cumplir con la carga académica reglamentaria, con base en lo dispuesto en el Reglamento Interior de Trabajo del Personal Docente de los Institutos Tecnológicos (Art 143, 144, 146, 147, 148 y 156) reflejado en los horarios del periodo a evaluar y del primer semestre del año de la convocatoria. Para profesores(as) que imparten clases en nivel Posgrado se debenconsiderar los Lineamientos para la Operación de los Estudios de Posgrado en el Tecnológico Nacional de México, en sunumeral 2.4.2. ',
        '4': 'Profesores(as) de tiempo completo presentar carta de exclusividad. Descargar formato en http://www.edd.tecnm.mx',
        '5': 'Los(as) docentes con plaza de profesor(a) investigador(a), deben presentar un proyecto de investigación vigente registrado ante la DPII o de la DDIE del TecNM, o un proyecto de investigación vigente de instituciones u organismos externos al TecNM (Artículo 07 Lineamientos del Programa) que incluya el Dictamen firmado por el(la) Director(a) del plantel así como la opinióndel Comité Institucional de Posgrado e Investigación (CIPI) o por el Comité Académico en caso de que no exista el CIPI. Además, debe comprobar la existencia de al menos un proyecto, con las características antes mencionadas, durante el periodo a evaluar. Los docentes que no cuentan con plaza de profesor(a) investigador(a) y que justifiquen su descarga frente a grupo por el desarrollo de un proyecto de investigación, se deberá presentar la misma documentación.',
        '6': 'Profesores(as) de tiempo completo, presentar constancia del(la) Jefe(a) de Dpto. de Desarrollo Académico, de tener registrado y actualizado su currículum vitae CVU-TecNM. Para ello el(la) docente deberá entregar su CVU en Extenso a dicho departamento ya sea impreso o en electrónico.',
        '7': 'Constancia del(la) Jefe(a) de Departamento de Servicios Escolares que indique por semestre el nivel, el nombre y la clave de las materias que impartió, así como la cantidad de los estudiantes atendidos en cada grupo durante el periodo a evaluar.',
        '8': 'Autorización de Período Sabático o de Licencia por Beca Comisión, si es el caso.',
        '9': 'Licencia por gravidez, si es el caso.',
        '10': 'Entregar la evidencia de la cédula profesional del grado de estudios, obtenida del portal www.cedulaprofesional.sep.gob.mx, de la Dirección General de Profesiones de la SEP; en caso de no contar con esta, se podrá considerar el acta del examen de grado para aquellos docentes que tengan un máximo de dos años de haber presentado el mismo, en cualquier caso, la evidencia deberá ser validada con la leyenda: COPIA FIEL DE LA ORIGINAL con nombre y firma del(la) docente.',
        '11': 'Constancias de cumplimiento de actividades docentes encomendadas en tiempo y forma mediante el formato de liberación de actividades, de los dos semestres del periodo a evaluar. Descargar formato en http://www.edd.tecnm.mx. Donde se especifique que el(la) docente está LIBERADO(A',
        '12': 'Carta de liberación de actividades académicas debidamente requisitada (Anexo XXXVII del Manual de Lineamientos Académicos Administrativos del TecNM), donde se indique que las actividades encomendadas por la Academia o el Consejo de Posgrado o el Claustro Doctoral fueron cumplidas al 100%. Descargar formato en http://www.edd.tecnm.mx',
        '13': 'Para profesores con grupos en licenciatura deben presentar las dos evaluaciones departamentales del periodo a evaluar con nombre, firma y sello por el(la) Jefe(a) de Departamento Académico incluyendo la Autoevaluación, las cuales deberán tener una calificación global mínima de SUFICIENTE. Para el caso de profesores que únicamente tienen grupos de Posgrado deberá presentar una evaluación instrumentada por la propia institución firmada por el Jefe(a) de la DEPI con el Vo. Bo. Del Subdirector(a) Académico(a), con una calificación global mínima de SUFICIENTE.',
        '14': 'Deberá presentar las dos evaluaciones del desempeño frente a grupo del periodo a evaluar selladas y firmadas por el Departamento de Desarrollo Académico con Vo.Bo. del (de la) Subdirector(a) Académico(a), con una calificación mínima de SUFICIENTE, las cuales deberán corresponder a la evaluación de al menos el 60% de los estudiantes atendidos por el docente (el porcentaje no aplica para grupos de posgrado).',
    };

    // Asignar las descripciones a los campos "Nombre" y "Descripción"
    const descripcionSeleccionada = descripcionesNombre[opcionSeleccionada] || 'Descripción predeterminada';
    const descripcion2Seleccionada = descripcionesDescripcion[opcionSeleccionada] || 'Descripción adicional predeterminada';

    document.getElementById('descripcion').value = descripcionSeleccionada;
    document.getElementById('descripcion2').value = descripcion2Seleccionada;

    ajustarAlturaTextarea('descripcion2');


    // Mostrar botón de crear documento si la opción 7 está seleccionada
    const botonCrearDocumento = document.getElementById('botonCrearDocumento');
    botonCrearDocumento.style.display = (opcionSeleccionada === '7') ? 'block' : 'none';
}
function ajustarAlturaTextarea(id) {
    const textarea = document.getElementById(id);
    textarea.style.height = 'auto';  // Resetea la altura para recalcular
    textarea.style.height = textarea.scrollHeight + 'px';  // Ajusta según el contenido
}

function limpiarFormulario() {
    document.getElementById('opciones').value = '0';
    document.getElementById('botonCrearDocumento').style.display = 'none';
    document.getElementById('descripcion').value = '';
    document.getElementById('archivo').value = '';
}

function crearDocumento() { 
    window.location.href = '../RI7/RI7.html';  // Ruta absoluta a partir de la raíz del servidor
}
