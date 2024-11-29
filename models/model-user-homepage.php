<?php
require_once '../includes/database.php';

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
                $products[] = $row;

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
                $products[] = $row;

            return $products;
        }

        return [];
    }

    public static function get_filtered_products($manufacturer, $price_min, $price_max)
    {
        $db = Database::connect();
        $query = "SELECT * FROM products WHERE 1"; //Prevent the additional "AND" statements further down from being problematic.

        if (!empty($manufacturer)) 
            $query .= " AND manufacturer = ?";

        $query .= " AND unit_price BETWEEN ? AND ?";

        $stmt = $db->prepare($query);

        if (!empty($manufacturer)) 
            $stmt->bind_param("sdd", $manufacturer, $price_min, $price_max); //sdd represents 'string', 'double', 'double'
        else 
            $stmt->bind_param("dd", $price_min, $price_max); //dd represents 'double', 'double'

        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];

        while ($row = $result->fetch_assoc()) 
            $products[] = $row;

        return $products;
    }
}
?>