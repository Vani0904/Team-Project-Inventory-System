<?php include '../includes/head.php';
global $branch_text;
?>

<head>
    <title>Analytics</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="../scripts/analytic-graphs.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            loadData(<?php echo $inventory_items_all_json; ?>, <?php echo $inventory_items_branch_json; ?>);
        });
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
</head>

<body>
    <div class="container">
        <div class="page-divider">
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <?php include '../includes/nav-menu.php'; ?>
            <div class="segment-margined">
                <?php include '../includes/header-admin.php'; ?>
                <div>
                    <h1 class="admin">Analytics</h1>
                </div>
                <div id="branch-filtering">
                    <label><strong>Branch Filtering: </strong></label>
                    <form id="branch-inventory-form">
                        <button class="ui" type="submit" name="branch" value="1">Sheffield</button>
                        <button class="ui" type="submit" name="branch" value="2">Leeds</button>
                        <button class="ui" type="submit" name="branch" value="3">Manchester</button>
                        <button class="ui" type="submit" name="branch" value="4">Nottingham</button>
                    </form>
                </div>
                <div id="analytics-graphs-container">
                    <div class="graphs-item-container">
                        <h2>Full (Company-Wide) Inventory</h2>
                        <canvas id="pieChartFull"></canvas>
                    </div>
                    <div class="graphs-item-container">
                        <h2><?= $branch_text ?> Inventory: </h2>
                        <canvas id="pieChartBranch"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>