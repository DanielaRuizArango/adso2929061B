// 16 - Mixins: combinar funcionalidades en una clase

class CanFly {
    fly() {
        return "Flying high!";
    }
}

class CanSwim {
    swim() {
        return "Swimming fast!";
    }
}

class Animal implements CanFly, CanSwim {
    name: string = "Dolphin";
    fly!: () => string;
    swim!: () => string;
}

function applyMixins(derivedCtor: any, baseCtors: any[]) {
    baseCtors.forEach(baseCtor => {
        Object.getOwnPropertyNames(baseCtor.prototype).forEach(name => {
            derivedCtor.prototype[name] = baseCtor.prototype[name];
        });
    });
}

applyMixins(Animal, [CanFly, CanSwim]);

const animal = new Animal();

// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li><strong>Animal:</strong> ${animal.name}</li>
        <li>${animal.fly()}</li>
        <li>${animal.swim()}</li>
    `;
}
