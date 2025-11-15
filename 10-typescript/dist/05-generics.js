"use strict";
// Generics: inventory for any type
class inventory {
    constructor() {
        this.items = [];
    }
    addItem(item) {
        this.items.push(item);
    }
    getItem() {
        return this.items;
    }
}
const charmInventory = new inventory();
charmInventory.addItem('Mothwing Cloak');
charmInventory.addItem('Crystal Heart');
//Display in Browser
const output05 = document.getElementById('output05');
if (output05) {
    output05.innerHTML = `
    <li><strong>Charms Collected: </strong></li>
    <ul>${charmInventory.getItem().map(c => `<li>${c}</li>`).join('')}</ul>
    `;
}
