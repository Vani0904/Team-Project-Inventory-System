<?php

session_start();
if(!isset($_SESSION['username']))
    header(header: "Location: login.php");

$username = $_SESSION['username'];
$type = "SELECT user_type from user WHERE user_id = '$username'";
$result = mysqli_query($connection, $type);
$row = mysqli_fetch_assoc($result);

if($row['user_type'] != 1)
    header(header: "Location: ../logout.php");