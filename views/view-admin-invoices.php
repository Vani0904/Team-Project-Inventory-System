<?php
include '../includes/head.php';

if (isset($_SESSION['invoice-filter-selected-id'])) //USER ID HAS BEEN CHOSEN TO FILTER
{
    if (isset($_SESSION['invoice-filter-selected-date-from']) && isset($_SESSION['invoice-filter-selected-date-to'])) 
    {
        AdminInvoicesController::show_invoices_by_id_and_date();
    } 
    else //ONLY USER ID HAS BEEN CHOSEN, DON'T FILTER BY DATE.
    {
        AdminInvoicesController::show_invoices_by_id();
    }
} else //USER ID HAS NOT BEEN CHOSEN TO FILTER
{
    if (isset($_SESSION['invoice-filter-selected-date-from']) && isset($_SESSION['invoice-filter-selected-date-to'])) 
    {
        AdminInvoicesController::show_invoices_by_date();
    } 
    else //User has not chose to filter anything (or it's the first time page loads; do regular SQL)
    {
        AdminInvoicesController::show_all_invoices();
    }
}

?>

<head>
    <script src="../scripts/setdate.js" defer></script>
    <script src="../scripts/identifyinvoice.js" defer></script>
    <title>View Invoices</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
</head>

<body>
    <div class="container">
        <div class="page-divider">
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <?php include '../includes/nav-menu.php'; ?>
            <div class="segment-margined">
                <?php include '../includes/header-admin.php'; ?>
                <h1 class="admin">Invoices</h1>
                <form id="invoice-table-filters" action="invoice-apply-filters.php" method="post">
                    <div class="filter">
                        <label><strong>By Customer Id:</strong></label>
                        <select class="ui" name="user-id-select">
                            <option value="0">Unfiltered</option>
                            <?php foreach ($distinct_users as $distinct_user): ?>
                                <option><?= $distinct_user['user_id'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="filter">
                        <label><strong>By Issue Date Range:</strong></label>
                        <input id="invoiceDateFrom" type="date" class="ui" name="invoice-date-filter-from"
                            min="2024-01-01" max="2024-12-31"></input>
                        <label>to:</label>
                        <input id="invoiceDateTo" type="date" class="ui" name="invoice-date-filter-to"
                            min="2024-01-01" max="2024-12-31"></input>
                    </div>
                    <div>
                        <button class="ui">Apply Filters</button>
                    </div>
                </form>
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
                            <?php foreach ($invoices as $invoice): ?>
                                <tr>
                                    <td name="id"><?= $invoice['invoice_id'] ?></td>
                                    <td name="user_id"><?= $invoice['user_id'] ?></td>
                                    <td name="user_name"><?= $invoice['first_name'] . ' ' . $invoice['middle_name'] . ' ' . $invoice['surname'] ?></td>
                                    <td name="date"><?= $invoice['invoice_date'] ?></td>
                                    <td><?= $invoice['payment_date'] ? $invoice['payment_date'] : 'Unpaid'?></td>
                                    <td name="cost"><?= (float)$invoice['total_cost'] ?></td>
                                    <td><button onclick="loadInvoice(this)" class="open-invoice">Open Invoice</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>