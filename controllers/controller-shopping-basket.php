<?php
require_once '../models/model-shopping-basket.php';

$_SESSION['userid'] = 1; //Remove this line later as it should be getting set when logging in.
identify_user();

class ShoppingCartController
{
    public static function showCartItems()
    {
        global $delivery_fee;
        $delivery_fee = 2.99;

        global $subtotal;
        $subtotal = 0.00;

        global $total_cost;
        $total_cost = 0.00;

        global $user_id;
        $cart_id = ShoppingBasket::getCartId($user_id);
        global $cart_items;
        $cart_items = ShoppingBasket::getAllCartItems($cart_id);

        for ($i = 0; $i <= count($cart_items) - 1; $i++) 
        {
            global $subtotal;

            $total_individual = $cart_items[$i]['quantity'] * $cart_items[$i]['unit_price'];
            $subtotal += $total_individual;
        }

        $total_cost = $subtotal + $delivery_fee; //Include the delivery fee.

        require_once '../views/view-user-basket.php';
    }

    public static function generateInvoice()
    {
        global $user_id;
        $users_full_name = ShoppingBasket::getUsersName($user_id);
        $users_full_address = ShoppingBasket::getUsersAddress($user_id);

        global $invoice_description;
        global $total_cost;

        $invoice_description = "";

        global $cart_items;

        for ($i = 0; $i <= count($cart_items); $i++) 
        {
            global $invoice_description;
            $invoice_description .= $cart_items[$i]['quantity'] . '*' . $cart_items[$i]['manufacturer'] . "(" . $cart_items[$i]['name'] . ")" . '@' . $cart_items[$i]['unit_price'] . "\n";
        }

        $template_supplier_name = "Sheffield";
        $template_supplier_address_1 = "30 Brown Ln";
        $template_supplier_address_3 = "Sheffield";
        $template_supplier_postcode = "S12 NH";

        $user_address_exploded = explode(',', $users_full_address);
        $user_address_1 = $user_address_exploded[0];
        $user_address_2 = $user_address_exploded[1];
        $user_address_3 = $user_address_exploded[2];
        $user_postcode = $user_address_exploded[3];

        $invoice_date = date('Y-m-d H:i:s');
        $total_cost = floatval($total_cost);
        $invoice_description = str_replace("'", "", $invoice_description);

        ShoppingBasket::insertInvoice($user_id, $invoice_description, $invoice_date, $total_cost, $template_supplier_name, $template_supplier_address_1, $template_supplier_address_3, $template_supplier_postcode, $users_full_name, $user_address_1, $user_address_2, $user_address_3, $user_postcode);
        ShoppingBasket::clearCart();
    }
}

function identify_user()
{
    global $user_id;
    $user_id = $_SESSION['userid'];
}
?>