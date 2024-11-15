<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->

<?php
include "../includes/connectdb.php";


?>

<?php include '../includes/head.php'; ?>

<head>
    <title>Analytics</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js" defer></script>
    <script src="../scripts/piecharts.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="page-divider">
            <?php include '../includes/nav-menu.php'; ?>
            <div class="segment-margined">
                <?php include '../includes/header-admin.php'; ?>
                <div>
                    <h1 class="admin">Analytics</h1>
                </div>
                <div id="analytics-graphs-container">
                    <div class="graphs-item">
                        <h2>Full Inventory</h2>
                        <canvas id="pieChartFull"></canvas>
                    </div>
                    <div class="graphs-item">
                        <h2>Branch Inventory</h2>
                        <canvas id="pieChartBranch"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>