// 17-challenge.ts - TypeScript Features Project
// Project: small Task Management System

/**
 * DECORATORS
 */
function LogClass(target: Function) {
    console.log(`Class defined: ${target.name}`);
}

function MeasureExecution(target: any, propertyKey: string, descriptor: PropertyDescriptor) {
    const originalMethod = descriptor.value;
    descriptor.value = function (...args: any[]) {
        const start = performance.now();
        const result = originalMethod.apply(this, args);
        const end = performance.now();
        console.log(`Execution of ${propertyKey} took ${end - start}ms`);
        return result;
    }
}

/**
 * ENUMS
 */
enum TaskStatus {
    Pending = 'PENDING',
    InProgress = 'IN_PROGRESS',
    Completed = 'COMPLETED'
}

enum UserRole {
    Admin = 'ADMIN',
    User = 'USER',
    Guest = 'GUEST'
}

/**
 * INTERFACES & TYPES
 */
interface IEntity {
    id: number;
    createdAt: Date;
}

type ID = number | string;

interface User extends IEntity {
    name: string;
    email: string;
    role: UserRole;
}

interface Task extends IEntity {
    title: string;
    description?: string; // Optional
    status: TaskStatus;
    assignedTo: ID | null; // Union type
}

/**
 * GENERIC CLASS - Data Storage
 */
class DataStorage<T extends IEntity> {
    private data: T[] = [];

    addItem(item: T): void {
        this.data.push(item);
    }

    removeItem(id: number): void {
        this.data = this.data.filter(i => i.id !== id);
    }

    getItems(): T[] {
        return [...this.data];
    }
    
    findById(id: number): T | undefined {
        return this.data.find(i => i.id === id);
    }
}

/**
 * ABSTRACT CLASS & INHERITANCE
 */
abstract class BaseManager {
    abstract version: string;
    printVersion() {
        console.log(`Manager Version: ${this.version}`);
    }
}

@LogClass
class TaskManager extends BaseManager {
    version = '1.0.0';
    private taskStorage = new DataStorage<Task>();
    private userStorage = new DataStorage<User>();

    constructor() {
        super();
        this.init();
    }

    private init() {
        const output = document.getElementById('output');
        if(output) output.innerHTML = "<h3>Initializing Task Manager...</h3>";
    }

    // UTILITY TYPES: Omit
    createUser(user: Omit<User, 'id' | 'createdAt'>): User {
        const newUser: User = {
            id: Date.now(),
            createdAt: new Date(),
            ...user
        };
        this.userStorage.addItem(newUser);
        this.log(`User created: ${newUser.name}`);
        return newUser;
    }

    // UTILITY TYPES: Partial
    createTask(task: Partial<Task> & { title: string }): Task {
        const newTask: Task = {
            id: Math.floor(Math.random() * 1000),
            createdAt: new Date(),
            status: TaskStatus.Pending,
            assignedTo: null,
            description: '',
            ...task
        };
        this.taskStorage.addItem(newTask);
        this.log(`Task created: ${newTask.title}`);
        return newTask;
    }

    @MeasureExecution
    async fetchInitialData(): Promise<void> {
        this.log("Fetching simulated external data...");
        return new Promise((resolve) => {
            setTimeout(() => {
                this.createUser({ name: 'Alice', email: 'alice@example.com', role: UserRole.Admin });
                this.createTask({ title: 'Learn TypeScript', description: 'Master all features' });
                this.log("Data fetched.");
                resolve();
            }, 1500);
        });
    }

    renderTasks() {
        const output = document.getElementById('output');
        if (!output) return;

        const tasks = this.taskStorage.getItems();
        let html = `<h3>Tasks (${tasks.length})</h3><ul>`;
        
        tasks.forEach(task => {
            // Nullish Coalescing
            const assignee = task.assignedTo ?? 'Unassigned';
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

    private log(message: string) {
        console.log(`[TaskManager]: ${message}`);
    }
}

// MAIN EXECUTION
(async () => {
    const app = new TaskManager();
    app.printVersion();
    
    await app.fetchInitialData();
    
    // Add some interaction
    app.createTask({ title: 'Build Project', status: TaskStatus.InProgress, assignedTo: 'Alice' });
    
    app.renderTasks();
})();
