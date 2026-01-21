<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmed Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 20px 0;
        }

        .header h1 {
            margin: 0;
            font-size: 2rem;
            color: #4CAF50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .totals {
            display: flex;
            justify-content: flex-end;
            margin: 20px 0;
        }

        .totals div {
            margin-left: 20px;
            text-align: right;
        }

        .totals span {
            font-weight: bold;
            color: #4CAF50;
        }

        @media screen and (max-width: 768px) {
            table {
                font-size: 14px;
            }

            .header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Confirmed Orders</h1>
        </div>

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
                    <th>Product Price</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch confirmed orders data -->
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'seednest');

                // Check connection
                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }

                // Fetch confirmed orders
                $sql = "
                    SELECT 
                        id AS order_id, fname, lname, company, country, address, city, district, postcode, 
                        (SELECT name FROM product WHERE id = product_id) AS product_name, 
                        (SELECT price FROM product WHERE id = product_id) AS product_price 
                    FROM 
                        confirm_order
                ";
                $result = $conn->query($sql);
                $total_price = 0;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $total_price += $row['product_price'];
                        echo "<tr>
                            <td>" . htmlspecialchars($row['order_id']) . "</td>
                            <td>" . htmlspecialchars($row['fname']) . "</td>
                            <td>" . htmlspecialchars($row['lname']) . "</td>
                            <td>" . htmlspecialchars($row['company']) . "</td>
                            <td>" . htmlspecialchars($row['country']) . "</td>
                            <td>" . htmlspecialchars($row['address']) . "</td>
                            <td>" . htmlspecialchars($row['city']) . "</td>
                            <td>" . htmlspecialchars($row['district']) . "</td>
                            <td>" . htmlspecialchars($row['postcode']) . "</td>
                            <td>" . htmlspecialchars($row['product_name']) . "</td>
                            <td>BDT " . number_format($row['product_price'], 2) . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No confirmed orders found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <div class="totals">
            <div>
                <span>Total Price: </span>BDT <?php echo number_format($total_price, 2); ?>
            </div>
        </div>
    </div>
</body>
</html>
