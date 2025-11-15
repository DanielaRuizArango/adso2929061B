"use strict";
class Enemy {
    constructor(name, health) {
        this.name = name;
        this.health = health;
    }
    takeDamage(damage) {
        this.health -= damage;
    }
}
const mosskin = new Enemy('Mosskin', 100);
mosskin.takeDamage(10);
mosskin.takeDamage(10);
mosskin.takeDamage(10);
//Display in Browser
const output04 = document.getElementById('output04');
if (output04) {
    output04.innerHTML = `
    <li><strong>Enemy: </strong>${mosskin.name}</li>
    <li><strong>Health After Attack: </strong>${mosskin.health}</li>
    `;
}
