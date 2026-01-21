<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeedNest.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="fruitsc.css">
    <link rel="stylesheet" href="navbarc.css">
    <link rel="stylesheet" href="footerc.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div id="content">
        <div class="shop-section">
            <?php
            // Database connection
            $conn = new mysqli("localhost", "root", "", "seednest");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch products where category is 'Fruits'
            $sql = "SELECT * FROM product WHERE category = 'Others'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    $availabilityClass = $row['avail'] == 1 ? 'available' : 'not-available';
                    $availabilityText = $row['avail'] == 1 ? 'Available Now' : 'Not Available';

                    echo '<div class="box">
                        <a href="Detailsp.php?id=' . $row['id'] . '" class="shopping_details">
                            <div class="box-content">
                                <div class="box-img" style="background-image: url(\'' . htmlspecialchars($row['photo']) . '\');"></div>
                                <div class="product-details">
                                    <h2>' . htmlspecialchars($row['name']) . '</h2>
                                    <p class="product-description">' . htmlspecialchars($row['description']) . '</p>
                                    <p class="product-price">BDT ' . htmlspecialchars($row['price']) . '.00</p>
                                    <p class="product-origin">From: ' . htmlspecialchars($row['area']) . '</p>
                                    <p class="availability ' . $availabilityClass . '">' . $availabilityText . '</p>
                                    <button class="see-more-button">See More</button>
                                </div>
                            </div>
                        </a>
                    </div>';
                }
            } else {
                echo "<p>No products found in the Fruits category.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <div id="footer">
        <?php include 'footer.php'; ?>
    </div>

</body>

</html>
