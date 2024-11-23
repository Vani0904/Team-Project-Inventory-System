<?php
require_once  '../includes/database.php';

class UserHomepage 
{
    public static function get_all_products() 
    {
        $db = Database::connect();
        $query = "SELECT name, manufacturer, unit_price, product_image FROM products ORDER BY name";
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

    public static function get_all_manufacturers()
    {
        $db = Database::connect();
        $query = "SELECT DISTINCT manufacturer FROM products ORDER BY manufacturer";
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