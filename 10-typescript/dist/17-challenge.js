"use strict";
// 17-challenge.ts - TypeScript Features Project
// Project: small Task Management System
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
    TaskStatus["Pending"] = "PENDING";
    TaskStatus["InProgress"] = "IN_PROGRESS";
    TaskStatus["Completed"] = "COMPLETED";
})(TaskStatus || (TaskStatus = {}));
var UserRole;
(function (UserRole) {
    UserRole["Admin"] = "ADMIN";
    UserRole["User"] = "USER";
    UserRole["Guest"] = "GUEST";
})(UserRole || (UserRole = {}));
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
            controls.style.padding = '20px';
            controls.style.background = 'rgba(255,255,255,0.05)';
            controls.style.borderRadius = '8px';
            controls.style.display = 'flex';
            controls.style.gap = '10px';
            // Button: Add Task
            const btnAdd = document.createElement('button');
            btnAdd.textContent = '✨ Add New Task';
            btnAdd.style.padding = '12px 24px';
            btnAdd.style.backgroundColor = '#4CAF50';
            btnAdd.style.color = 'white';
            btnAdd.style.border = 'none';
            btnAdd.style.borderRadius = '4px';
            btnAdd.style.cursor = 'pointer';
            btnAdd.style.fontSize = '16px';
            btnAdd.style.transition = 'background 0.3s';
            btnAdd.onmouseover = () => btnAdd.style.backgroundColor = '#45a049';
            btnAdd.onmouseout = () => btnAdd.style.backgroundColor = '#4CAF50';
            btnAdd.onclick = () => {
                const title = prompt('Enter a title for the new task:', 'New Task');
                if (title) {
                    this.createTask({ title, status: TaskStatus.Pending });
                    this.renderTasks();
                }
            };
            controls.appendChild(btnAdd);
            output.appendChild(controls);
            // Tasks Container
            const listContainer = document.createElement('div');
            listContainer.id = 'task-list-container';
            output.appendChild(listContainer);
            listContainer.innerHTML = '<p><em>Loading tasks...</em></p>';
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
            this.log("Fetching simulated external data...");
            return new Promise((resolve) => {
                setTimeout(() => {
                    this.createUser({ name: 'Alice', email: 'alice@example.com', role: UserRole.Admin });
                    this.createTask({ title: 'Learn TypeScript', description: 'Master all features' });
                    this.log("Data fetched.");
                    resolve();
                }, 1500);
            });
        });
    }
    renderTasks() {
        const container = document.getElementById('task-list-container');
        if (!container)
            return;
        const tasks = this.taskStorage.getItems();
        let html = `<h3>Tasks List (${tasks.length})</h3><ul style="list-style: none; padding: 0;">`;
        tasks.forEach(task => {
            var _a;
            // Nullish Coalescing
            const assignee = (_a = task.assignedTo) !== null && _a !== void 0 ? _a : 'Unassigned';
            // Status Color
            let statusColor = '#888';
            if (task.status === TaskStatus.Completed)
                statusColor = '#4CAF50';
            if (task.status === TaskStatus.InProgress)
                statusColor = '#2196F3';
            if (task.status === TaskStatus.Pending)
                statusColor = '#FFC107';
            html += `
                <li style="
                    margin-bottom: 15px; 
                    padding: 15px; 
                    background: rgba(255,255,255,0.05); 
                    border-left: 5px solid ${statusColor};
                    border-radius: 4px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                ">
                    <div>
                        <strong style="font-size: 1.1em; display: block; margin-bottom: 4px;">${task.title}</strong>
                        <div style="font-size: 0.9em; opacity: 0.8; margin-bottom: 4px;">${task.description || 'No description'}</div>
                        <div style="font-size: 0.8em; opacity: 0.6;">
                            Assigned to: <strong>${assignee}</strong> | Status: <span style="color:${statusColor}">${task.status}</span>
                        </div>
                    </div>
                    <div>
                         <button onclick="alert('Task ID: ${task.id}')" style="
                            padding: 5px 10px;
                            background: rgba(255,255,255,0.1);
                            border: 1px solid rgba(255,255,255,0.2);
                            color: white;
                            cursor: pointer;
                            border-radius: 4px;
                         ">Info</button>
                    </div>
                </li>
            `;
        });
        html += '</ul>';
        container.innerHTML = html;
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
    app.createTask({ title: 'Build Project', status: TaskStatus.InProgress, assignedTo: 'Alice' });
    app.renderTasks();
}))();
