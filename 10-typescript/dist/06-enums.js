"use strict";
var UserRole;
(function (UserRole) {
    UserRole["Admin"] = "Admin";
    UserRole["Editor"] = "Editor";
    UserRole["Viewer"] = "Viewer";
})(UserRole || (UserRole = {}));
const currentUserRole = UserRole.Editor;
const output06 = document.getElementById('output06');
if (output06) {
    output06.innerHTML = `
        <li><strong>User Role:</strong> ${currentUserRole}</li>
    `;
}
