<?php
require_once '../models/model-guest.php';

class guestController
{
    public static function process() 
    {
        // Default filter is "mix"
        $filter = $_GET['filter'] ?? 'mix';

        switch ($filter) {
            case 'women':
                $products = GuestPage::get_products_by_category('perfume', 4);
                break;
            case 'men':
                $products = GuestPage::get_products_by_category('aftershave', 4);
                break;
            default: // Mix
                $products = GuestPage::get_mixed_products(4);
        }

        require '../views/view-guest.php';
    }
}

?>
