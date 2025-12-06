// Obtener el UL para mostrar resultados
const output = document.getElementById("output") as HTMLUListElement;

// Función auxiliar para imprimir en pantalla
function print(msg: string) {
    const li = document.createElement("li");
    li.textContent = msg;
    output.appendChild(li);
}

// --------------------------------------------------
// Ejemplo 1: Manejo básico de errores con try/catch
// --------------------------------------------------

function dividir(a: number, b: number): number {
    if (b === 0) {
        throw new Error("No se puede dividir entre 0 ❌");
    }
    return a / b;
}

try {
    const resultado = dividir(10, 2);
    print(`Resultado de 10 / 2 = ${resultado}`);
} catch (error) {
    print(`Error: ${(error as Error).message}`);
}

try {
    const resultado2 = dividir(5, 0);
    print(`Resultado de 5 / 0 = ${resultado2}`);
} catch (error) {
    print(`Error: ${(error as Error).message}`);
}


// --------------------------------------------------
// Ejemplo 2: Error personalizado
// --------------------------------------------------

class DatosNoEncontradosError extends Error {
    constructor() {
        super("Datos no encontrados en la base de datos 📁❌");
        this.name = "DatosNoEncontradosError";
    }
}

function obtenerDatos(id: number) {
    if (id !== 1) {
        throw new DatosNoEncontradosError();
    }
    return { id: 1, nombre: "Producto A" };
}

try {
    const datos = obtenerDatos(2);
    print(`Datos obtenidos: ${JSON.stringify(datos)}`);
} catch (error) {
    if (error instanceof DatosNoEncontradosError) {
        print(`Error personalizado: ${error.message}`);
    } else {
        print("Error desconocido");
    }
}


// --------------------------------------------------
// Ejemplo 3: Manejo de errores en funciones async/await
// --------------------------------------------------

function fetchSimulado(): Promise<string> {
    return new Promise((_, reject) => {
        setTimeout(() => reject("Error al obtener datos del servidor 🌐❌"), 1500);
    });
}

async function cargarDatos() {
    pr
