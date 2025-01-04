<?php
require_once '../includes/database.php';

class GuestPage
{
    public static function get_products_by_category($category, $limit = 4)
    {
        $db = Database::connect();
        $query = $db->prepare("SELECT name, manufacturer, unit_price, product_image FROM products WHERE category = ? LIMIT ?");
        $query->bind_param("si", $category, $limit);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) 
        {
            $products = [];

            while ($row = $result->fetch_assoc()) 
                $products[] = $row;

            return $products;
        }
        
        return [];
    }

    public static function get_mixed_products($limit_per_category = 4)
    {
        $db = Database::connect();
        $query = "
            (SELECT name, manufacturer, unit_price, product_image FROM products WHERE category = 'perfume' LIMIT ?)
            UNION ALL
            (SELECT name, manufacturer, unit_price, product_image FROM products WHERE category = 'aftershave' LIMIT ?)
        ";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ii", $limit_per_category, $limit_per_category);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) 
        {
            $products = [];

            while ($row = $result->fetch_assoc()) 
                $products[] = $row;

            return $products;
        }
        
        return [];
    }
}

?>