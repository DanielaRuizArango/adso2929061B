//Functions: declarar funciones con tipos y retornos
function sum(a: number, b: number): number {
    return a + b;
}
function greet(name: string): string {
    return `Hello ${name}`;
}
const userName: string = 'Kevin';
const result: number = sum(8, 5);
const message: string = greet(userName);

// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li>${message}</li>
        <li><strong>Sum result:</strong> ${result}</li>
        `;
}