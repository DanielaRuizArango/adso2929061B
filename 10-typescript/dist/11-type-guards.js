"use strict";
// 11 - Type Guards: verificar tipos en tiempo de ejecución
function isNumber(value) {
    return typeof value === "number";
}
const data = 42;
let result;
if (isNumber(data)) {
    result = `It is a number: ${data}`;
}
else {
    result = "Not a number.";
}
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `<li>${result}</li>`;
}
