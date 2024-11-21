<?php
require_once  '../includes/database.php';

class Product 
{
    public static function getAllProducts() 
    {
        $db = Database::connect();
        $query = "SELECT name, manufacturer, unit_price, product_image FROM products";
        $result = $db->query($query);

        if ($result->num_rows > 0) 
        {
            $products = [];
            while ($row = $result->fetch_assoc()) 
            {
                $products[] = $row;
            }
            return $products;
        }
        return [];
    }
}
?>