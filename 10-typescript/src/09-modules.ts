// 09-modules.ts

import { add, PI } from "./mathUtils.js"; 
// OJO: usa extensión .js porque TypeScript compila módulos ES6 a .js

const result = add(5, 7);
const circleLength = 2 * PI * 3; // circunferencia de un círculo de radio 3

const output09 = document.getElementById("output09");

if (output09) {
    output09.innerHTML = `
        <li><strong>Import add():</strong> 5 + 7 = ${result}</li>
        <li><strong>Import PI:</strong> Longitud de un círculo de radio 3 = ${circleLength.toFixed(
            2
        )}</li>
    `;
}
