// 14 - Promises: manejo básico con then/catch

function loadUser(): Promise<string> {
    return new Promise((resolve, reject) => {
        const success = Math.random() > 0.5;
        setTimeout(() => {
            success ? resolve("User loaded!") : reject("Error loading user");
        }, 1500);
    });
}

loadUser()
    .then(response => {
        const output = document.getElementById('output');
        if (output) {
            output.innerHTML = `<li>${response}</li>`;
        }
    })
    .catch(error => {
        const output = document.getElementById('output');
        if (output) {
            output.innerHTML = `<li style="color:red;">${error}</li>`;
        }
    });
