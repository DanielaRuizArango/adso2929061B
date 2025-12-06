"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
// Obtener referencia al UL donde se imprimirá la salida
const output = document.getElementById("output");
// Función para imprimir mensajes
function print(msg) {
    const li = document.createElement("li");
    li.textContent = msg;
    output.appendChild(li);
}
// --------------------------------------------------
// Función simulada que retorna un resultado asíncrono
// --------------------------------------------------
function obtenerDatos() {
    return new Promise(resolve => {
        setTimeout(() => {
            resolve("Datos recibidos desde el servidor ✔️");
        }, 1500);
    });
}
// --------------------------------------------------
// Ejemplo básico de async/await
// --------------------------------------------------
function cargarDatos() {
    return __awaiter(this, void 0, void 0, function* () {
        print("Solicitando datos... ⏳");
        const resultado = yield obtenerDatos();
        print("Respuesta recibida:");
        print(resultado);
    });
}
cargarDatos();
// --------------------------------------------------
// Async/await con manejo de errores (try/catch)
// --------------------------------------------------
function obtenerDatosConError() {
    return new Promise((_, reject) => {
        setTimeout(() => {
            reject("Error: No se pudieron obtener los datos ❌");
        }, 1200);
    });
}
function cargarDatosSeguros() {
    return __awaiter(this, void 0, void 0, function* () {
        print("Intentando cargar datos con posible error...");
        try {
            const resultado = yield obtenerDatosConError();
            print("Respuesta:");
            print(resultado);
        }
        catch (error) {
            print(`Ocurrió un error: ${error}`);
        }
    });
}
cargarDatosSeguros();
