<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="mobile.css" />
        <link rel="stylesheet" media="only screen and (min-device-width: 737px)" href="../styles/mobile.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <img src="img/logo_main.png">
    <div class="main-container">
        <form class = "user-form" action="loginconfig.php" method="post">
        <h3>Login</h3>
        <?php if (!empty($loginerror)): ?>
                <p class="error">Invalid username or password. Please try again.</p>
            <?php endif; ?>
              <input type="username" name="username" required placeholder="Username">
              <input type="password" name="password" required placeholder="Password">
              <input type="submit" name="submit" value="Login" class="form-btn">
              <p>or <a href="register.php">Sign up</a></p>
         </form>
    </div>
</body>
</html>
