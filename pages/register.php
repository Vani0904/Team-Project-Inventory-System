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
        <?php
        include "../includes/connectdb.php";
    
        function validate_register($username, $password, $confirm_password, $mysqli) {
            if ($password != $confirm_password) { return false; }
    
            $register_query = "SELECT username FROM users WHERE username = '{$username}';";
            $register_result = $mysqli->query($register_query);
            if ($obj = $register_result->fetch_object()) {
                if ($obj->username === $username) { return false; }
            }
    
            return true;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first_name = $_POST['firstname'];
            $middle_name = $_POST['middlename'];
            $surname = $_POST['surname'];
            $get_username = $_POST['username'];
            $get_password = $_POST['password'];
            $get_confirm_password = $_POST['cpassword'];
    
            if (validate_register($get_username, $get_password, $get_confirm_password, $mysqli) === true) {
                $user_id_query = "SELECT max(user_id) AS 'user_id' FROM users";
                $user_id_result = $mysqli->query($user_id_query);
                if ($obj = $user_id_result->fetch_object()) {
                    $new_user_id = $obj->user_id + 1;
                }
                $create_user_query = "INSERT INTO users VALUES('{$new_user_id}', '{$first_name}', '{$middle_name}', '{$surname}', '{$get_username}', '1970-01-01', 'empty', '{$get_password}', '00000000000', '000', '000000', 'empty');";
                $create_user_result = $mysqli->query($create_user_query);
                if ($create_user_result === true) {
                    header("Location: login.php");
                    exit();
                }
            }
            else {
                echo "Invalid registration details.";
                exit();
            }
        }
    ?>

        <form class ="user-form" action="register.php" method="post">
           
     
           <input class="control" type="text" name="firstname" required placeholder="First Name" maxlength='30'>
           <input class="control" type="text" name="middlename" placeholder="Middle Name" maxlength='30'>
           <input class="control" type="text" name="surname" required placeholder="Surname" maxlength='30'>
           <input class="control" type="username" name="username" required placeholder="Username">
           <input class="control" type="password" name="userpassword" required placeholder="Password" maxlength='12'>
           <input class="control" type="password" name="cpassword" required placeholder="Confirm password" maxlength='12'>
  <h4 class="t&cs">By signing up you agree to the <a href="">terms & conditions</a>.</h4>
           <input type="submit" name="submit" value="Sign Up" class="form-btn">
           <p>or <a href="login.php">Login</a></p>
        </form>
     
     </div>

</body>
</html>