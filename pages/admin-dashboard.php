
<?php 
        include "../includes/connectdb.php";
        include '../includes/check-if-admin.php';
        
        $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'product_id';
        $sortOrder = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';

        //Sets allowed columns for filtering
        $allowedSortColumns = ['p.name', 'unit_price', 'category', 'quantity', 'product_id'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'product_id';
        }

        $branchFilter = isset($_GET['branch']) ? $_GET['branch'] : '';
        $categoryFilter = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';
        $searchProductFilter = isset($_GET['search-product']) ? $_GET['search-product'] : '';
        
        $branchOptionsQuery = "SELECT branch_id, name FROM branches";
        $branchOptionsResult = mysqli_query($connection, $branchOptionsQuery);

            $query = "SELECT
                        p.product_id,
                        p.name AS product_name,
                        b.name AS branch_name,
                        i.quantity,
                        p.unit_price,
                        p.category
                    FROM products p
                    INNER JOIN inventory_items i ON p.product_id = i.product_id
                    INNER JOIN branches b ON i.branch_id = b.branch_id
                    WHERE 1 = 1 ";

            $bindParams = [];

            //using Prepared statements
            if (!empty($categoryFilter)) {
                $query .= " AND p.category = ? ";
                $bindParams[] = $categoryFilter;
            }
            
            if (!empty($searchProductFilter)) {
                $query .= " AND p.name LIKE ? ";
                $bindParams[] = "%$searchProductFilter%";
            }

            if (!empty($branchFilter)) {
                $query .= " AND i.branch_id = ? ";
                $bindParams[] = $branchFilter;

            }

            $query .= " ORDER BY $sortColumn $sortOrder";

            $stmt = mysqli_prepare($connection, $query);

            if ($stmt) {
                if ($bindParams) {
                    $types = str_repeat('s', count($bindParams));
                    mysqli_stmt_bind_param($stmt, $types, ...$bindParams);
                }
            
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            } else {
                die("Error preparing statement: " . mysqli_error($connection));
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/desktop.css">
    <!------popping font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
</head>
<body>
    <div class="admin-db-container">
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <?php include '../includes/nav-menu.php'; ?>
        <div class="dashboard-content">
            <?php include '../includes/header-admin.php'; ?>  <!-- Inventory KPI section -->
            <h1>Inventory Management KPIs</h1>
            <div class="Kpi">
                <div title="The overall total value of the products stored">
                    <h2>Total Inventory Value</h2>
                    <?php
                        $TotalValQuery = "SELECT SUM(i.quantity * p.unit_price) AS total_inventory_value
                                           FROM inventory_items i
                                           INNER JOIN products p ON i.product_id = p.product_id;";

                        $stmt = mysqli_prepare($connection, $TotalValQuery);
                        mysqli_stmt_execute($stmt);
                        $TotalValResult = mysqli_stmt_get_result($stmt);

                        if ($TotalValResult && mysqli_num_rows($TotalValResult) > 0) {
                            $row = mysqli_fetch_assoc($TotalValResult);
                            echo "<p>£". number_format($row['total_inventory_value'], 2) . "</p>";
                        } else {
                            echo "<p>No Products available.</p>";
                        }
                    ?>
                </div>
                <div title="Displays products with the lowest stock">
                    <h2>Lowest Stock Product</h2>
                    <?php
                        $lowStockQuery = "SELECT p.name AS product_name, SUM(i.quantity) AS total_quantity
                        FROM inventory_items i
                        INNER JOIN products p ON i.product_id = p.product_id
                        GROUP BY i.product_id
                        ORDER BY total_quantity ASC
                        LIMIT 1;";

                        $stmt = mysqli_prepare($connection, $lowStockQuery);
                        mysqli_stmt_execute($stmt);
                        $lowStockResult = mysqli_stmt_get_result($stmt);

                    if ($lowStockResult && mysqli_num_rows($lowStockResult) > 0) {
                        $row = mysqli_fetch_assoc($lowStockResult);
                        echo "<span>" .htmlspecialchars($row['product_name']) . "</span>";
                        echo "<p>". intval($row['total_quantity']) . " units</p>";
                    } else {
                        echo "<p>No Products available.</p>";
                    }
                    ?>
                </div>
                <div title="Displays products with the highest stock">
                    <?php
                    ?>
                    <h2>Highest Stock Product</h2>
                    <?php
                        $highStockQuery = "SELECT p.name AS product_name, SUM(i.quantity) AS total_quantity
                                  FROM inventory_items i
                                  INNER JOIN products p ON i.product_id = p.product_id
                                  GROUP BY i.product_id
                                  ORDER BY total_quantity DESC
                                  LIMIT 1;
                                  ";
                        $stmt = mysqli_prepare($connection, $highStockQuery);
                        mysqli_stmt_execute($stmt);
                        $highStockResult = mysqli_stmt_get_result($stmt);

                        if ($highStockResult && mysqli_num_rows($highStockResult) > 0) {
                            $row = mysqli_fetch_assoc($highStockResult);
                            echo "<span>" .htmlspecialchars($row['product_name']) . "</span>";
                            echo "<p>". intval($row['total_quantity']) . " units</p>";
                        } else {
                            echo "<p>No Products available.</p>";
                        }
                    ?>
                </div>
                <div title="Displays the branch with the highest amount of stock">
                    <h2>Top Branch By Stock</h2>
                    <?php
                        $topBranchQuery = "SELECT b.name AS branch_name, SUM(i.quantity) AS total_stock
                                  FROM inventory_items i
                                  INNER JOIN branches b ON i.branch_id = b.branch_id
                                  GROUP BY i.branch_id
                                  ORDER BY total_stock DESC
                                  LIMIT 1;
                                  ";
                        $stmt = mysqli_prepare($connection, $topBranchQuery);
                        mysqli_stmt_execute($stmt);
                        $topBranchResult = mysqli_stmt_get_result($stmt);


                        if ($topBranchResult && mysqli_num_rows($topBranchResult) > 0) {
                            $row = mysqli_fetch_assoc($topBranchResult);
                            echo "<p>" . htmlspecialchars($row['branch_name']).": " . intval($row['total_stock']) . "</p>";
                        } else {
                            echo "<p>No Products available.</p>";
                        }
                    ?>
                </div>
            </div>
            <div class="nav-btns">   <!-- Inventory Table section -->
                <a href="stock-report.php">Generate Report</a>
                <a href="admin-analytics.php">View Analytics</a>
                <a href="admin-dashboard-product-form.php">Create Product</a>
            </div>
            <div class="filter-inputs">
                <form method="GET" action="admin-dashboard.php">
                    <div class="filter-inputs-section">
                        <label for="category"><strong>Item category:</strong></label>
                        <select id="category" name="category"> <!-- Dropdown menu for categories of product-->
                            <option value="">All</option>
                            <option value="Perfume"><?= (isset($_GET['category']) && $_GET['category'] == 'Perfume') ? 'selected ': '';?>Perfume</option>
                            <option value="Aftershave"><?= (isset($_GET['category']) && $_GET['category'] == 'Aftershave') ? 'selected ': '';?>Aftershave</option>
                            ?>
                        </select>

                        <label for="branch"><strong>Branch:</strong></label>
                        <select id="branch" name="branch"> <!-- Dropdown menu for categories of product-->
                            <option value="" <?= !isset($_GET['branch']) ? 'selected' : ''; ?>>All Branches</option>
                            <?php while ($branch = mysqli_fetch_assoc($branchOptionsResult)): ?>
                                <option value="<?= $branch['branch_id']; ?>"
                                    <?= (isset($_GET['branch']) && $_GET['branch'] == $branch['branch_id']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($branch['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <button type="submit">Apply filter</button>
                        <a href="admin-dashboard.php">Clear filter</a>
                    </div>
                </form>
                <form method="GET" action="admin-dashboard.php">
                    <div id="search-inventory-product">
                        <label for="search-product"><strong>Search for product:</strong></label>
                        <input type="text" id="search-product" placeholder="Search..." name="search-product" aria-label="Search for product" value="<?= isset($_GET['search-product']) ? htmlspecialchars($_GET['search-product']) : ''; ?>">
                        <button type="submit"><img src="../images/icon-search.png" alt="search icon"></button>
                    </div>
                </form>
            </div>
            <div class="table-container">
                <table class="inventory-table">
                    <thead>
                        <tr>
                            <th><a href="?sort=product_id&order=<?php echo ($sortColumn == 'product_id' && $sortOrder == 'ASC') ? 'desc' : 'asc';?>">
                                ID
                                <?php if ($sortColumn == 'product_id'): ?>
                                    <?= $sortOrder == 'ASC' ? '▲' : '▼'; ?>
                                <?php else: ?>
                                    ⇅
                                <?php endif; ?>
                            
                            </th>
                            <th><a href="?sort=p.name&order=<?php echo ($sortColumn == 'p.name' && $sortOrder == 'ASC') ? 'desc' : 'asc';?>">
                                Name
                                <?php if ($sortColumn == 'p.name'): ?>
                                    <?= $sortOrder == 'ASC' ? '▲' : '▼'; ?>
                                <?php else: ?>
                                    ⇅
                                <?php endif; ?>
                            
                            </th>
                            <th>Branch</th>
                            <th><a href="?sort=unit_price&order=<?= ($sortColumn == 'unit_price' && $sortOrder == 'ASC') ? 'desc' : 'asc';?>">
                                Price
                                <?php if ($sortColumn == 'unit_price'): ?>
                                    <?= $sortOrder == 'ASC' ? '▲' : '▼'; ?>
                                <?php else: ?>
                                    ⇅
                                <?php endif; ?>
                            
                            </th>
                            <th>Category</th>
                            <th><a href="?sort=quantity&order=<?= ($sortColumn == 'quantity' && $sortOrder == 'ASC') ? 'desc' : 'asc';?>">
                                Quantity
                                <?php if ($sortColumn == 'quantity'): ?>
                                    <?= $sortOrder == 'ASC' ? '▲' : '▼'; ?>
                                <?php else: ?>
                                    ⇅
                                <?php endif; ?>
                            
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (mysqli_num_rows($result) > 0)
                            {
                                while ($productColumn = mysqli_fetch_assoc($result))
                                {
                                    ?>
                                    <tr>
                                        <td data-label="ID"><?= $productColumn['product_id']; ?></td>
                                        <td data-label="Name"><?= htmlspecialchars($productColumn['product_name']); ?></td>
                                        <td data-label="Branch"><?= htmlspecialchars($productColumn['branch_name']); ?></td>
                                        <td data-label="Price">£<?= number_format($productColumn['unit_price'],2); ?></td>
                                        <td data-label="Category"><?= htmlspecialchars($productColumn['category']); ?></td>
                                        <td data-label="Quantity"><?= intval($productColumn['quantity']); ?></td>
                                        <td data-label="Actions">
                                        <a href="admin-dashboard-product-form.php?product-id=<?= $productColumn['product_id']; ?>" class="edit-item-btn">Edit</a>
                                        <a href="admin-dashboard-delete-product.php?action=delete&product-id=<?= $productColumn['product_id']; ?>" class="delete-item-btn"
                                            onclick="return confirm('Are you sure you want to delete this Product?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else{
                                ?>
                                <tr>
                                    <td colspan="7"> No Products Found</td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>


