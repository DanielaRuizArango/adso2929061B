// Obtener referencia al UL de salida
const output = document.getElementById("output") as HTMLUListElement;

// Función para imprimir en pantalla
function print(msg: string) {
    const li = document.createElement("li");
    li.textContent = msg;
    output.appendChild(li);
}

// --------------------------------------------------
// Ejemplo 1: Promise básica que se resuelve
// --------------------------------------------------
function promesaExitosa(): Promise<string> {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve("✔️ La promesa exitosa se resolvió después de 1 segundo.");
        }, 1000);
    });
}

promesaExitosa().then((mensaje) => {
    print(mensaje);
});


// --------------------------------------------------
// Ejemplo 2: Promesa que falla (reject)
// --------------------------------------------------
function promesaFallida(): Promise<string> {
    return new Promise((_, reject) => {
        setTimeout(() => {
            reject("❌ La promesa falló después de 1.5 segundos.");
        }, 1500);
    });
}

promesaFallida()
    .then((mensaje) => print(mensaje))
    .catch((error) => print(error));


// --------------------------------------------------
// Ejemplo 3: Promise.all
// --------------------------------------------------
const p1 = new Promise<string>((resolve) =>
    setTimeout(() => resolve("🌟 P1 completada"), 800)
);

const p2 = new Promise<string>((resolve) =>
    setTimeout(() => resolve("🌟 P2 completada"), 1200)
);

const p3 = new Promise<string>((resolve) =>
    setTimeout(() => resolve("🌟 P3 completada"), 500)
);

Promise.all([p1, p2, p3]).then((resultados) => {
    print("Resultado de Promise.all:");
    resultados.forEach((res) => print(" - " + res));
});


// --------------------------------------------------
// Ejemplo 4: Promise.race
// --------------------------------------------------
Promise.race([p1, p2, p3]).then((resultado) => {
    print("Resultado de Promise.race (primera en completarse):");
    print("🏁 " + resultado);
});
