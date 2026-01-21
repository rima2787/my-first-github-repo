<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: loginp.php"); // Redirect to login page if not logged in
    exit();
}

$email = $_SESSION['email'];

// Include database connection
$conn = new mysqli('localhost', 'root', '', 'seednest');

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch order and product details for the logged-in user
$sql = "
    SELECT 
        o.id AS order_id, o.fname, o.lname, o.company, o.country, o.address, 
        o.city, o.district, o.postcode, p.name AS product_name, 
        p.description AS product_description, p.price AS product_price
    FROM 
        orders o
    LEFT JOIN 
        product p 
    ON 
        o.product_id = p.id
    WHERE 
        o.email = ?
";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

$subtotal = 0;
$gst = 0;
foreach ($orders as $order) {
    $subtotal += $order['product_price'];
}

$gst = $subtotal * 0.1; // Assume GST is 10%
$total = $subtotal + $gst;

// Handle order confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order_id'])) {
    $confirm_order_id = intval($_POST['confirm_order_id']);

    // Move the order to the confirm_order table
    $move_sql = "
        INSERT INTO confirm_order (id, fname, lname, company, country, address, city, district, postcode, product_id, email)
        SELECT id, fname, lname, company, country, address, city, district, postcode, product_id, email
        FROM orders
        WHERE id = ?
    ";
    if ($move_stmt = $conn->prepare($move_sql)) {
        $move_stmt->bind_param("i", $confirm_order_id);
        $move_stmt->execute();
        $move_stmt->close();
    }

    // Delete the order from the orders table
    $delete_sql = "DELETE FROM orders WHERE id = ?";
    if ($delete_stmt = $conn->prepare($delete_sql)) {
        $delete_stmt->bind_param("i", $confirm_order_id);
        $delete_stmt->execute();
        $delete_stmt->close();
    }



    

    // Refresh the page to show updated orders
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


if (isset($_POST['place_all_orders'])) {
    // Move all orders for the logged-in user to the confirm_order table
    $move_all_sql = "
        INSERT INTO confirm_order (id, fname, lname, company, country, address, city, district, postcode, product_id, email)
        SELECT id, fname, lname, company, country, address, city, district, postcode, product_id, email
        FROM orders
        WHERE email = ?
    ";
    if ($move_all_stmt = $conn->prepare($move_all_sql)) {
        $move_all_stmt->bind_param("s", $email);
        $move_all_stmt->execute();
        $move_all_stmt->close();
    }

    // Delete all orders for the logged-in user from the orders table
    $delete_all_sql = "DELETE FROM orders WHERE email = ?";
    if ($delete_all_stmt = $conn->prepare($delete_all_sql)) {
        $delete_all_stmt->bind_param("s", $email);
        $delete_all_stmt->execute();
        $delete_all_stmt->close();
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['delete_order_id'])) {
    $delete_order_id = intval($_POST['delete_order_id']);

    // Delete the order from the orders table
    $delete1_sql = "DELETE FROM orders WHERE id = ?";
    if ($delete1_stmt = $conn->prepare($delete1_sql)) {
        $delete1_stmt->bind_param("i", $delete_order_id);
        $delete1_stmt->execute();
        $delete1_stmt->close();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="addcartc.css">
    <link rel="stylesheet" href="navbarc.css">
    <link rel="stylesheet" href="footerc.css">
    <style>
        .btn-place-all {
    background-color: #4CAF50; /* Green */
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    margin: 20px 0;
    display: block;
    text-align: center;
}

.btn-place-all:hover {
    background-color: #45a049;
}
.ab {
    align-items: center;
}

    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div id="content">
    <div class="shopping-cart-container">
        <div class="shopping-cart-header">
            <h1>Order Details</h1>
        </div>

        <?php if (!empty($orders)): ?>
            <div class="table-responsive">
           
                    <table class="cart-table">
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
                                <th>Actions</th>
                                <th>Delete</th>
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
                                    <td><?php echo htmlspecialchars($order['product_price']); ?></td>
                                    <td>
                                    <form method="POST" action="">
                                        <button type="submit" name="confirm_order_id" value="<?php echo $order['order_id']; ?>" class="btn-confirm">
                                            Confirm Order
                                        </button>
                                        </form>
                                        </td>
                                        <td>
                                        <form method="POST" action="">
                                        <button type="submit" name="delete_order_id" value="<?php echo $order['order_id']; ?>" class="btn-delete">
    Delete
</button>
</form>
                                        </td>
                                        

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
               
            </div>
        <?php else: ?>
            <p>No orders found for your account.</p>
        <?php endif; ?>
        
        <div class="totals">
            <div class="totals-row">
                <span>Sub Total</span>
                <span>BDT <?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="totals-row">
                <span>GST Inc.</span>
                <span>BDT <?php echo number_format($gst, 2); ?></span>
            </div>
            <div class="totals-row">
                <span>Shopping Cart Total</span>
                <span>BDT <?php echo number_format($total, 2); ?></span>
            </div>
        </div>


    </div>
    <div class="text-center">
    <form method="POST" action="">
    <button type="submit" name="place_all_orders" class="btn-place-all">
        Place All Orders
    </button>
</form>
    </div>

    
   
</div>

<div id="footer">
    <?php include 'footer.php'; ?>
</div>
</body>
</html>
