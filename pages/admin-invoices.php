<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->

<?php
include "../includes/connectdb.php";

session_start();

if(isset($_SESSION['invoice-filter-selected-id'])) //USER ID HAS BEEN CHOSEN TO FILTER
{
    if(isset($_SESSION['invoice-filter-selected-date-from']) && isset($_SESSION['invoice-filter-selected-date-to']))
    {
        display_invoices_by_user_and_date();
    }
    else //ONLY USER ID HAS BEEN CHOSEN, DON'T FILTER BY DATE.
    {
        display_invoices_by_user_only();
    }
}
else //USER ID HAS NOT BEEN CHOSEN TO FILTER
{
    if(isset($_SESSION['invoice-filter-selected-date-from']) && isset($_SESSION['invoice-filter-selected-date-to']))
    {
        display_invoices_by_date_only();
    }
    else //User has not chose to filter anything (or it's the first time page loads; do regular SQL)
    {
        display_invoices_all();
    }
}

$distinct_users_of_invoices = "SELECT DISTINCT user_id FROM invoices";
$distinct_users_of_invoices_result = mysqli_query($connection, $distinct_users_of_invoices);

function display_invoices_by_user_and_date()
{
    include "../includes/connectdb.php";

    $filtered_user = $_SESSION['invoice-filter-selected-id'];
    $filtered_date_from = $_SESSION['invoice-filter-selected-date-from'];
    $filtered_date_to = $_SESSION['invoice-filter-selected-date-to'];

    global $invoices;
    $invoices = "SELECT invoices.invoice_id, invoices.user_id, invoices.invoice_date, invoices.payment_date, invoices.total_cost, 
    users.first_name, users.middle_name, users.surname FROM invoices INNER JOIN users ON invoices.user_id = users.user_id WHERE invoices.user_id = $filtered_user AND invoice_date >= '$filtered_date_from' AND invoice_date <= '$filtered_date_to'";
    
    global $invoices_result;
    $invoices_result = mysqli_query($connection, $invoices);
}

function display_invoices_by_user_only()
{
    include "../includes/connectdb.php";

    $filtered_user = $_SESSION['invoice-filter-selected-id'];

    global $invoices;
    $invoices = "SELECT invoices.invoice_id, invoices.user_id, invoices.invoice_date, invoices.payment_date, invoices.total_cost, 
    users.first_name, users.middle_name, users.surname FROM invoices INNER JOIN users ON invoices.user_id = users.user_id WHERE invoices.user_id = $filtered_user";
    
    global $invoices_result;
    $invoices_result = mysqli_query($connection, $invoices);
}

function display_invoices_by_date_only()
{
    include "../includes/connectdb.php";

    $filtered_date_from = $_SESSION['invoice-filter-selected-date-from'];
    $filtered_date_to = $_SESSION['invoice-filter-selected-date-to'];

    global $invoices;
    $invoices = "SELECT invoices.invoice_id, invoices.user_id, invoices.invoice_date, invoices.payment_date, invoices.total_cost, 
    users.first_name, users.middle_name, users.surname FROM invoices INNER JOIN users ON invoices.user_id = users.user_id WHERE invoice_date >= '$filtered_date_from' AND invoice_date <= '$filtered_date_to'";
    
    global $invoices_result;
    $invoices_result = mysqli_query($connection, $invoices);
}

function display_invoices_all()
{
    include "../includes/connectdb.php";

    global $invoices;
    $invoices = "SELECT invoices.invoice_id, invoices.user_id, invoices.invoice_date, invoices.payment_date, invoices.total_cost, 
    users.first_name, users.middle_name, users.surname FROM invoices INNER JOIN users ON invoices.user_id = users.user_id";
    
    global $invoices_result;
    $invoices_result = mysqli_query($connection, $invoices);
}

?>

<?php include '../includes/head.php'; ?>

<head>
    <script src="../scripts/setdate.js" defer></script>
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
                <form id="invoice-table-filters" action="invoice-apply-filters.php" method="post">
                    <div class="filter">
                        <label class="element">By Customer Id:</label>
                        <select class="element ui" name="user-id-select">
                            <option value="0">Unfiltered</option>
                            <?php
                            while ($row_for_dropdown = mysqli_fetch_assoc($distinct_users_of_invoices_result)) 
                            {
                                ?>
                                <option><?php echo $row_for_dropdown['user_id'] ?></option>
                            <?php 
                            } 
                            ?>
                        </select>
                    </div>
                    <div class="filter">
                        <label class="element">By Issue Date Range:</label>
                        <input id="invoiceDateFrom" type="date" class="element ui" name="invoice-date-filter-from"
                            min="2024-01-01" max="2024-12-31"></input>
                        <label class="element">to:</label>
                        <input id="invoiceDateTo" type="date" class="element ui" name="invoice-date-filter-to"
                            min="2024-01-01" max="2024-12-31"></input>
                    </div>
                    <div>
                        <button class="element ui">Apply Filters</button>
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
                            <?php
                            mysqli_data_seek($invoices_result, 0);
                            while ($row = mysqli_fetch_assoc($invoices_result)) {
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