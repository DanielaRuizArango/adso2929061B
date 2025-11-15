"use strict";
// Basic Types: string, number, boolean
const characterName = "Hornet";
const health = 100;
const canBoubleJump = false;
const tools = ["Tacks", "Curveclaw", "Cogly"];
const memoryLockeds = [1, 'Bone Botton'];
const firstSkill = "Dash";
// Display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li><strong>Character:</strong> ${characterName}</li>
        <li><strong>Health:</strong> ${health}</li>
        <li><strong>Can Double Jump:</strong> ${canBoubleJump}</li>
        <li><strong>Tools:</strong> ${tools}</li>
        <li><strong>Memory Locked:</strong> ${memoryLockeds}</li>
        <li><strong>Dinamic:</strong> ${firstSkill}</li>
    `;
}
