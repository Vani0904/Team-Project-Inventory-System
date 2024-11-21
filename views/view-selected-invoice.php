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
            <?php foreach ($invoice_details as $invoice_detail): ?>
                <?php
                    $total_cost = $invoice_detail['total_cost'];
                    $invoice_date = $invoice_detail['invoice_date'];
                    $invoice_description = $invoice_detail['invoice_description'];
                ?>
                <p>Invoice No: <?= $invoice_detail['invoice_id'] ?></p>
            <?php endforeach; ?>
        </div>
        <h1 id="generated-invoice-h1">Invoice</h1>
        <h2>Invoice Date: <?php echo date('F j, Y'); ?></h2>
        <div id="generated-invoice-addresses">
            <div>
                <h3>Supplier Address</h3>
                <?php foreach ($invoice_details as $invoice_detail): ?>
                    <p><?= $invoice_detail['supplier_name'] ?></p>
                    <p><?= $invoice_detail['supplier_address_1'] ?></p>
                    <?php 
                        if($invoice_detail['supplier_address_2'] != null)
                        {
                            ?>
                            <p><?= $invoice_detail['supplier_address_2'] ?></p>
                            <?php
                        }
                        ?>
                    <p><?= $invoice_detail['supplier_address_3'] ?></p>
                    <p><?= $invoice_detail['supplier_postcode'] ?></p>
                <?php endforeach; ?>
            </div>
            <div>
                <h3>Customer Address</h3>
                <?php foreach ($invoice_details as $invoice_detail): ?>
                    <p><?= $invoice_detail['customer_name'] ?></p>
                    <p><?= $invoice_detail['customer_address_1'] ?></p>
                    <?php 
                        if($invoice_detail['customer_address_2'] != null)
                        {
                            ?>
                            <p><?= $invoice_detail['customer_address_2'] ?></p>
                            <?php
                        }
                        ?>
                    <p><?= $invoice_detail['customer_address_3'] ?></p>
                    <p><?= $invoice_detail['customer_postcode'] ?></p>
                <?php endforeach; ?>
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
                } 
            ?>
            </div>
            <p>Shipping: £2.99</p>
            <p><b>Total Cost: </b> £<?php echo $total_cost; ?></p>
        </div>
    </div>
</body>

</html>