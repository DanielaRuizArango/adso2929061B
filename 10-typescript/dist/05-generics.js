"use strict";
// Generics: crear funciones reutilizables con tipos genéricos
function showItem(item) {
    return `Item: ${item}`;
}
function combine(first, second) {
    return `Combined: ${first} and ${second}`;
}
const msg1 = showItem(99);
const msg2 = combine("Success", true);
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li>${msg1}</li>
        <li>${msg2}</li>
    `;
}
