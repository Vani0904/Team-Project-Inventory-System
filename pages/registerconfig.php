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