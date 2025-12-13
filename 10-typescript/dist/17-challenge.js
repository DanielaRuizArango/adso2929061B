"use strict";
// 17-challenge.ts - TypeScript Features Project
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
/**
 * DECORATORS
 */
function LogClass(target) {
    console.log(`Class defined: ${target.name}`);
}
function MeasureExecution(target, propertyKey, descriptor) {
    const originalMethod = descriptor.value;
    descriptor.value = function (...args) {
        const start = performance.now();
        const result = originalMethod.apply(this, args);
        const end = performance.now();
        console.log(`Execution of ${propertyKey} took ${end - start}ms`);
        return result;
    };
}
/**
 * ENUMS
 */
var TaskStatus;
(function (TaskStatus) {
    TaskStatus["Pending"] = "PENDIENTE";
    TaskStatus["InProgress"] = "EN PROGRESO";
    TaskStatus["Completed"] = "COMPLETADA";
})(TaskStatus || (TaskStatus = {}));
var Role;
(function (Role) {
    Role["Admin"] = "ADMIN";
    Role["User"] = "USER";
    Role["Guest"] = "GUEST";
})(Role || (Role = {}));
/**
 * GENERIC CLASS - Data Storage
 */
class DataStorage {
    constructor() {
        this.data = [];
    }
    addItem(item) {
        this.data.push(item);
    }
    removeItem(id) {
        this.data = this.data.filter(i => i.id !== id);
    }
    getItems() {
        return [...this.data];
    }
    findById(id) {
        return this.data.find(i => i.id === id);
    }
}
/**
 * ABSTRACT CLASS & INHERITANCE
 */
class BaseManager {
    printVersion() {
        console.log(`Manager Version: ${this.version}`);
    }
}
let TaskManager = class TaskManager extends BaseManager {
    constructor() {
        super();
        this.version = '1.0.0';
        this.taskStorage = new DataStorage();
        this.userStorage = new DataStorage();
        this.init();
    }
    init() {
        const output = document.getElementById('output');
        if (output) {
            output.innerHTML = '';
            // Controls Container
            const controls = document.createElement('div');
            controls.style.marginBottom = '20px';
            controls.style.padding = '20px 0';
            controls.style.borderBottom = '1px solid #444';
            controls.style.display = 'flex';
            controls.style.gap = '10px';
            // Button: Add Task
            const btnAdd = document.createElement('button');
            btnAdd.textContent = 'Agregar Nueva Tarea';
            btnAdd.style.padding = '10px 20px';
            btnAdd.style.backgroundColor = '#2563EB'; // Formal Blue
            btnAdd.style.color = 'white';
            btnAdd.style.border = 'none';
            btnAdd.style.borderRadius = '6px';
            btnAdd.style.cursor = 'pointer';
            btnAdd.style.fontSize = '14px';
            btnAdd.style.fontWeight = '500';
            btnAdd.style.boxShadow = '0 2px 4px rgba(0,0,0,0.2)';
            btnAdd.style.transition = 'background 0.2s';
            btnAdd.style.fontFamily = 'system-ui, -apple-system, sans-serif';
            btnAdd.onmouseover = () => btnAdd.style.backgroundColor = '#1d4ed8';
            btnAdd.onmouseout = () => btnAdd.style.backgroundColor = '#2563EB';
            btnAdd.onclick = () => {
                const title = prompt('Ingrese el título:', 'Nueva Tarea');
                if (title) {
                    const description = prompt('Ingrese descripción:', '');
                    const assignedTo = prompt('Ingrese asignado a:', 'Sin asignar');
                    this.createTask({
                        title,
                        description: description || undefined,
                        assignedTo: assignedTo || null,
                        status: TaskStatus.Pending
                    });
                    this.renderTasks();
                }
            };
            controls.appendChild(btnAdd);
            output.appendChild(controls);
            // Tasks Container
            const listContainer = document.createElement('div');
            listContainer.id = 'task-list-container';
            output.appendChild(listContainer);
            listContainer.innerHTML = '<p><em>Cargando tareas...</em></p>';
        }
    }
    // UTILITY TYPES: Omit
    createUser(user) {
        const newUser = Object.assign({ id: Date.now(), createdAt: new Date() }, user);
        this.userStorage.addItem(newUser);
        this.log(`User created: ${newUser.name}`);
        return newUser;
    }
    // UTILITY TYPES: Partial
    createTask(task) {
        const newTask = Object.assign({ id: Math.floor(Math.random() * 1000), createdAt: new Date(), status: TaskStatus.Pending, assignedTo: null, description: '' }, task);
        this.taskStorage.addItem(newTask);
        this.log(`Task created: ${newTask.title}`);
        return newTask;
    }
    fetchInitialData() {
        return __awaiter(this, void 0, void 0, function* () {
            this.log("Obteniendo datos simulados...");
            return new Promise((resolve) => {
                setTimeout(() => {
                    this.createUser({ name: 'Alice', email: 'alice@example.com', role: Role.Admin });
                    this.createTask({ title: 'Aprender TypeScript', description: 'Dominar todas las funciones' });
                    this.log("Datos obtenidos.");
                    resolve();
                }, 1500);
            });
        });
    }
    updateTaskStatus(id, status) {
        const task = this.taskStorage.findById(id);
        if (task) {
            task.status = status;
            this.renderTasks();
        }
    }
    renderTasks() {
        const container = document.getElementById('task-list-container');
        if (!container)
            return;
        container.innerHTML = '';
        const tasks = this.taskStorage.getItems();
        const title = document.createElement('h3');
        title.textContent = `Lista de Tareas (${tasks.length})`;
        container.appendChild(title);
        const ul = document.createElement('ul');
        ul.style.listStyle = 'none';
        ul.style.padding = '0';
        container.appendChild(ul);
        tasks.forEach(task => {
            var _a;
            // Determine colors based on status
            let statusColor = '#888';
            let bgColor = 'rgba(255, 255, 255, 0.05)'; // Default
            if (task.status === TaskStatus.Completed) {
                statusColor = '#10B981'; // Formal Green
                bgColor = 'rgba(16, 185, 129, 0.2)';
            }
            if (task.status === TaskStatus.InProgress) {
                statusColor = '#3B82F6'; // Formal Blue
                bgColor = 'rgba(59, 130, 246, 0.2)';
            }
            if (task.status === TaskStatus.Pending) {
                statusColor = '#F59E0B'; // Formal Amber
                bgColor = 'rgba(245, 158, 11, 0.2)';
            }
            const li = document.createElement('li');
            li.style.marginBottom = '12px';
            li.style.padding = '16px';
            li.style.borderRadius = '6px';
            li.style.background = bgColor;
            li.style.border = '1px solid ' + statusColor; // Use status color for border too for better look
            li.style.borderColor = 'rgba(255,255,255,0.1)'; // Keep subtle border but maybe tint it? actually let's stick to subtle.
            li.style.border = '1px solid rgba(255,255,255,0.1)';
            li.style.borderLeft = `4px solid ${statusColor}`;
            li.style.display = 'flex';
            li.style.justifyContent = 'space-between';
            li.style.alignItems = 'center';
            li.style.fontFamily = 'system-ui, -apple-system, sans-serif';
            li.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
            li.style.color = '#333'; // Black text
            // Gray out if completed
            if (task.status === TaskStatus.Completed) {
                li.style.opacity = '0.5';
                li.style.filter = 'grayscale(100%)';
            }
            // Left Section
            const leftDiv = document.createElement('div');
            // Title Row with Checkbox
            const titleRow = document.createElement('div');
            titleRow.style.display = 'flex';
            titleRow.style.alignItems = 'center';
            titleRow.style.gap = '10px';
            titleRow.style.marginBottom = '4px';
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.checked = task.status === TaskStatus.Completed;
            checkbox.style.cursor = 'pointer';
            checkbox.style.transform = 'scale(1.2)';
            checkbox.onchange = (e) => {
                const newStatus = e.target.checked
                    ? TaskStatus.Completed
                    : TaskStatus.Pending;
                this.updateTaskStatus(task.id, newStatus);
            };
            const titleSpan = document.createElement('strong');
            titleSpan.style.fontSize = '1.1em';
            titleSpan.textContent = task.title;
            titleRow.appendChild(checkbox);
            titleRow.appendChild(titleSpan);
            leftDiv.appendChild(titleRow);
            // Description
            const descDiv = document.createElement('div');
            descDiv.style.fontSize = '0.9em';
            descDiv.style.opacity = '0.8';
            descDiv.style.marginBottom = '8px';
            descDiv.style.marginLeft = '28px'; // Indent to align with text
            descDiv.textContent = task.description || 'Sin descripción';
            leftDiv.appendChild(descDiv);
            // Assignee & Status Select
            const metaDiv = document.createElement('div');
            metaDiv.style.fontSize = '0.8em';
            metaDiv.style.opacity = '0.6';
            metaDiv.style.marginLeft = '28px';
            metaDiv.style.display = 'flex';
            metaDiv.style.alignItems = 'center';
            metaDiv.style.gap = '10px';
            const assigneeText = document.createElement('span');
            // Re-using the logic from before: just the name, no label
            assigneeText.innerHTML = `<strong>${(_a = task.assignedTo) !== null && _a !== void 0 ? _a : 'Sin asignar'}</strong> | Estado: `;
            metaDiv.appendChild(assigneeText);
            const select = document.createElement('select');
            select.style.background = '#fff';
            select.style.color = '#333';
            select.style.border = '1px solid #ccc';
            select.style.borderRadius = '4px';
            select.style.padding = '4px 8px';
            select.style.fontSize = '0.85em';
            select.style.cursor = 'pointer';
            [TaskStatus.Pending, TaskStatus.InProgress, TaskStatus.Completed].forEach(s => {
                const opt = document.createElement('option');
                opt.value = s;
                opt.textContent = s;
                if (s === task.status)
                    opt.selected = true;
                select.appendChild(opt);
            });
            select.onchange = (e) => {
                this.updateTaskStatus(task.id, e.target.value);
            };
            metaDiv.appendChild(select);
            leftDiv.appendChild(metaDiv);
            li.appendChild(leftDiv);
            // Right Section (Info Button)
            const rightDiv = document.createElement('div');
            const infoBtn = document.createElement('button');
            infoBtn.textContent = 'Info';
            infoBtn.style.padding = '6px 12px';
            infoBtn.style.background = 'transparent';
            infoBtn.style.border = '1px solid #999';
            infoBtn.style.color = '#333';
            infoBtn.style.cursor = 'pointer';
            infoBtn.style.borderRadius = '4px';
            infoBtn.style.fontSize = '0.85em';
            infoBtn.onmouseover = () => { infoBtn.style.background = 'rgba(0,0,0,0.05)'; infoBtn.style.borderColor = '#666'; };
            infoBtn.onmouseout = () => { infoBtn.style.background = 'transparent'; infoBtn.style.borderColor = '#999'; };
            infoBtn.onclick = () => alert(`ID Tarea: ${task.id}\nCreada: ${task.createdAt}`);
            rightDiv.appendChild(infoBtn);
            li.appendChild(rightDiv);
            ul.appendChild(li);
        });
    }
    log(message) {
        console.log(`[TaskManager]: ${message}`);
    }
};
__decorate([
    MeasureExecution
], TaskManager.prototype, "fetchInitialData", null);
TaskManager = __decorate([
    LogClass
], TaskManager);
// MAIN EXECUTION
(() => __awaiter(void 0, void 0, void 0, function* () {
    const app = new TaskManager();
    app.printVersion();
    yield app.fetchInitialData();
    // Add some interaction
    app.createTask({ title: 'Construir Proyecto', status: TaskStatus.InProgress, assignedTo: 'Ana' });
    app.renderTasks();
}))();
