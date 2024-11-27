<?php
    include "../includes/connectdb.php";  // Ensure this includes the database connection

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    function validate_register($username, $password, $confirm_password, $connection) {
        if ($password != $confirm_password) {
            echo "Passwords do not match.";
            return false;
        }
    
        $register_query = "SELECT username FROM users WHERE username = ?";
        $stmt = $connection->prepare($register_query);  // Use $connection, not $mysqli
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            echo "Username already exists.";
            return false;
        }
    
        return true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'] ?? null; //optional
        $surname = $_POST['surname'];
        $get_username = $_POST['username'];
        $get_password = $_POST['password'];
        $get_confirm_password = $_POST['cpassword'];
        $address_1 = $_POST['address_1'];
        $address_2 = $_POST['address_2'] ?? null; //optional
        $address_3 = $_POST['address_3'];
        $postcode = $_POST['postcode'];

        // Validate the registration details and use $connection here
        if (validate_register($get_username, $get_password, $get_confirm_password, $connection)) {
            // Hash the password
            $hashed_password = password_hash($get_password, PASSWORD_BCRYPT);

            // Prepare the insert query
            $stmt = $connection->prepare("
               INSERT INTO users 
              (first_name, middle_name, surname, username, password, user_type, address_1, address_2, address_3, postcode) 
               VALUES (?, ?, ?, ?, ?, 0, ?, ?, ?, ?)
            ");

            // Bind parameters for the query
            $stmt->bind_param(
                "ssssssssss", 
                $first_name, $middle_name, $surname, $get_username, 
                $hashed_password, $address_1, $address_2, $address_3, $postcode
            );

            // Execute the query
            if ($stmt->execute()) {
                // Redirect to login page on success
                header("Location: login.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Invalid registration details.";
        }
    }
?>
        
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="mobile.css" />
    <link rel="stylesheet" media="only screen and (min-device-width: 737px)" href="../styles/mobile.css"  />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="main-container">
        <form class="user-form" action="register.php" method="post">
            <h3>Sign Up</h3>
            <input class="control" type="text" name="first_name" required placeholder="First Name" maxlength="30">
            <input class="control" type="text" name="middle_name" placeholder="Middle Name (Optional)" maxlength="30">
            <input class="control" type="text" name="surname" required placeholder="Surname" maxlength="30">
            <input class="control" type="text" name="username" required placeholder="Username">
            <input class="control" type="password" name="password" required placeholder="Password" maxlength="12">
            <input class="control" type="password" name="cpassword" required placeholder="Confirm password" maxlength="12">
            <input class="control" type="text" name="address_1" required placeholder="Address 1" maxlength="30">
            <input class="control" type="text" name="address_2" placeholder="Address 2 (Optional)" maxlength="30">
            <input class="control" type="text" name="address_3" required placeholder="Address 3" maxlength="30">
            <input class="control" type="text" name="postcode" required placeholder="Postcode" maxlength="6">
            <h4 class="t&cs">By signing up you agree to the <a href="#">terms & conditions</a>.</h4>
            <input type="submit" name="submit" value="Sign Up" class="form-btn">
            <p>or <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
