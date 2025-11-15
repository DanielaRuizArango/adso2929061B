"use strict";
// 13 - Async/Await: manejo de tareas asíncronas
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
function fetchMessage() {
    return __awaiter(this, void 0, void 0, function* () {
        return new Promise(resolve => {
            setTimeout(() => resolve("Data loaded successfully after 2s"), 2000);
        });
    });
}
function displayMessage() {
    return __awaiter(this, void 0, void 0, function* () {
        const msg = yield fetchMessage();
        const output = document.getElementById('output');
        if (output) {
            output.innerHTML = `<li>${msg}</li>`;
        }
    });
}
displayMessage();
