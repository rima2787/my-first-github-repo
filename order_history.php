<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Get the user's email from the session
$user_email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];  // You can use this ID for more personalized queries if needed

// Database connection
$conn = new mysqli('localhost', 'root', '', 'seednest');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch confirmed order details for the logged-in user
$sql = "
    SELECT 
        o.id AS order_id, o.fname, o.lname, o.company, o.country, o.address, 
        o.city, o.district, o.postcode, p.name AS product_name, 
        p.description AS product_description, p.price AS product_price
    FROM 
        confirm_order o
    LEFT JOIN 
        product p 
    ON 
        o.product_id = p.id
    WHERE 
        o.email = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate total amount
$subtotal = 0;
foreach ($orders as $order) {
    $subtotal += $order['product_price'];
}

$gst = $subtotal * 0.1; // Assuming GST is 10%
$total = $subtotal + $gst;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="addcartc.css">
    <link rel="stylesheet" href="navbarc.css">
    <link rel="stylesheet" href="footerc.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 20px;
    font-size: 2rem;
}

.content {
    margin: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
}

table th, table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

table th {
    background-color: #f2f2f2;
}

.totals {
    margin-top: 20px;
    text-align: right;
}

.totals-row {
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
}

.totals-row span {
    font-size: 1.2rem;
}

.totals-row span:last-child {
    font-weight: bold;
}

footer {
    text-align: center;
    background-color: #222;
    color: #fff;
    padding: 20px;
    margin-top: 30px;
}

    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="content">
        <div class="order-container">
            <h1>Your Confirmed Orders</h1>
            
            <?php if (!empty($orders)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Company</th>
                            <th>Country</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>District</th>
                            <th>Postcode</th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Product Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['fname']); ?></td>
                                <td><?php echo htmlspecialchars($order['lname']); ?></td>
                                <td><?php echo htmlspecialchars($order['company']); ?></td>
                                <td><?php echo htmlspecialchars($order['country']); ?></td>
                                <td><?php echo htmlspecialchars($order['address']); ?></td>
                                <td><?php echo htmlspecialchars($order['city']); ?></td>
                                <td><?php echo htmlspecialchars($order['district']); ?></td>
                                <td><?php echo htmlspecialchars($order['postcode']); ?></td>
                                <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($order['product_description']); ?></td>
                                <td><?php echo number_format($order['product_price'], 2); ?> BDT</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="totals">
                    <div class="totals-row">
                        <span>Sub Total</span>
                        <span><?php echo number_format($subtotal, 2); ?> BDT</span>
                    </div>
                    <div class="totals-row">
                        <span>GST (10%)</span>
                        <span><?php echo number_format($gst, 2); ?> BDT</span>
                    </div>
                    <div class="totals-row">
                        <span>Total</span>
                        <span><?php echo number_format($total, 2); ?> BDT</span>
                    </div>
                </div>
            <?php else: ?>
                <p>No confirmed orders found.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

<?php
$conn->close();
?>
