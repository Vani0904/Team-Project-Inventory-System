<?php
session_start();
include "../includes/connectdb.php";

session_destroy();

header('Location: guest.php');

?>