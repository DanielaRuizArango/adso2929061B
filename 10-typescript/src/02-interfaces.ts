// Interfaces - Define a type
interface Animal {
    name: string;
    species: string;
    age: number;
    isDomestic: boolean;
    sound: string;
}
const pet: Animal = {
    name: 'tiger',
    species: 'cat',
    age: 3,
    isDomestic: true,
    sound: 'meow'
};

// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li><strong>Name:</strong> ${pet.name}</li>
        <li><strong>Species:</strong> ${pet.species}</li>
        <li><strong>Age:</strong> ${pet.age}</li>
        <li><strong>Domestic:</strong> ${pet.isDomestic ? "Yes" : "No"}</li>
        <li><strong>Sound:</strong> ${pet.sound}</li>
    `;
}
