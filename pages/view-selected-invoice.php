<?php
include "../includes/connectdb.php";

$parse = $_GET['data'];

$exploded = explode(',', $parse);

$invoice_id = $exploded[0];
$users_id = $exploded[1];

$sql_invoice = "SELECT invoice_date, total_cost, invoice_description,
supplier_name, supplier_address_1, supplier_address_2, supplier_address_3, supplier_postcode,
customer_name, customer_address_1, customer_address_2, customer_address_3, customer_postcode
FROM invoices WHERE invoice_id = '$invoice_id'";

$sql_user = "SELECT first_name, surname FROM users WHERE user_id = '$users_id'";

$sql_invoice_result = mysqli_query($connection, $sql_invoice);
$sql_user_result = mysqli_query($connection, $sql_user);

?>

<html>

<head>
    <link rel="stylesheet" href="mobile.css" />
    <link rel="stylesheet" media="all and (min-device-width: 737px)" href="../styles/mobile.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoice</title>
</head>

<body>
    <div id="generated-invoice-container">
        <div id="generated-invoice-header">
            <img src="../images/logo_black.png" width="150px">
            <?php
            while ($row = mysqli_fetch_assoc($sql_invoice_result)) {
                $invoice_date = $row['invoice_date'];
                $invoice_description = $row['invoice_description'];
                ?>
                <?php
            }
            ?>
            <p>Invoice No: <?php echo $invoice_id ?></p>
        </div>
        <h1 id="generated-invoice-h1">Invoice</h1>
        <h2>Invoice Date: <?php echo date('F j, Y'); ?></h2>
        <div id="generated-invoice-addresses">
            <div>
                <h3>Supplier Address</h3>
                <?php
                mysqli_data_seek(result: $sql_invoice_result, offset: 0);
                while ($row = mysqli_fetch_assoc($sql_invoice_result)) {
                    $total_cost = $row['total_cost'];
                    $supplier_name = $row['supplier_name'];
                    $supplier_address_1 = $row['supplier_address_1'];
                    $supplier_address_2 = $row['supplier_address_2'];
                    $supplier_address_3 = $row['supplier_address_3'];
                    $supplier_postcode = $row['supplier_postcode'];
                    $customer_name = $row['customer_name'];
                    $customer_address_1 = $row['customer_address_1'];
                    $customer_address_2 = $row['customer_address_2'];
                    $customer_address_3 = $row['customer_address_3'];
                    $customer_postcode = $row['customer_postcode'];
                    ?>
                    <p><?php echo $supplier_name . ','; ?></p>
                    <p><?php echo $supplier_address_1 . ','; ?></p>
                    <p><?php if ($supplier_address_2 != null)
                        echo $supplier_address_2 . ','; ?></p>
                    <p><?php echo $supplier_address_3 . ','; ?></p>
                    <p><?php echo $supplier_postcode; ?></p>
                    <?php
                }
                ?>
            </div>
            <div>
                <h3>Customer Address</h3>
                <p><?php echo $customer_name . ','; ?></p>
                <p><?php echo $customer_address_1 . ','; ?></p>
                <p><?php if ($customer_address_2 != null)
                    echo $customer_address_2 . ','; ?></p>
                <p><?php echo $customer_address_3 . ','; ?></p>
                <p><?php echo $customer_postcode; ?></p>
            </div>
        </div>
        <h3>Summary</h3>
        <div id="generated-invoice-main-body">
            <?php
            $invoice_description_exploded = explode("\n", $invoice_description);
            ?>
            <div>
                <?php
                for ($i = 0; $i <= count($invoice_description_exploded) - 1; $i++) 
                {
                    echo "<p>" . $invoice_description_exploded[$i] . "</p>";
                } ?>
            </div>
            <p><b>Total Cost: </b> £<?php echo $total_cost; ?></p>
        </div>
    </div>
</body>

</html>