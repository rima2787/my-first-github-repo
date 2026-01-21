<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <!-- go to and copy the link bellow (https://cdnjs.com/libraries/font-awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="slice.css"> -->
    <link rel="stylesheet" href="myaccountc.css">
    <link rel="stylesheet" href="navbarc.css">
    <link rel="stylesheet" href="footerc.css">
</head>

















<body>




      <?php include 'navbar.php'; ?>
       <div id="content">



    

    <div class="account-summary">
        <h1>Account Summary</h1>
        <!-- <p>Welcome <a href="#">(log out)</a></p>
        <p>Use the links below to update your personal information, view any previous purchases or wish lists and pay
            for any outstanding invoices.</p>
        <p>New orders can be placed at any time by using the 'add to cart' buttons though this website. <a
                href="#">Click here to start shopping.</a></p> -->

        <div class="grid-container">
            <div class="grid-item">
                <a href="contactinfop.php">
                    <i class="icon"></i>
                    <h2>My Contact Details</h2>
                    <p>Name, phone number and more</p>
                </a>
            </div>
            <!-- <div class="grid-item">
                <a href="#">
                    <i class="icon"></i>
                    <h2>Edit Contacts</h2>
                    <p>Change or add your contacts</p>
                </a>
            </div> -->
            <!-- <div class="grid-item">
                <a href="mypasschangep.php">
                    <i class="icon"></i>
                    <h2>Change My Password</h2>
                    <p>Set something you'll remember!</p>
                </a>
            </div> -->

            <div class="grid-item">
                <a href="order_history.php">
                    <i class="icon"></i>
                    <h2>My Orders</h2>
                    <p>View, print and track orders you have placed.</p>
                </a>
            </div>
            <div class="grid-item">
                <a href="#">
                    <i class="icon"></i>
                    <h2>My Quotes</h2>
                    <p>View or print any outstanding quotes.</p>
                </a>
            </div>
        </div>
    </div>



    </div>
    <script src="myaccountj.js"></script>






   



    <div id="footer">
  <?php include 'footer.php'; ?>
  </div>




</body>

</html>