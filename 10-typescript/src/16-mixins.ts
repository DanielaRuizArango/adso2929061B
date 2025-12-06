// Obtener referencia al UL donde se imprimirán los resultados
const output = document.getElementById("output") as HTMLUListElement;

// Función para imprimir
function print(msg: string) {
    const li = document.createElement("li");
    li.textContent = msg;
    output.appendChild(li);
}

// --------------------------------------------------
// Mixins en TypeScript: Combinando funcionalidades
// --------------------------------------------------

// Mixin 1: Puede saludar
class PuedeSaludar {
    saludar() {
        return "👋 ¡Hola! Soy una entidad que puede saludar.";
    }
}

// Mixin 2: Puede contar
class PuedeContar {
    contarHasta(n: number) {
        return `🔢 Conté hasta ${n}`;
    }
}

// Clase base vacía
class PersonaBase {}

// --------------------------------------------------
// Función que aplica mixins
// --------------------------------------------------
function aplicarMixins(derivada: any, bases: any[]) {
    bases.forEach(base => {
        Object.getOwnPropertyNames(base.prototype).forEach(nombre => {
            derivada.prototype[nombre] = base.prototype[nombre];
        });
    });
}

// Clase final que recibirá los mixins
class Persona extends PersonaBase {
    nombre: string;

    constructor(nombre: string) {
        super();
        this.nombre = nombre;
    }
}

// Aplicamos los mixins
aplicarMixins(Persona, [PuedeSaludar, PuedeContar]);

// Ahora Persona tiene métodos de ambos mixins
const persona = new Persona("Carlos");

// --------------------------------------------------
// Mostrar resultados
// --------------------------------------------------

print(`Persona creada: ${persona.nombre}`);
print(persona.saludar());
print(persona.contarHasta(5));
