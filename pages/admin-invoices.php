<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->

<?php
include "../includes/connectdb.php";

$all_invoices = "SELECT invoices.invoice_id, invoices.user_id, invoices.invoice_date, invoices.payment_date, invoices.total_cost, 
users.first_name, users.middle_name, users.surname FROM invoices INNER JOIN users ON invoices.user_id = users.user_id";

$all_invoices_result = mysqli_query($connection, $all_invoices);

?>

<?php include '../includes/head.php'; ?>

<head>
    <script src="../scripts/setdate.js" defer></script>
    <script src="../scripts/invoicetoggle.js" defer></script>
    <script src="../scripts/identifyinvoice.js" defer></script>
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
                            mysqli_data_seek($all_invoices_result, 0);
                            while ($row = mysqli_fetch_assoc($all_invoices_result)) {
                                $invoice_id = $row['invoice_id'];
                                $user_id = $row['user_id'];
                                $users_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['surname'];
                                $invoice_date = $row['invoice_date'];
                                $payment_date = $row['payment_date'] ? $row['payment_date'] : 'Unpaid';
                                $total_cost = (float) $row['total_cost'];
                                ?>
                                <tr>
                                    <td name="id"><?php echo $invoice_id; ?></td>
                                    <td name="user_id"><?php echo $user_id; ?></td>
                                    <td name="user_name"><?php echo $users_name; ?></td>
                                    <td name="date"><?php echo $invoice_date; ?></td>
                                    <td><?php echo $payment_date; ?></td>
                                    <td name="cost"><?php echo $total_cost; ?></td>
                                    <td><button onclick="loadInvoice(this)" class="open-invoice">Open Invoice</button></td>
                                </tr>
                                <?php
                            }
                            mysqli_close($connection);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>