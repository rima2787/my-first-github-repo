<?php
$conn = new mysqli("localhost", "root", "", "seednest");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM product WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product deleted successfully!'); window.location.href = 'view_productp.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href = 'view_productp.php';</script>";
    }
}

$conn->close();
?>
