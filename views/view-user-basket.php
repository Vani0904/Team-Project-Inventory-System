<?php
include '../includes/head.php';

if(isset($_POST['checkout-button']))
{
    ShoppingCartController::generateInvoice();
}
?>

<head>
    <title>Shopping Basket</title>
</head>

<body>
    <div class="container">
        <div id="basket">
            <?php include '../includes/header-admin.php'; ?>
            <div id="return">
                <button id="return-button" onclick="window.location.href='user-home.php'"><img
                        src="../images/icon-return.png" alt="return to previous page button icon" width="30px"
                        height="30px"></button>
                <p>Return</p>
            </div>
            <h1>Shopping Cart</h1>
            <table id="basket-table">
                <thead>
                    <?php
                    if(count($cart_items) >= 1)
                    {
                    ?>
                    <tr>
                        <th></th><!-- The related <td> is where the image fits into.-->
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Item Price</th>
                        <th>Combined Price</th>
                        <th>Remove</th>
                    </tr>
                    <?php
                    }
                    ?>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $cart_item): ?>
                        <tr>
                            <td><img src="data:image/png;base64,<?= base64_encode($cart_item['product_image']) ?>" width ="250px"></td>
                            <td><?= $cart_item['manufacturer'] . ': ' . $cart_item['name'] ?></td>
                            <td><?= $cart_item['quantity']?></td>
                            <td><?= $cart_item['unit_price']?></td>
                            <td><?= $cart_item['quantity'] * $cart_item['unit_price']?></td>
                            <td><button>X</button></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php
                    if(count($cart_items) >= 1)
                    {
                    ?>
                    <tr>
                        <td></td><!-- Blank TD to ensure position of below elements -->
                        <td></td><!-- Blank TD to ensure position of below elements -->
                        <td></td><!-- Blank TD to ensure position of below elements -->
                        <td>Delivery Fee: £<?= $delivery_fee ?></td>
                        <td>Subtotal: £<?= $subtotal ?></td>
                        <td>Total: £<?= $total_cost ?></td>
                    </tr>
                    <?php
                    }
                    else
                    {
                    ?>
                    <p id="no-items">Your shopping cart is empty.</p>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div id="checkout-container">
                <?php
                if(count($cart_items) >= 1)
                {
                ?>
                <form method="post">
                    <label id="checkout-label">Checkout</label>
                    <button id="checkout-button" type="submit" name="checkout-button"><img
                            src="../images/icon-search-white.png" alt="search button magnifying glass" width="12.5px"
                            height="12.5px"></button>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>