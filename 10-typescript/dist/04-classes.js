"use strict";
//Classes: crear clases y metodos
class Car {
    constructor(brand, speed) {
        this.brand = brand;
        this.speed = speed;
    }
    accelerate() {
        return `${this.brand} is accelerating to ${this.speed} km/h`;
    }
}
const car = new Car('Toyota', 120);
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
            <li><strrong>Car:</strong> ${car.brand}</li>
            <li><strong>Speed:</strong> ${car.speed}</li>
            <li>${car.accelerate()}</li>
        `;
}
