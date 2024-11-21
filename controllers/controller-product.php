<?php
require_once '../models/model-product.php';

class ProductController 
{
    public static function showProducts() 
    {
        $products = Product::getAllProducts();
        require_once '../views/view-user-homepage.php';
    }
}
?>