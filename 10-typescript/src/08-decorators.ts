// --- Class Decorator: añade metadata a la clase ---
function Info(message: string) {
    return function (constructor: Function) {
        constructor.prototype.meta = message;
    };
}

// --- Method Decorator: imprime cuando se llama un método ---
function Log(
    target: any,
    propertyKey: string,
    descriptor: PropertyDescriptor
) {
    const originalMethod = descriptor.value;

    descriptor.value = function (...args: any[]) {
        console.log(`Método llamado: ${propertyKey}`);
        return originalMethod.apply(this, args);
    };

    return descriptor;
}

// --- Clase usando los decoradores ---
@Info("Esta es una clase decorada con metadata")
class Person {
    name: string;

    constructor(name: string) {
        this.name = name;
    }

    @Log
    greet() {
        return `Hola, soy ${this.name}`;
    }
}

// Crear instancia
const person = new Person("Daniela");
const greetMessage = person.greet();

// Obtener metadata desde prototype
const classMeta = (person as any).__proto__.meta;

// Mostrar en HTML
const output08 = document.getElementById("output08");

if (output08) {
    output08.innerHTML = `
        <li><strong>Class Decorator:</strong> ${classMeta}</li>
        <li><strong>Method Decorator:</strong> Resultado greet() → ${greetMessage}</li>
    `;
}
