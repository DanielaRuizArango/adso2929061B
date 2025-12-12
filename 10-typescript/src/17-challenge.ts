// 17-challenge.ts - TypeScript Features Project

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
        const container = document.getElementById('task-list-container');
        if (!container) return;

        const tasks = this.taskStorage.getItems();
        let html = `<h3>Tasks List (${tasks.length})</h3><ul style="list-style: none; padding: 0;">`;

        tasks.forEach(task => {
            // Nullish Coalescing
            const assignee = task.assignedTo ?? 'Unassigned';

            // Status Color
            let statusColor = '#888';
            if (task.status === TaskStatus.Completed) statusColor = '#4CAF50';
            if (task.status === TaskStatus.InProgress) statusColor = '#2196F3';
            if (task.status === TaskStatus.Pending) statusColor = '#FFC107';

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
