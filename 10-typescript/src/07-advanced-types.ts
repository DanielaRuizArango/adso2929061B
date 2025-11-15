// 07 - Advanced Types: uso de unión e intersección de tipos

type Product = { name: string; price: number };
type Stock = { quantity: number };

type StoreItem = Product & Stock;
type Status = "Available" | "Sold Out";

const item: StoreItem = { name: "Headphones", price: 150, quantity: 12 };
const availability: Status = "Available";

// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li><strong>Product:</strong> ${item.name}</li>
        <li><strong>Price:</strong> $${item.price}</li>
        <li><strong>Quantity:</strong> ${item.quantity}</li>
        <li><strong>Status:</strong> ${availability}</li>
    `;
}
