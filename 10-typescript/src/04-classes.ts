//Classes: crear clases y metodos
class Car {
    brand: string;
    speed: number;
    constructor(brand: string, speed: number) {
        this.brand = brand;
        this.speed = speed;
    }
    accelerate(): string {
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
