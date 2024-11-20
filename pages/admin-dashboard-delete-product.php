<?php
include "../includes/connectdb.php";
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['product-id'])) {
        //Validate Product ID
        $product_id = intval($_GET['product-id']);

        mysqli_begin_transaction($connection);

        try{
            $deleteInventoryQuery = "DELETE FROM inventory_items WHERE product_id = $product_id";
            if (!mysqli_query($connection, $deleteInventoryQuery)){
                throw new Exception("Error deleting inventory data: " . mysqli_error($connection));
            }
            $resetInventoryQuery = "ALTER TABLE inventory_items AUTO_INCREMENT = 1";
            mysqli_query($connection, $resetInventoryQuery);

            $deleteQuery = "DELETE FROM products WHERE product_id = $product_id";
            if (!mysqli_query($connection, $deleteQuery)){
                throw new Exception("Error deleting product: " . mysqli_error($connection));
            }

            //reset AUTO_INCREMENT value
            $resetQuery = "ALTER TABLE products AUTO_INCREMENT = 1";
            mysqli_query($connection, $resetQuery);

            mysqli_commit($connection);

            header("Location: admin-dashboard.php");
            exit();
        }   catch (Exception $e) {
            mysqli_rollback($connection);
        }
    }
?>