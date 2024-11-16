<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->

<?php
include "../includes/connectdb.php";

$all_invoices = "SELECT invoices.invoice_id, invoices.user_id, invoices.invoice_date, invoices.payment_date, invoices.total_cost, 
CONCAT(users.first_name, ' ', users.surname) AS full_name FROM invoices INNER JOIN users ON invoices.user_id = users.user_id";

$all_invoices_result = mysqli_query($connection, $all_invoices);

?>

<?php include '../includes/head.php'; ?>

<head>
    <script src="../scripts/setdate.js" defer></script>
    <script src="../scripts/invoicetoggle.js" defer></script>
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
                        <label class="element">By Customer Id:</label>
                        <select class="element ui">
                            <option value="0">Unfiltered</option>
                            <?php
                            while ($row_for_dropdown = mysqli_fetch_assoc($all_invoices_result)) {
                                ?>
                                <option><?php echo $row_for_dropdown['user_id'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <class="filter">
                        <label class="element">By Date Range:</label>
                        <input id="invoiceDateFrom" type="date" class="element ui" name="invoice-date-filter-from"
                            min="2024-01-01" max="2024-12-31"></input>
                        <label class="element">to:</label>
                        <input id="invoiceDateTo" type="date" class="element ui" name="invoice-date-filter-to"
                            min="2024-01-01" max="2024-12-31"></input>
                        <button class="element ui">Apply</button>
                </div>
                <div id="invoice-table-container">
                    <table id="invoice-table">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Issue Date</th>
                                <th>Payment Date</th>
                                <th>Total Cost</th>
                                <th>View Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($all_invoices_result)) 
                            {
                                $invoice_id = $row['invoice_id'];
                                $user_id = $row['user_id'];
                                $users_name = $row['full_name'];
                                $invoice_date = $row['invoice_date'];
                                $payment_date = $row['payment_date'] ? $row['payment_date'] : 'Unpaid';
                                $total_cost = (float)$row['total_cost'];
                                ?>
                                <tr>
                                    <td><?php echo $invoice_id; ?></td>
                                    <td><?php echo $user_id; ?></td>
                                    <td><?php echo $users_name; ?></td>
                                    <td><?php echo $invoice_date; ?></td>
                                    <td><?php echo $payment_date; ?></td>
                                    <td><?php echo $total_cost; ?></td>
                                    <td><button onclick="toggleVisible('#invoice-popup-container')" class="open-invoice">Open
                                            Invoice</button></td>
                                </tr>
                                <?php
                            }
                            mysqli_close($connection);
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="invoice-popup-container">
                    <div id="invoice-popup">
                        <div id="invoice-popup-close">
                            X;
                        </div>
                        <h2>Invoice: </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>