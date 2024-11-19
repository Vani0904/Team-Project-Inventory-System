<?php

session_start();

if(isset($_POST['user-id-select']) && !$_POST['user-id-select'] == 0) //if its 0 it means user didn't choose anything so we do not want to be filtering by user_id
{
    $_SESSION['invoice-filter-selected-id'] = $_POST['user-id-select'];
}

if(isset($_POST['invoice-date-filter-from']) && !empty($_POST['invoice-date-filter-from']))
{
    $_SESSION['invoice-filter-selected-date-from']  = $_POST['invoice-date-filter-from'];
}

if(isset($_POST['invoice-date-filter-to']) && !empty($_POST['invoice-date-filter-to']))
{
    $_SESSION['invoice-filter-selected-date-to']  = $_POST['invoice-date-filter-to'];
}

header("Location: admin-invoices.php");

?>