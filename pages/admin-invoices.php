<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->

<?php
include "../includes/connectdb.php";

$all_invoices = "SELECT * FROM invoice";
$all_invoices_result = mysqli_query($connection, $all_invoices);

if (mysqli_num_rows($all_invoices_result) != 0) {
    $invoice_count = mysqli_num_rows($all_invoices_result);
}

$current_row = 0;

?>

<?php include '../includes/head.php'; ?>

<head>
    <script src="../scripts/setdate.js" defer></script>
    <script src="../scripts/selectionhandler.js" defer></script>
    <title>View Invoices</title>
</head>

<body>
    <div class="container">
        <div class="page-divider">
            <?php include '../includes/nav-menu.php'; ?>
            <div class="segment-margined">
                <?php include '../includes/header-admin.php'; ?>
                <h1 class="admin">Invoices</h1>
                <div id="invoice-table-filters">
                    <div class="filter">
                        <label class="element">By User Id:</label>
                        <select class="element ui">
                            <option value="00">00</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                        </select>
                    </div>
                    <class="filter">
                        <label class="element">By Date Range:</label>
                        <input id="invoiceDateFrom" type="date" class="element ui" name="invoice-date-filter-from"
                            min="2024-01-01" max="1951-01-01"></input>
                        <label class="element">to:</label>
                        <input id="invoiceDateTo" type="date" class="element ui" name="invoice-date-filter-to"
                            min="2024-01-01" max="1951-01-01"></input>
                        <button class="element ui">Apply</button>
                </div>
                <div id="invoice-table-container">
                    <table id="invoice-table">
                        <thead>
                            <tr>
                                <th>Row Number</th>
                                <th>Invoice ID</th>
                                <th>Customer Order ID</th>
                                <th>Issue Date</th>
                                <th>Payment Date</th>
                                <th>Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($all_invoices_result)) 
                            {
                                $current_row++;
                                ?>
                                <tr onclick="selectRow(this)">
                                    <td><?php echo $current_row; ?></td>
                                    <td><?php echo $row['invoice_id']; ?></td>
                                    <td><?php echo $row['customer_order_id']; ?></td>
                                    <td><?php echo $row['invoice_date']; ?></td>
                                    <td><?php echo $row['payment_date']; ?></td>
                                    <td><?php echo $row['total_cost']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>