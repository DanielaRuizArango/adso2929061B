// 09 - Modules: ejemplo conceptual (sin imports reales)

class Student {
    constructor(public name: string, public grade: number) {}
}

const student = new Student("Laura", 95);

// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li><strong>Student:</strong> ${student.name}</li>
        <li><strong>Grade:</strong> ${student.grade}</li>
    `;
}
