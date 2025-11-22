// --- Union Type ---
type Status = "success" | "error" | "loading";
let currentStatus: Status = "success";

// --- Intersection Type ---
interface User {
    name: string;
}

interface Permissions {
    canEdit: boolean;
    canDelete: boolean;
}

type AdminUser = User & Permissions;

const admin: AdminUser = {
    name: "Daniela",
    canEdit: true,
    canDelete: false
};

// --- Conditional Type (solo en tiempo de compilación) ---
type IsString<T> = T extends string ? "Es un string" : "No es un string";

type CheckString = IsString<string>;  // "Es un string"
type CheckNumber = IsString<number>;  // "No es un string"

// Crear valores de ejemplo para mostrar (porque los types no existen en JS)
const checkStringRuntime = "Es un string";
const checkNumberRuntime = "No es un string";

// Mostrar resultados en HTML
const output07 = document.getElementById("output07");

if (output07) {
    output07.innerHTML = `
        <li><strong>Union Type:</strong> Estado actual = ${currentStatus}</li>
        <li><strong>Intersection Type:</strong> Admin = ${admin.name}, puede editar: ${admin.canEdit}</li>
        <li><strong>Conditional Type:</strong> string → ${checkStringRuntime}, number → ${checkNumberRuntime}</li>
    `;
}
