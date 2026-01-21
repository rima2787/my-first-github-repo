<?php
// include("session.php");
//session_start();

// Check if session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="navbar">

    <a href="index.php" class="link_box">
        <div class="nav-logo border">
            <div class="logo"></div>
        </div>
    </a>

    <!-- <div class="nav-address border">
        <p class="add-first">At your</p>
        <div class="add-icon">
            <i class="fa-solid fa-location-dot"></i>
            <p class="add-second">Home</p>
        </div>
    </div> -->
    <div class="nav-search">
        <select class="search-select">
            <option>All</option>
        </select>
        <input placeholder="Search SeedNest" class="search-input">
        <div class="search-icon">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>

    <div class="clickable-div">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <a href="myaccountp.php">My Account</a>
            <a href="logout.php">Log Out</a>
            <a href="addcartp.php" class="link_box">
        <div class="nav-cart border">
            <i class="fa-solid fa-cart-shopping"></i>
            Cart
        </div>
    </a>
        <?php else: ?>
            <a href="loginp.php">User Login</a>
            <a href="signupp.php">User Sign Up</a>
        <?php endif; ?>
    </div>

    <!-- <div class="nav-return border">
        <p><span>Returns</span></p>
        <p class="nav-second">& Orders</p>
    </div> -->

    <div class="panel-deals">
        <a href="adminloginp.php" class="admin" >Admin Login</a>
    </div>

   
</div>

<!-- Second part panel -->

<!-- <div class="panel">
    <div class="panel-all">
        <i class="fa-solid fa-bars"></i>
        All
    </div>

    <div class="panel-ops">
        <p>Today's Deals</p>
        <p>Customer Service</p>
        <p>Gift Cards</p>
    </div>

    <div class="panel-deals">
        <a href="adminloginp.php" class="admin" >Admin Login</a>
    </div>
</div> -->
</header>

<script>
    document.querySelector('.foot-panel1').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
