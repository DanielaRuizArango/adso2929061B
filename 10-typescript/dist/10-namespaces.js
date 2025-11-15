"use strict";
// 10 - Namespaces: organizar código dentro de un contenedor lógico
var Space;
(function (Space) {
    class Planet {
        constructor(name, size) {
            this.name = name;
            this.size = size;
        }
    }
    Space.Planet = Planet;
    function describe(planet) {
        return `${planet.name} is ${planet.size} km in diameter.`;
    }
    Space.describe = describe;
})(Space || (Space = {}));
const mars = new Space.Planet("Mars", 6779);
const info = Space.describe(mars);
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li>${info}</li>
    `;
}
