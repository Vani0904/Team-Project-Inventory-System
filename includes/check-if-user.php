<?php

session_start();
if(!isset($_SESSION['username']))
    header(header: "Location: login.php");

$username = $_SESSION['username'];
$type = "SELECT xx from user WHERE user_id = '$username'";
$result = mysqli_query($connection, $type);
$row = mysqli_fetch_assoc($result);

if($row['xx'] != 0)
    header(header: "Location: ../logout.php");