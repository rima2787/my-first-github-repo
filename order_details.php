<?php
// Include database connection
$conn = new mysqli('localhost', 'root', '', 'seednest');

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
// Get the order ID from the URL
$order_id = $_GET['order_id'] ?? null;

if ($order_id) {
    // Fetch order details
    $sql = "SELECT * FROM orders WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="orderc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="navbarc.css">
    <link rel="stylesheet" href="footerc.css">
    <style>
        /* General Reset */
body, h1, p, table, th, td {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body Styling */
body {
    background-color: #f5f5f5;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

/* Header Styling */
header {
    background-color: #007BFF;
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 1.2em;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Main Content Styling */
main {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

main h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 2em;
    color: #007BFF;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f0f8ff;
    color: #333;
    font-weight: bold;
}

td {
    background-color: #fafafa;
    font-size: 0.9em;
    color: #555;
}

/* Highlight Rows */
table tr:hover {
    background-color: #f1f1f1;
}

/* Footer Styling */
footer {
    text-align: center;
    padding: 10px;
    background-color: #007BFF;
    color: white;
    margin-top: 20px;
    border-radius: 0 0 8px 8px;
}

/* Responsive Design */
@media screen and (max-width: 600px) {
    table, th, td {
        font-size: 0.8em;
    }

    main {
        padding: 15px;
    }
}

    </style>
</head>

<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main>
        <h1>Order Details</h1>
        <?php if ($order): ?>
            <table>
                <tr>
                    <th>First Name</th>
                    <td><?php echo htmlspecialchars($order['fname']); ?></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><?php echo htmlspecialchars($order['lname']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($order['email']); ?></td>
                </tr>
                <tr>
                    <th>Company</th>
                    <td><?php echo htmlspecialchars($order['company']); ?></td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td><?php echo htmlspecialchars($order['country']); ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo htmlspecialchars($order['address']); ?></td>
                </tr>
                <tr>
                    <th>City</th>
                    <td><?php echo htmlspecialchars($order['city']); ?></td>
                </tr>
                <tr>
                    <th>District</th>
                    <td><?php echo htmlspecialchars($order['district']); ?></td>
                </tr>
                <tr>
                    <th>Postcode</th>
                    <td><?php echo htmlspecialchars($order['postcode']); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>Order not found.</p>
        <?php endif; ?>
    </main>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>
