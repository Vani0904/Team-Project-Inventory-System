<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->
<?php include '../includes/head.php'; ?>

<head>
    <script src="../scripts/setdate.js" defer></script>
    <script src="../scripts/selectionhandler.js" defer></script>
    <title>View Invoices</title>
</head>

<body>
    <div class="container">
        <div class="page-divider">
            <nav class="nav-menu">
                <img src="../images/logo_main.png" alt="logo">
                <a href="admin-dashboard.php"><img src="../images/dashboard-icon.png" alt="dashboard icon"></a>
                <a href="admin-analytics.php"><img src="../images/analytics-icon.png" alt="analytics icon"></a>
                <a href="admin-invoices.php"><img src="../images/invoices-icon.png" alt="invoices icon"></a>
            </nav>
            <div class="segment-margined">
                <?php include '../includes/header-admin.php'; ?>

                <div>
                    <h1 class="admin">Invoices</h1>
                </div>
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
                                <th>User ID</th>
                                <th>Issue Date</th>
                                <th>Payment Date</th>
                                <th>Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="selectRow(this)">
                                <td>0</td>
                                <td>000</td>
                                <td>00</td>
                                <td>28th October 2024</td>
                                <td>28th October 2024</td>
                                <td>£400.54</td>
                            </tr>
                            <tr onclick="selectRow(this)">
                                <td>1</td>
                                <td>001</td>
                                <td>01</td>
                                <td>28th October 2024</td>
                                <td>28th October 2024</td>
                                <td>£32.49</td>
                            </tr>
                            <tr onclick="selectRow(this)">
                                <td>2</td>
                                <td>002</td>
                                <td>02</td>
                                <td>28th October 2024</td>
                                <td>28th October 2024</td>
                                <td>£77.28</td>
                            </tr>
                            <tr onclick="selectRow(this)">
                                <td>3</td>
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
</body>