<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Account Password</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Main CSS -->
    <!-- <link rel="stylesheet" href="slice.css"> -->
    <link rel="stylesheet" href="mypasschangec.css">
    <link rel="stylesheet" href="navbarc.css">
    <link rel="stylesheet" href="footerc.css">
</head>

<body>
    <!-- Header -->
    


    <?php include 'navbar.php'; ?>
    <div id="content">

    <!-- Change Password Section -->
    <main>
        <div class="container">
            <nav class="breadcrumb">
                <a href="#">Home</a> /
                <a href="#">My Account</a> /
                <span>Change My Password</span>
            </nav>

            <h1>Change Account Password</h1>
            <p class="instruction">Please enter your current and new password below in order to change your password.
            </p>

            <form id="password-form" class="password-form">
                <div class="form-group">
                    <label for="current-password">Current Password:</label>
                    <input type="password" id="current-password" name="current-password" required>
                </div>
                <div class="form-group">
                    <label for="new-password">New Password:</label>
                    <input type="password" id="new-password" name="new-password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm New Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
                <button type="submit" class="btn-submit">Change My Password</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    

    </div>
    <script src="mypasschangej.js"></script>






   



    <div id="footer">
  <?php include 'footer.php'; ?>
  </div>





</body>

</html>