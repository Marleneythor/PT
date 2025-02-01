document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("evaluacionForm");
    const inputs = form.querySelectorAll("input[type='number']");
    const totalScoreDisplay = document.getElementById("totalScore");
    const puntajeFinal = document.getElementById("puntajeFinal");

    // Actualizar el puntaje total cada vez que cambia un valor
    inputs.forEach(input => {
        input.addEventListener("input", () => {
            let total = 0;
            inputs.forEach(i => {
                total += parseInt(i.value || "0", 10); // Suma valores
            });
            totalScoreDisplay.textContent = `Puntaje Total: ${total}`;
            puntajeFinal.value = total; // Actualiza el campo oculto
        });
    });
});
