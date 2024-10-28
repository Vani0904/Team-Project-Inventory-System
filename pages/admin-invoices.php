<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/mobile.css" />
    <link rel="stylesheet" media="only screen and (min-device-width: 737px)" href="../styles/desktop.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>View Invoices</title>
</head>

<body>
    <div class="container">
        <?php include '../includes/header-admin.php'; ?>

        <div>
            <h1>Invoices</h1>
        </div>
        <div id="invoice-table-filters">
            <div class="invoice-table-filter">
                <strong>Filters:</strong>
            </div>
            <div class="invoice-table-filter">
                <label class="invoice-table-filter-element">By User Id:</label>
                <select class="invoice-table-filter-element">
                    <option value="">User ID 1</option>
                    <option value="">User ID 2</option>
                </select>
            </div>
            <div class="invoice-table-filter">
                <label class="invoice-table-filter-element">By Date Range:</label>
                <input type="date" class="invoice-table-filter-element" name="invoice-date-filter-from">
                <label class="invoice-table-filter-element">to:</label>
                <input type="date" class="invoice-table-filter-element" name="invoice-date-filter-to">
            </div>
        </div>
        <div class="invoice-table-container">
            <table id="invoice-table">
                <thead>
                    <th>Invoice ID</th>
                    <th>User ID</th>
                    <th>Issue Date</th>
                    <th>Payment Date</th>
                    <th>Total Cost</th>
                </thead>
                <tbody>
                    <tr class="invoice-tr">
                        <td>000</td>
                        <td>00</td>
                        <td>28th October 2024</td>
                        <td>28th October 2024</td>
                        <td>£400.54</td>
                    </tr>
                    <tr class="invoice-tr">
                        <td>001</td>
                        <td>01</td>
                        <td>28th October 2024</td>
                        <td>28th October 2024</td>
                        <td>£32.49</td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</body>