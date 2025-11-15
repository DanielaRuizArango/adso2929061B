"use strict";
// 15 - Error Handling: manejo de errores con try/catch
function calculateDivision(a, b) {
    if (b === 0)
        throw new Error("Division by zero is not allowed");
    return a / b;
}
let message;
try {
    const result = calculateDivision(10, 2);
    message = `Result: ${result}`;
}
catch (error) {
    message = `Error: ${error.message}`;
}
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `<li>${message}</li>`;
}
