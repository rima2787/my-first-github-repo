<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="signupc.css">
  <link rel="stylesheet" href="navbarc.css">
  <link rel="stylesheet" href="footerc.css">

</head>

<body>
  <?php include 'navbar.php'; ?>
  <div id="content">
    <div class="wrapper">
      <div class="signup-container">
        <div class="signup-box">
          <div class="logo-container">
            <img src="LoginLogo.png" alt="Logo" class="signup-logo">
          </div>
          <h2 class="signup-heading">Create an Account</h2>

          <form action="signup_process.php" method="POST" id="signup-form">

            <div class="form-group">
              <label for="firstname">First Name:</label>
              <input type="text" id="firstname" name="firstname" placeholder="Antor" required>
            </div>
            <div class="form-group">
              <label for="surname">Surname:</label>
              <input type="text" id="surname" name="surname" placeholder="Kumar Shil" required>
            </div>
            <div class="form-group">
              <label for="email_phone">Email or Phone Number:</label>
              <input type="text" id="email_phone" name="email_phone" placeholder="antor@gmail.com or 01743302979" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" placeholder="••••••••" minlength="6" required>
              <small class="password-notice">Password must be at least 6 characters long.</small>
            </div>
            <div class="form-group">
              <label for="confirm_password">Re-enter Password:</label>
              <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" minlength="6" required>
            </div>
            <div class="form-buttons">
              <a href="index.php">
                <button type="button" class="cancel-button">Cancel</button>
              </a>
              <button type="submit">Continue</button>
            </div>
          </form>
          <p class="user-agreement">By clicking Continue, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
        </div>
      </div>
    </div>
  </div>
  <div id="footer">
    <?php include 'footer.php'; ?>
  </div>
</body>

</html>