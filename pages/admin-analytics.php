<?php include '../includes/head.php'; ?>

<head>
    <title>Analytics</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js" defer></script>
    <script src="../scripts/piecharts.js" defer></script>
</head>

<body>
    <div class="container">
        <?php include '../includes/header-admin.php'; ?>
        <div class="page-divider">
            <div class="admin-sidebar">

            </div>
            <div class="segment-margined">
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