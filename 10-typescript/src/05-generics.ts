// Generics: crear funciones reutilizables con tipos genéricos
function showItem<T>(item: T): string {
    return `Item: ${item}`;
}
function combine<T, U>(first: T, second: U): string {
    return `Combined: ${first} and ${second}`;
}
const msg1: string = showItem<number>(99);
const msg2: string = combine<string, boolean>("Success", true);
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li>${msg1}</li>
        <li>${msg2}</li>
    `;
}
