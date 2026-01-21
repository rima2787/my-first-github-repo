<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'seednest');

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$company = $_POST['company'];
$country = $_POST['country'];
$address = $_POST['address'];
$email = $_POST['email'];
$city = $_POST['city'];
$district = $_POST['district'];
$postcode = $_POST['postcode'];
$product_id = $_POST['product_id']; 

// Insert data into orders table
$sql = "INSERT INTO orders (fname, lname, company, country, address, email, city, district, postcode, product_id) 
        VALUES ('$fname', '$lname', '$company', '$country', '$address', '$email', '$city', '$district', '$postcode', '$product_id')";

if ($conn->query($sql) === TRUE) {
    $result = $conn->query("SELECT MAX(id) AS max_id FROM orders");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $order_id = $row['max_id'];

        // Redirect to the order details page
        header("Location: order_details.php?order_id=" . $order_id);
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "Error: Unable to retrieve the order ID.";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
