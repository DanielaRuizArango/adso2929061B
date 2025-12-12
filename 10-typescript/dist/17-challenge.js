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
        if (output)
            output.innerHTML = "<h3>Initializing Task Manager...</h3>";
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
        const output = document.getElementById('output');
        if (!output)
            return;
        const tasks = this.taskStorage.getItems();
        let html = `<h3>Tasks (${tasks.length})</h3><ul>`;
        tasks.forEach(task => {
            var _a;
            // Nullish Coalescing
            const assignee = (_a = task.assignedTo) !== null && _a !== void 0 ? _a : 'Unassigned';
            html += `
                <li style="margin-bottom: 10px; padding: 10px; background: rgba(0,0,0,0.1); border-radius: 4px;">
                    <strong>${task.title}</strong> [${task.status}] <br>
                    <small>${task.description}</small> <br>
                    <small>Assigned to: ${assignee}</small>
                </li>
            `;
        });
        html += '</ul>';
        output.innerHTML = html;
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
