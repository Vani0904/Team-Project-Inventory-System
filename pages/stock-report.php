<?php 
include "../includes/connectdb.php"; 
    $query = "SELECT
                b.name AS branch_name,
                p.name AS product_name,
                i.quantity,
                (p.unit_price * i.quantity) AS total_value
              FROM inventory_items i
              INNER JOIN products p ON i.product_id = p.product_id
              INNER JOIN branches b ON i.branch_id = b.branch_id
              ORDER BY b.name, p.name";
    $result = mysqli_query($connection, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
?>
<html>
    <head>
        <link rel="stylesheet" media="all and (min-device-width: 737px)" href="../styles/mobile.css" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Report</title>
    </head>
    <div id="generated-report-container">
        <div id="generated-report-header">
            <img src="../images/logo_black.png" width="150px">
            <h1 id="generated-report-h1">Stock Report</h1>
            <h2>Report Date: <?php echo date('F j, Y'); ?></h2>
        </div>
        <h3>Summary</h3>
        <p></p>
        <div id="generated-report-main-body">
            <table>
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Value (£)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['branch_name']); ?></td>
                            <td><?= htmlspecialchars($row['product_name']); ?></td>
                            <td><?= number_format($row['quantity']); ?></td>
                            <td><?= number_format($row['total_value'],2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</html>