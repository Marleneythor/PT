
function updateValue(input, outputId) {
    document.getElementById(outputId).textContent = input.value;
}

// function calcularTotal() {
//     let total = 0;

//     // Cálculo basado en los valores de los sliders
//     total += parseInt(document.getElementById("asignaturas1").value) * 5; // Máx 30
//     total += parseInt(document.getElementById("asignaturas2").value) * 10; // Máx 20
//     total += parseInt(document.getElementById("asignaturas3").value) * 5; // Máx 20
//     total += (parseInt(document.getElementById("estudiantes1").value) * 50) / 200; // Máx 50
//     total += parseInt(document.getElementById("estudiantes2").value); // Máx 50
//     total += parseInt(document.getElementById("tutorias").value); // Máx 50
//     total += parseInt(document.getElementById("asignaturas4").value) * 10; // Máx 20
//     total += parseInt(document.getElementById("actividades").value) * 10; // Máx 20

//     // Validación de máximos
//     total = Math.min(total, 200); // Puntaje máximo permitido
//     alert("Puntaje total: " + total);
// }
