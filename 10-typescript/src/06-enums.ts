enum UserRole {
    Admin = "Admin",
    Editor = "Editor",
    Viewer = "Viewer"
}

const currentUserRole: UserRole = UserRole.Editor;

const output06 = document.getElementById('output06');
if (output06) {
    output06.innerHTML = `
        <li><strong>User Role:</strong> ${currentUserRole}</li>
    `;
}
