<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "seednest");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product data if `id` is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM product WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<script>alert('Product not found!'); window.location.href = 'view_products.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href = 'view_products.php';</script>";
    exit;
}

// Handle form submission for updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $area = $_POST['area'];
    $avail = $_POST['avail'];
    $category = $_POST['category'];

    // Handle photo upload
    $photo = $_FILES['photo']['name'];
    $target_file = "uploads/" . basename($photo);
    $update_photo = "";

    if ($photo && move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $update_photo = ", photo='$target_file'";
    }

    // Update query
    $sql = "UPDATE product 
            SET name='$name', description='$description', price=$price, area='$area', avail=$avail, category='$category' $update_photo 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product updated successfully!'); window.location.href = 'view_productp.php';</script>";
    } else {
        echo "<script>alert('Error updating product: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Product</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control" value="<?= htmlspecialchars($product['description']) ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" required>
            </div>
            <div class="form-group">
                <label for="area">Area</label>
                <input type="text" id="area" name="area" class="form-control" value="<?= htmlspecialchars($product['area']) ?>" required>
            </div>
            <div class="form-group">
                <label for="avail">Availability</label>
                <select id="avail" name="avail" class="form-control" required>
                    <option value="1" <?= $product['avail'] == 1 ? 'selected' : '' ?>>Available</option>
                    <option value="0" <?= $product['avail'] == 0 ? 'selected' : '' ?>>Not Available</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" id="category" name="category" class="form-control" value="<?= htmlspecialchars($product['category']) ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label><br>
                <img src="<?= htmlspecialchars($product['photo']) ?>" alt="Product Photo" style="width: 100px; height: 100px; margin-bottom: 10px;"><br>
                <input type="file" id="photo" name="photo" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="view_products.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
