<?php include '../includes/head.php'; ?>

<head>
    <title>Shopping Basket</title>
</head>

<body>
    <div class="container">
        <?php include '../includes/header-admin.php'; ?>
        <div id="basket">
            <h1>Shopping Cart</h1>
            <table id="basket-table">
                <thead>
                    <tr>
                        <th></th> <!-- Image -->
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="" width="50px" height="50px"></td>
                        <td>Product Item 1</td>
                        <td>1</td>
                        <td>£20.25</td>
                        <td><button>X</button></td>
                    </tr>
                    <tr>
                        <td><img src="" width="50px" height="50px"></td>
                        <td>Product Item 2</td>
                        <td>3</td>
                        <td>£77.25</td>
                        <td><button>X</button></td>
                    </tr>
                </tbody>
            </table>
            <div id="basket-price">
                <label>Delivery Fee: £2.99</label>
                <label>Subtotal: £97.50</label>
                <label>Total: £100.49</label>
            </div>
            <div id="checkout-container">
                <form>
                    <label id="checkout-label">Checkout</label>
                    <button id="checkout-button" type="submit"><img src="../images/search-icon.png" alt="search button magnifying glass"
                            width="12.5px" height="12.5px"></button>
                </form>
            </div>
        </div>
    </div>