<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->
<?php include '../includes/head.php'; ?>

<head>
    <title>Analytics</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js" defer></script>
    <script src="../scripts/piecharts.js" defer></script>
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
                    <h1 class="admin">Analytics</h1>
                </div>
                <div id="analytics-graphs-container">
                    <div class="graphs-item">
                        <h2>Full Inventory Stock</h2>
                        <canvas id="pieChartFull"></canvas>
                    </div>
                    <div class="graphs-item">
                        <h2>Branch Inventory Stock</h2>
                        <canvas id="pieChartBranch"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>