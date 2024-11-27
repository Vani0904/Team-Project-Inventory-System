<?php
        include "../includes/connectdb.php";

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        function validate_register($username, $password, $confirm_password, $mysqli) {
            if ($password != $confirm_password) {
                echo "Passwords do not match.";
                return false;
            }
        
            $register_query = "SELECT username FROM users WHERE username = ?";
            $stmt = $mysqli->prepare($register_query);
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
    
            if (validate_register($get_username, $get_password, $get_confirm_password, $mysqli)) {
                $hashed_password = password_hash($get_password, PASSWORD_BCRYPT);

                $stmt = $mysqli->prepare("
               INSERT INTO users 
              (first_name, middle_name, surname, username, password, is_registered, is_admin, address_1, address_2, address_3, postcode) 
               VALUES (?, ?, ?, ?, ?, 1, 0, ?, ?, ?, ?)");

            $stmt->bind_param(
               "sssssssss", 
                $first_name, $middle_name, $surname, $get_username, 
                $hashed_password, $address_1, $address_2, $address_3, $postcode
             );

                if ($stmt->execute()) {
                    header("Location: login.php");
                    exit();
                } 
                else {
                    echo "Error: " . $stmt->error;
                }
            } 
            else {
                echo "Invalid registration details.";
            }
        }
        ?>