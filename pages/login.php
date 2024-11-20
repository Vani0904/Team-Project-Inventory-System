<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="mobile.css" />
        <link rel="stylesheet" media="only screen and (min-device-width: 737px)" href="../styles/mobile.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegance Scent</title>
</head>
<body>
    <img src="images" alt="">
    <div class="main-container">
    <?php 
    session_start();
    include "../includes/connectdb.php";

    if ($mysqli->connect_error) {
        die("ERROR: Mysqli could not connect. " . $mysqli->connect_error);
    }
    
    function validate_login($username, $password, $mysqli, $is_registered, $is_admin) {
        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);
    
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        if ($is_admin === true) { $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'"; }
    
        $result = $mysqli->query($query);
    
        if ($result->num_rows == 1) {     
            $row = $result->fetch_assoc();
            $full_name = $row['first_name'] . " " . $row['middle_name'] . " " . $row['surname'];
            $_SESSION['user_name'] = $full_name;
            if ($is_admin === true) { $_SESSION['user_id'] = $row['admin_id']; } else { $_SESSION['user_id'] = $row['user_id']; }
            $_SESSION['is_admin'] = $is_admin;
            return true;
        } else {
            return false;
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if (validate_login($username, $password, $mysqli, false)) {
            header("Location: user-home.php");
            exit();
        } elseif (validate_login($username, $password, $mysqli, true)) {
            header("Location: admin-dashboard.php");
            exit();
        } else {
            $loginerror = 'yes';
            include('login.php');
            exit;
        }
    }
    
    $mysqli->close();
    
    ?>
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
