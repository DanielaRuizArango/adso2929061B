// 08 - Decorators: añadir comportamiento extra a clases (concepto)

function LogCreation(constructor: Function) {
    console.log(`Class ${constructor.name} has been created.`);
}

@LogCreation
class Book {
    title: string = "The Silent Library";
    author: string = "A. Writer";

    describe(): string {
        return `${this.title} by ${this.author}`;
    }
}

const book = new Book();

// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li>${book.describe()}</li>
    `;
}
