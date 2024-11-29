<?php

$hostname = "localhost";
$username = "root";
$password = "";

$db_name = "inventory-system";
$connection = mysqli_connect($hostname, $username, $password, $db_name);

if (!$connection) 
{
    echo "Could not connect to database.";
}
