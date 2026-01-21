<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="loginc.css">
    <link rel="stylesheet" href="extra_loginc.css">
    <link rel="stylesheet" href="navbarc.css">
    <link rel="stylesheet" href="footerc.css">
    <style>
        .notification-bar {
            background-color: #ff4d4d; /* Brighter red color */
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 30px;
            text-align: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 600px;
            font-size: 18px;
            border-radius: 5px;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .notification-bar button {
            background-color: #721c24;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }

        .notification-bar button:hover {
            background-color: #a71d2a;
        }
    </style>
</head>

<body>
    <?php
    session_start(); // Start session
    include 'navbar.php'; 
    ?>

    <div id="content">
        <div class="login-container">
            <div class="login-form">
                <img src="LoginLogo.png" alt="Logo" class="logo">
                <h1>Login</h1>

                <?php if (isset($_SESSION['error_message'])): ?>
                <div class="notification-bar">
                    <p><?php echo htmlspecialchars($_SESSION['error_message']); ?></p>
                    <button onclick="document.querySelector('.notification-bar').style.display='none'">OK</button>
                </div>
                <?php unset($_SESSION['error_message']); // Unset the error message after displaying ?>
                <?php endif; ?>

                <form action="login_process.php" method="POST">
                    <div class="input-group">
                        <label for="email-phone">Gmail or Phone Number</label>
                        <input type="text" id="email-phone" name="email-phone" placeholder="antor1552@gmail.com or 01743302979" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit">Login</button>
                </form>

                <!-- <div class="alternative-login">
                    <p>Or</p>
                    <button class="google-login" onclick="window.location.href='https://accounts.google.com/signin'">Login with Google</button>
                </div> -->
                <div class="signup-link">
                    <p>Don't have an account? <a href="signupp.php" class="new_client">Sign up</a></p>
                </div>
                <div class="homepage-link">
                    <button class="homepage-button" onclick="window.location.href='index.php'">Back to Homepage</button>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
