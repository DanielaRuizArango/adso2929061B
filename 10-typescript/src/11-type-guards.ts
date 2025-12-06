// Obtener referencia al UL donde se imprimirá la salida
const output = document.getElementById("output11") as HTMLUListElement;

// Creamos una función para imprimir en pantalla
function print(msg: string) {
    const li = document.createElement("li");
    li.textContent = msg;
    output.appendChild(li);
}

// --------------------------------------------------
// TYPE GUARD 1: typeof
// --------------------------------------------------
function describeValue(value: string | number) {
    if (typeof value === "string") {
        print(`"${value}" es un STRING y su longitud es ${value.length}`);
    } else {
        print(`${value} es un NUMBER y su doble es ${value * 2}`);
    }
}

describeValue("Hola");
describeValue(10);


// --------------------------------------------------
// TYPE GUARD 2: in (para comprobar propiedades en objetos)
// --------------------------------------------------
type Perro = {
    ladrar: () => void;
};

type Gato = {
    maullar: () => void;
};

// Type guard personalizado
function esPerro(animal: Perro | Gato): animal is Perro {
    return "ladrar" in animal;
}

function hacerSonidoAnimal(animal: Perro | Gato) {
    if (esPerro(animal)) {
        print("El animal es un PERRO");
        animal.ladrar();
    } else {
        print("El animal es un GATO");
        animal.maullar();
    }
}

const firulais: Perro = {
    ladrar: () => print("Guau! 🐶")
};

const michi: Gato = {
    maullar: () => print("Miau! 🐱")
};

hacerSonidoAnimal(firulais);
hacerSonidoAnimal(michi);

