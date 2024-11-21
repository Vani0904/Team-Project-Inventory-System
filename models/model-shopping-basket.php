<?php
require_once  '../includes/database.php';

class ShoppingBasket 
{
    public static function getCartId ($user_id)
    {
        $db = Database::connect();
        $query = "SELECT cart_id FROM users WHERE user_id = $user_id";
        $result = $db->query($query);

        if ($result->num_rows > 0) 
        {
            $cart_id = 0;
            while ($row = $result->fetch_assoc()) 
            {
                $cart_id = $row['cart_id'];
            }
            return $cart_id;
        }
    }

    public static function getAllCartItems($cart_id) 
    {
        $db = Database::connect();
        $query = "SELECT products.product_id, products.name, products.manufacturer, products.unit_price,products.product_image, cart_items.quantity
                FROM cart_items INNER JOIN products ON cart_items.product_id = products.product_id WHERE cart_items.cart_id = '$cart_id'";
        $result = $db->query($query);

        if ($result->num_rows > 0) 
        {
            $cart_items = [];
            while ($row = $result->fetch_assoc()) 
            {
                $cart_items[] = $row;
            }
            return $cart_items;
        }
        return [];
    }

    public static function getUsersName($user_id)
    {
        $db = Database::connect();
        $query = "SELECT CONCAT(first_name, ' ', middle_name, ' ', surname) AS full_name FROM users WHERE user_id = '$user_id'";
        $result = $db->query($query);

        if ($result->num_rows > 0) 
        {
            $user_full_name = "";
            while ($row = $result->fetch_assoc()) 
            {
                $user_full_name = $row['full_name'];;
            }
            return $user_full_name;
        }
    }

    public static function getUsersAddress($user_id)
    {
        $db = Database::connect();
        $query = "SELECT CONCAT(address_1, ',', address_2, ',', address_3, ',', postcode) AS 'address' FROM users WHERE user_id = '$user_id'";
        $result = $db->query($query);

        if ($result->num_rows > 0) 
        {
            $user_full_address = "";
            while ($row = $result->fetch_assoc()) 
            {
                $user_full_address = $row['address'];;
            }
            return $user_full_address;
        }
    }

    public static function insertInvoice($user_id, $invoice_description, $invoice_date, $total_cost, $template_supplier_name, $template_supplier_address_1, $template_supplier_address_3, $template_supplier_postcode, $user_full_name, $user_address_1, $user_address_2, $user_address_3, $user_postcode)
    {   
        if($total_cost > 2.99) //Prevent inserting empty invoice entry into invoices table. Makes this function do nothing.
        {
            $db = Database::connect();
            $query = "INSERT INTO invoices (user_id, invoice_description, invoice_date, payment_date, total_cost,
            supplier_name, supplier_address_1, supplier_address_2, supplier_address_3, supplier_postcode, 
            customer_name, customer_address_1, customer_address_2, customer_address_3, customer_postcode) 
            VALUES ($user_id, '$invoice_description', '$invoice_date', NULL, $total_cost,
            '$template_supplier_name', '$template_supplier_address_1', NULL, '$template_supplier_address_3', '$template_supplier_postcode',
            '$user_full_name', '$user_address_1', '$user_address_2', '$user_address_3', '$user_postcode'
            )";
            $result = $db->query($query);
        }
    }

    public static function clearCart()
    {
        $db = Database::connect();
        global $user_id;
        
        $id = ShoppingBasket::getCartId($user_id);

        $query = "DELETE FROM cart_items WHERE cart_id = $id";
        $result = $db->query($query);

        header('Location: ../pages/user-homepage.php');
    }
}
?>