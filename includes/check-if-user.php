<?php

session_start();

if(!isset($_SESSION['user_name'])) //If user_name is not set (therefore user has accessed this page manually without logging in), prevent them from accessing the page and relocate to login page.
    header(header: "Location: login.php");

if($_SESSION['is_admin'] != 0) //If the selected user's type is not 0 therefore NOT set to standard user, prevent them from accessing the page and relocate to guest page.
    header(header: "Location: ../pages/admin-dashboard.php");