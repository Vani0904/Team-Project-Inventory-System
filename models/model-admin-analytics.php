<?php
require_once  '../includes/database.php';

class AdminAnalytics 
{
    public static function get_all_inventory_items_including_product_names() 
    {
        $db = Database::connect();

        $query = "SELECT inventory_items.product_id, products.name, SUM(inventory_items.quantity) as total_quantity 
        FROM inventory_items 
        INNER JOIN products ON inventory_items.product_id = products.product_id 
        GROUP BY inventory_items.product_id, products.name
        ORDER BY products.name";

        $result = $db->query($query);

        $inventory_items_all = [];

        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $inventory_items_all[] = 
                [
                    'product_id' => $row['product_id'],
                    'name' => $row['name'],
                    'quantity' => $row['total_quantity']
                ];
            }
        }

        return $inventory_items_all;
    }

    public static function get_all_inventory_items_by_branch($branch_id)
    {
        $db = Database::connect();
        $query = "SELECT inventory_items.quantity, products.name FROM inventory_items INNER JOIN products ON inventory_items.product_id = products.product_id WHERE branch_id = $branch_id ORDER BY products.name";

        $result = $db->query($query);
        
        $inventory_items = [];

        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $inventory_items[] = $row;
            }
        }

        return $inventory_items;
    }
}
?>