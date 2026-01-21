// Predefined admin credentials
const adminUsername = "admin";
const adminPassword = "1234567890";

// Elements
const loginBtn = document.getElementById("login-btn");
const usernameField = document.getElementById("username");
const passwordField = document.getElementById("password");
const errorMessage = document.getElementById("error-message");

// Handle login button click
loginBtn.addEventListener("click", () => {
  const enteredUsername = usernameField.value.trim();
  const enteredPassword = passwordField.value.trim();

  // Check credentials
  if (enteredUsername === adminUsername && enteredPassword === adminPassword) {
    // Redirect to admin panel if credentials are correct
    window.location.href = "adminp.php";
  } else {
    // Show error message if credentials are incorrect
    errorMessage.classList.remove("d-none");
  }
});
