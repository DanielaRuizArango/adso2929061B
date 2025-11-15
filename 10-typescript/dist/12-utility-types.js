"use strict";
// 12 - Utility Types: Partial, Readonly, Pick
const original = {
    title: "Interstellar",
    director: "Christopher Nolan",
    year: 2014
};
const partial = { title: "Dune" };
const selected = { title: "Avatar", year: 2009 };
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li><strong>Original:</strong> ${original.title}</li>
        <li><strong>Partial:</strong> ${partial.title}</li>
        <li><strong>Picked:</strong> ${selected.title} (${selected.year})</li>
    `;
}
