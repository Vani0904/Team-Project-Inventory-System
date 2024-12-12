<?php
session_start();
include "../includes/connectdb.php";

if ($connection->connect_error) {
    die("ERROR: Connection failed: " . $connection->connect_error);
}

// Function to validate login
function validate_login($username, $password, $connection) {
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['user_name'] = $row['first_name'] . " " . $row['middle_name'] . " " . $row['surname'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['is_admin'] = $row['is_admin'];
            
            return $row['is_admin'] ? 'admin' : 'user';
        }
    }

    return false;
}

// Handle login request
$loginerror = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_status = validate_login($username, $password, $connection);

    if ($login_status === 'user') {
        header("Location: user-homepage.php");
        exit();
    } elseif ($login_status === 'admin') {
        header("Location: admin-dashboard.php");
        exit();
    } else {
        $loginerror = 'Invalid username or password. Please try again.';
    }
}

$connection->close();
?>

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
        <form class="user-form" action="login.php" method="post">
            <h3>Login</h3>
            <?php if (!empty($loginerror)): ?>
                <p class="error"><?php echo htmlspecialchars($loginerror); ?></p>
            <?php endif; ?>
            <input type="text" name="username" required placeholder="Username">
            <input type="password" name="password" required placeholder="Password">
            <input type="submit" name="submit" value="Login" class="form-btn">
            <p>or <a href="register.php">Sign up</a></p>
        </form>
    </div>
</body>
</html>
