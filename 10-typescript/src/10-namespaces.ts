// --- Declaración del namespace ---
namespace Utils {
    // Función dentro del namespace
    export function greet(name: string): string {
        return `Hola, ${name}! Bienvenido a Namespaces.`;
    }

    // Clase dentro del namespace
    export class Person {
        constructor(public name: string) {}

        sayHello() {
            return `Soy ${this.name} y uso namespaces 😊`;
        }
    }
}

// Usando el namespace
const message = Utils.greet("Daniela");
const person = new Utils.Person("Carlos");

// Mostrar en HTML
const output10 = document.getElementById("output10");

if (output10) {
    output10.innerHTML = `
        <li><strong>Namespace Function:</strong> ${message}</li>
        <li><strong>Namespace Class:</strong> ${person.sayHello()}</li>
    `;
}
