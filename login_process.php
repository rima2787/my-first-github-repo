<?php
session_start(); // Start session

// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP is empty
$dbname = "seednest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_phone = $_POST['email-phone'];
    $password = $_POST['password'];

    // Query the user based on email or phone number
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ? OR email = ?");
    $stmt->bind_param("ss", $email_phone, $email_phone);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables and redirect to index.php
            $_SESSION['loggedin'] = true;
            $_SESSION['email']=$email_phone;
            $_SESSION['user_id'] = $id; // Store user ID for future use
           
            
            header("Location: index.php");
            exit();
        } else {
            // Incorrect password
            $_SESSION['error_message'] = "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        $_SESSION['error_message'] = "No account found with that Gmail or phone number.";
    }

    $stmt->close();
    $conn->close();

    // Redirect back to login page
    header("Location: loginp.php");
    exit();
}
?>
