<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "seednest");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $area = $_POST['area'];
    $avail = $_POST['avail'];
    $category = $_POST['category'];

    // Handle photo upload
    $photo = $_FILES['photo']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo);

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        // Insert product data into the database
        $sql = "INSERT INTO product (name, description, price, area, avail, category, photo) 
                VALUES ('$name', '$description', '$price', '$area', '$avail', '$category', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product added successfully!'); window.location.href = 'add_productp.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading photo.');</script>";
    }
}

$conn->close();
?>
