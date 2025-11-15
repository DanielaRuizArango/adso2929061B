"use strict";
//Functions: declarar funciones con tipos y retornos
function sum(a, b) {
    return a + b;
}
function greet(name) {
    return `Hello ${name}`;
}
const userName = 'Kevin';
const result = sum(8, 5);
const message = greet(userName);
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li>${message}</li>
        <li><strong>Sum result:</strong> ${result}</li>
        `;
}
