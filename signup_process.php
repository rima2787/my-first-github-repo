<?php
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
    // Get form data
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email_phone = $_POST['email_phone']; // Corrected to match form field name
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Hash the password before saving
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (firstname, surname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstname, $surname, $email_phone, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to a confirmation page
            header("Location: confirmationp.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}













// if ($stmt->execute()) {
//     // Automatically log in the user
//     $_SESSION['loggedin'] = true;
//     $_SESSION['user_id'] = $conn->insert_id; // Store the new user's ID
//     header("Location: index.php");
//     exit();
// }





















// Close the connection
$conn->close();
?>
