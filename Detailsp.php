<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <!-- Link to Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Detailsc.css">
    <link rel="stylesheet" href="navbarc.css">
    <link rel="stylesheet" href="footerc.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div id="content">
        <?php
        // Database connection
        $conn = new mysqli("localhost", "root", "", "seednest");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch product ID from URL
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Query to fetch product details
        $sql = "SELECT * FROM product WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the product exists
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        ?>
            <div class="product-container">
                <div class="product-image">
                    <img src="<?php echo htmlspecialchars($product['photo']); ?>" alt="Product Image">
                </div>

                <div class="product-details">
                    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                    
                    <div class="ratings">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-count">(<?php echo rand(50, 200); ?> reviews)</span> <!-- Example random reviews -->
                    </div>
                    <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>

                    <div class="price">
                        
                        <span class="">BDT <?php echo htmlspecialchars($product['price']); ?></span>
                        
                    </div>

                    <div class="availability">
                        <p><i class="fa-solid fa-truck"></i> Cash on Delivery: <?php echo $product['avail'] ? 'Available' : 'Not Available'; ?></p>
                    </div>

                    <div class="quantity">
                        <label for="quantity">Quantity:</label>
                        <select id="quantity" name="quantity">
                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="purchase-options">
                        <a href="orderp.php?id=<?php echo $product['id']; ?>" class="order_button">
                        <button class="add-to-cart"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
                            <!-- <button class="buy-now">Order Now</button> -->
                        </a>

                        <a href="addcartp.php?id=<?php echo $product['id']; ?>" class="link_box">
                            <button class="add-to-cart"><i class="fa-solid fa-cart-shopping"></i> View Cart</button>
                        </a>
                    </div>

                    <div class="other-options">
                        <p>Other Options:</p>
                        <ul>
                            <li><i class="fa-solid fa-question-circle"></i> 24/7 Customer Support</li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        } else {
            echo "<p>Product not found.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>

    <div id="footer">
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>

<!-- 06:00:41 done -->