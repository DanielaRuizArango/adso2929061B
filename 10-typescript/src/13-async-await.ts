// Obtener referencia al UL donde se imprimirá la salida
const output = document.getElementById("output") as HTMLUListElement;

// Función para imprimir mensajes
function print(msg: string) {
    const li = document.createElement("li");
    li.textContent = msg;
    output.appendChild(li);
}

// --------------------------------------------------
// Función simulada que retorna un resultado asíncrono
// --------------------------------------------------
function obtenerDatos(): Promise<string> {
    return new Promise(resolve => {
        setTimeout(() => {
            resolve("Datos recibidos desde el servidor ✔️");
        }, 1500);
    });
}

// --------------------------------------------------
// Ejemplo básico de async/await
// --------------------------------------------------
async function cargarDatos() {
    print("Solicitando datos... ⏳");

    const resultado = await obtenerDatos();

    print("Respuesta recibida:");
    print(resultado);
}

cargarDatos();


// --------------------------------------------------
// Async/await con manejo de errores (try/catch)
// --------------------------------------------------
function obtenerDatosConError(): Promise<string> {
    return new Promise((_, reject) => {
        setTimeout(() => {
            reject("Error: No se pudieron obtener los datos ❌");
        }, 1200);
    });
}

async function cargarDatosSeguros() {
    print("Intentando cargar datos con posible error...");

    try {
        const resultado = await obtenerDatosConError();
        print("Respuesta:");
        print(resultado);
    } catch (error) {
        print(`Ocurrió un error: ${error}`);
    }
}

cargarDatosSeguros();
