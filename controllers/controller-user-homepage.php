<?php
require_once '../models/model-user-homepage.php';

class ProductController 
{
    public static function process() 
    {
        $products = UserHomepage::get_all_products();
        $manufacturers = UserHomepage::get_all_manufacturers();
        require_once '../views/view-user-homepage.php';
    }
}
?>