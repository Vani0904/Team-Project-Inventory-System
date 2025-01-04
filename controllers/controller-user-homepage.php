<?php
require_once '../models/model-user-homepage.php';

class ProductController 
{
    public static function process() 
    {
        $manufacturers = UserHomepage::get_all_manufacturers();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') 
        {
            $filter_manufacturer = $_GET['brand'] ?? null;
            $filter_price_min = $_GET['price-min'] ?? 1;
            $filter_price_max = $_GET['price-max'] ?? 300;
            $search_query = $_GET['searchbar'] ?? '';
            
            global $products;
            if (!empty($search_query)) {
                $products = UserHomepage::get_searched_products($search_query); // Call the search model method
            } else {
                $products = UserHomepage::get_filtered_products($filter_manufacturer, $filter_price_min, $filter_price_max);    
            } 
       }

        require '../views/view-user-homepage.php';
    }
}
?>