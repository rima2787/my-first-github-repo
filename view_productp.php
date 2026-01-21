<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "seednest");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin: 50px auto;
            max-width: 90%;
        }
        .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container table-container">
        <h2 class="text-center mb-4">Product List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Area</th>
                    <th>Availability</th>
                    <th>Category</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['area'] . "</td>";
                        echo "<td>" . ($row['avail'] ? 'Available' : 'Not Available') . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td><img src='" . $row['photo'] . "' alt='Product Photo' style='width: 50px; height: 50px;'></td>";
                        echo "<td>
                                <a href='update_productp.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm mb-2'> Update</a>
                                <a href='delete_productp.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this product?');\">Delete</a>
                                </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
