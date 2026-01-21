document.getElementById("password-form").addEventListener("submit", function (event) {
    event.preventDefault();

    const currentPassword = document.getElementById("current-password").value;
    const newPassword = document.getElementById("new-password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    if (newPassword !== confirmPassword) {
        alert("New password and confirmation password do not match!");
    } else {
        alert("Password changed successfully!");
        // You can add logic here to process the password change request.
    }
});