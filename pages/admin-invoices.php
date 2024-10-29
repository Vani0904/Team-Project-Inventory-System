<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/mobile.css" />
    <link rel="stylesheet" media="only screen and (min-device-width: 737px)" href="../styles/desktop.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../scripts/setdate.js" defer></script>
    <title>View Invoices</title>
</head>

<body>
    <div class="container">
        <?php include '../includes/header-admin.php'; ?>
        <div class="page-divider">
            <div class="admin-sidebar">
                
            </div>
            <div class="segment-margined">
                <div>
                    <h1 class="admin">Invoices</h1>
                </div>
                <div id="invoice-table-filters">
                    <div class="filter">
                        <strong>Filters:</strong>
                    </div>
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
                </div>
                <div id="invoice-table-container">
                    <table id="invoice-table">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>User ID</th>
                                <th>Issue Date</th>
                                <th>Payment Date</th>
                                <th>Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>000</td>
                                <td>00</td>
                                <td>28th October 2024</td>
                                <td>28th October 2024</td>
                                <td>£400.54</td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td>01</td>
                                <td>28th October 2024</td>
                                <td>28th October 2024</td>
                                <td>£32.49</td>
                            </tr>
                            <tr class="active">
                                <td>002</td>
                                <td>02</td>
                                <td>28th October 2024</td>
                                <td>28th October 2024</td>
                                <td>£77.28</td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>03</td>
                                <td>28th October 2024</td>
                                <td>28th October 2024</td>
                                <td>£1,103.26</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>

    </div>
</body>