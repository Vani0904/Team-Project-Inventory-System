<?php include '../includes/head.php'; ?>

<?php
include "../includes/connectdb.php";

session_start();

$_SESSION['userid'] = 1; //Remove this line later as it should be getting set when logging in.
identify_user(); //Links to the logged in user's 'userid' (from SESSION data)

#region For Displaying Information in Shopping Cart
$get_cart_id = "SELECT cart_id FROM users WHERE user_id = $user_id";
$result_cart_id = mysqli_query($connection, $get_cart_id);

$row = mysqli_fetch_assoc($result_cart_id);
$cart_id = $row['cart_id'];

$items_full_info_and_quantity = "SELECT products.product_id, products.name, products.manufacturer, products.unit_price,products.image, cart_items.quantity
FROM cart_items INNER JOIN products ON cart_items.product_id = products.product_id WHERE cart_items.cart_id = '$cart_id'";

$result_items_full_info_and_quantity = mysqli_query($connection, $items_full_info_and_quantity );

#endregion

#region For Generating Invoice on Checkout

$users_name_and_address = "SELECT CONCAT(first_name, ' ', surname) AS full_name, CONCAT(address_1, ',', address_2, ',', address_3, ',', postcode) AS 'address' FROM users WHERE user_id = '$user_id'";
$result_users_name_and_address = mysqli_query($connection, $users_name_and_address);
$users_name_and_address_assoc = mysqli_fetch_assoc($result_users_name_and_address);
$user_full_name = $users_name_and_address_assoc['full_name'];
$user_full_address = $users_name_and_address_assoc['address'];

if(isset($_POST['checkout-button']))
{
    generate_invoice();
}
#endregion

function identify_user()
{
    global $user_id;
    $user_id = $_SESSION['userid'];
}

function generate_invoice()
{
    global $connection;
    global $user_id;
    global $total_cost;
    global $user_full_name;
    global $user_full_address;
    global $cart_id;

    $template_supplier_name = "Sheffield";
    $template_supplier_address_1 = "30 Brown Ln";
    $template_supplier_address_2 = NULL;
    $template_supplier_address_3 = "Sheffield";
    $template_supplier_postcode = "S12 NH";

    $user_address_exploded = explode(',', $user_full_address);

    $user_address_1 = $user_address_exploded[0];
    $user_address_2 = $user_address_exploded[1];
    $user_address_3 = $user_address_exploded[2];
    $user_postcode = $user_address_exploded[3];

    $invoice_date = date('Y-m-d H:i:s');
    $create_invoice = "INSERT INTO invoices (user_id, invoice_date, payment_date, total_cost,
    supplier_name, supplier_address_1, supplier_address_2, supplier_address_3, supplier_postcode, 
    customer_name, customer_address_1, customer_address_2, customer_address_3, customer_postcode) 
    VALUES ('$user_id', '$invoice_date', NULL, '$total_cost',
    '$template_supplier_name', '$template_supplier_address_1', '$template_supplier_address_2', '$template_supplier_address_3', '$template_supplier_postcode',
    '$user_full_name', '$user_address_1', '$user_address_2', '$user_address_3', '$user_postcode'
    )";
    mysqli_query($connection, $create_invoice);
    $clear_users_cart = "DELETE FROM cart_items WHERE cart_id = '$cart_id'";
    mysqli_query($connection, $clear_users_cart);
    mysqli_close($connection);

    echo '<script language="javascript">';
    echo 'alert("invoice saved.")';
    echo '</script>';
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
                    <tr>
                        <th></th><!-- The related <td> is where the image fits into.-->
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Item Price</th>
                        <th>Combined Price</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subtotal = 0;
                    $delivery_fee = 2.99;
                    $total_cost = 0;
                    while ($row = mysqli_fetch_assoc($result_items_full_info_and_quantity)) {
                        $product_details = $row['manufacturer'] . ": " . $row['name'];
                        $quantity = (int) $row['quantity'];
                        $price = (float) $row['unit_price'];
                        $total_individual = $quantity * $price;
                        $subtotal += $total_individual;
                        $total_cost = $subtotal + $delivery_fee;
                        $image = $row['image'];
                        ?>
                        <tr>
                            <td><?php echo '<img src="data:image/png;base64,' . base64_encode($image) . '" width=25%/>'; ?>
                            </td>
                            <td><?php echo $product_details; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $total_individual; ?></td>
                            <td><button>X</button></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td></td><!-- Blank TD to ensure position of below elements -->
                        <td></td><!-- Blank TD to ensure position of below elements -->
                        <td></td><!-- Blank TD to ensure position of below elements -->
                        <td>Delivery Fee: £<?php echo $delivery_fee; ?></td>
                        <td>Subtotal: £<?php echo $subtotal; ?></td>
                        <td>Total: £<?php echo $total_cost; ?></td>
                    </tr>
                </tbody>
            </table>
            <div id="checkout-container">
                <form method="post">
                    <label id="checkout-label">Checkout</label>
                    <button id="checkout-button" type="submit" name="checkout-button"><img src="../images/icon-search-white.png"
                            alt="search button magnifying glass" width="12.5px" height="12.5px"></button>
                </form>
            </div>
        </div>
    </div>