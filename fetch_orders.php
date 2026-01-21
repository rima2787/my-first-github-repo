<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seednest"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest order
$sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 1"; // Enclosed the table name in backticks
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Your Order Summary</h2>";
    echo "<p><strong>Full Name:</strong> " . $row['fname'] . " " . $row['lname'] . "</p>";
    echo "<p><strong>Company:</strong> " . ($row['company'] ?: 'N/A') . "</p>";
    echo "<p><strong>Address:</strong> " . $row['address'] . ", " . $row['city'] . ", " . $row['district'] . ", " . $row['country'] . "</p>";
    echo "<p><strong>Postcode:</strong> " . ($row['postcode'] ?: 'N/A') . "</p>";
} else {
    echo "<p>No orders found!</p>";
}

$conn->close();
?>
