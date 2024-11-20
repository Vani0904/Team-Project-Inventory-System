<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->
<?php include "../includes/connectdb.php";
        $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'product_id';
        $sortOrder = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';
        
        $categoryFilter = isset($_GET['category']) ? mysqli_escape_string($connection, $_GET['category']) : '';
        $searchProductFilter = isset($_GET['search-product']) ? mysqli_escape_string($connection, $_GET['search-product']) : '';
        
        //Sets allowed columns for filtering
        $allowedSortColumns = ['product.name', 'unit_price', 'category', 'quantity'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'product_id';
        }
            
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
                    WHERE ('$categoryFilter' = '' OR p.category = '$categoryFilter')
                    AND ('$searchProductFilter' = '' OR p.name LIKE '%$searchProductFilter%')
                    ORDER BY $sortColumn $sortOrder";
            $result = mysqli_query($connection,$query);
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
                <div title="click to sort by ID">
                    <h2>Inventory Turnover Rate</h2>
                    <p>5</p>
                </div>
                <div title="click to sort by ID">
                    <h2>Product Sales</h2>
                    <p>£7,500</p>
                </div>
                <div title="click to sort by ID">
                    <?php
                    ?>
                    <h2>Rate Of Return</h2>
                    <p>7%</p>
                </div>
                <div title="click to sort by ID">
                    <h2>Average Inventory</h2>
                    <p>400 Units</p>
                </div>
            </div>
            <div class="nav-btns">   <!-- Inventory Table section -->
                <a href="">Generate Report</a>
                <a href="admin-analytics.php">View Analytics</a>
                <a href="admin-dashboard-product-form.php">Create Product</a>
            </div>
            <div class="filter-inputs">
                <form method="GET" action="admin-dashboard.php">
                    <div>
                        <label for="category"><strong>Item category:</strong></label>
                        <select id="category" name="category"> <!-- Dropdown menu for categories of product-->
                            <option value="">All</option>
                            <option value="Perfume"><?= (isset($_GET['category']) && $_GET['category'] == 'Perfume') ? 'selected': '';?>Perfume</option>
                            <option value="deodorant"><?= (isset($_GET['category']) && $_GET['category'] == 'Deodorant') ? 'selected': '';?>Deodorant</option>
                            ?>
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
                            <th><a href="?sort=product.name&order=<?php echo ($sortColumn == 'product.name' && $sortOrder == 'ASC') ? 'desc' : 'asc';?>">
                                Name
                                <?php if ($sortColumn == 'product.name'): ?>
                                    <?= $sortOrder == 'ASC' ? '▲' : '▼'; ?>
                                <?php else: ?>
                                    ⇅
                                <?php endif; ?>
                            
                            </th>
                            <th>Branch</th>
                            <th><a href="?sort=unit_price&order=<?php echo ($sortColumn == 'unit_price' && $sortOrder == 'ASC') ? 'desc' : 'asc';?>">
                                Price
                                <?php if ($sortColumn == 'unit_price'): ?>
                                    <?= $sortOrder == 'ASC' ? '▲' : '▼'; ?>
                                <?php else: ?>
                                    ⇅
                                <?php endif; ?>
                            
                            </th>
                            <th>Category</th>
                            <th><a href="?sort=quantity&order=<?php echo ($sortColumn == 'quantity' && $sortOrder == 'ASC') ? 'desc' : 'asc';?>">
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
                                        <td data-label="ID"><?php echo $productColumn['product_id']; ?></td>
                                        <td data-label="Name"><?php echo $productColumn['product_name']; ?></td>
                                        <td data-label="Branch"><?php echo $productColumn['branch_name']; ?></td>
                                        <td data-label="Price">£<?php echo $productColumn['unit_price']; ?></td>
                                        <td data-label="Category"><?php echo $productColumn['category']; ?></td>
                                        <td data-label="Quantity"><?php echo $productColumn['quantity']; ?></td>
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


