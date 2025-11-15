// 13 - Async/Await: manejo de tareas asíncronas

async function fetchMessage(): Promise<string> {
    return new Promise(resolve => {
        setTimeout(() => resolve("Data loaded successfully after 2s"), 2000);
    });
}

async function displayMessage() {
    const msg = await fetchMessage();
    const output = document.getElementById('output');
    if (output) {
        output.innerHTML = `<li>${msg}</li>`;
    }
}

displayMessage();
