"use strict";
// Basic Types: string, number, boolean
const characterName = "Hornet";
const health = 100;
const canDoubleJump = false;
const tools = ["Tacks", "Curveclaw", "Cogly"];
const memoryLockeds = [1, 'Bone Botton'];
const firstSkill = "Dash";
// Display in browser
const output01 = document.getElementById('output01');
if (output01) {
    output01.innerHTML = `
        <li><strong>Character:</strong> ${characterName}</li>
        <li><strong>Health:</strong> ${health}</li>
        <li><strong>Can Double Jump:</strong> ${canDoubleJump}</li>
        <li><strong>Tools:</strong> ${tools}</li>
        <li><strong>Memory Locked:</strong> ${memoryLockeds}</li>
        <li><strong>Dynamic:</strong> ${firstSkill}</li>
    `;
}
