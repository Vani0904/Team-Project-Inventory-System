<?php
require_once '../controllers/controller-shopping-basket.php';

include '../includes/check-if-user.php';

ShoppingCartController::showCartItems();

?>