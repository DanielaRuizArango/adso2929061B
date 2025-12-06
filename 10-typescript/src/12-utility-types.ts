// Obtener referencia al UL para imprimir mensajes
const output = document.getElementById("output") as HTMLUListElement;

// Función simple para imprimir en pantalla
function print(msg: string) {
    const li = document.createElement("li");
    li.textContent = msg;
    output.appendChild(li);
}

// --------------------------------------------------
// Ejemplo base
// --------------------------------------------------
type Usuario = {
    id: number;
    nombre: string;
    email: string;
    activo: boolean;
};

const usuarioBase: Usuario = {
    id: 1,
    nombre: "Lucía",
    email: "lucia@mail.com",
    activo: true
};


// --------------------------------------------------
// 1) Partial<T>  → todas las propiedades opcionales
// --------------------------------------------------
function actualizarUsuario(data: Partial<Usuario>) {
    print("Actualizando usuario con Partial:");
    print(JSON.stringify(data));
}

actualizarUsuario({ email: "nuevo@mail.com" });
actualizarUsuario({ activo: false });


// --------------------------------------------------
// 2) Pick<T, K>  → escogemos solo algunas propiedades
// --------------------------------------------------
type UsuarioPublico = Pick<Usuario, "id" | "nombre">;

const usuarioPub: UsuarioPublico = {
    id: 2,
    nombre: "Carlos"
};

print("Usuario público con Pick:");
print(JSON.stringify(usuarioPub));


// --------------------------------------------------
// 3) Record<K, T> → objeto con claves de un tipo y valor de otro
// --------------------------------------------------
type EstadoUsuario = "online" | "offline" | "ausente";

const estadosUsuarios: Record<string, EstadoUsuario> = {
    "user1": "online",
    "user2": "offline",
    "user3": "ausente"
};

print("Estados de usuarios con Record:");
print(JSON.stringify(estadosUsuarios));


// --------------------------------------------------
// 4) Readonly<T> → propiedades solo lectura
// --------------------------------------------------
const usuarioReadonly: Readonly<Usuario> = usuarioBase;

print("Usuario Readonly (no editable):");
print(JSON.stringify(usuarioReadonly));

// Si intentas cambiar algo, TypeScript dará error:
// usuarioReadonly.nombre = "Nuevo nombre"; ❌


