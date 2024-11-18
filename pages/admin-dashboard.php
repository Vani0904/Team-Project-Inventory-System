<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->
<?php include "../includes/connectdb.php";?>
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
                <div>
                    <h2>Inventory Turnover Rate</h2>
                    <p>5</p>
                </div>
                <div>
                    <h2>Product Sales</h2>
                    <p>£7,500</p>
                </div>
                <div>
                    <?php
                    ?>
                    <h2>Rate Of Return</h2>
                    <p>7%</p>
                </div>
                <div>
                    <h2>Average Inventory</h2>
                    <p>400 Units</p>
                </div>
            </div>
            <div class="nav-btns">   <!-- Inventory Table section -->
                <a href="">Generate Report</a>
                <a href="admin-analytics.php">View Analytics</a>
                <a href="">Add Product</a>
            </div>
            <div class="filter-inputs">
                <div>
                    <label for="category"><strong>Item category:</strong></label>
                    <select id="category" name="category">
                        <option value="Perfume">Perfume</option>
                        <option value="deodorant">Deodorant </option>
                    </select>
                </div>
                <div id="search-inventory-product">
                    <label for="search-product"><strong>Search for product:</strong></label>
                    <input type="text" id="search-product" placeholder="Search..." name="search-product" aria-label="Search for product">
                </div>
            </div>
            <div class="table-container">
                <table class="inventory-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Branch</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT
                                        product.product_id,
                                        product.name AS product_name,
                                        branches.name AS branch_name,
                                        product.unit_price,
                                        product.category
                                      FROM product
                                      INNER JOIN
                                           branches
                                      ON
                                        product.branch_id = branches.branch_id";
                            $result = mysqli_query($connection,$query);

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
                                        <td data-label="Actions">
                                        <a href="" class="edit-item-btn">Edit</a>
                                        <a href="" class="delete-item-btn"
                                            onclick="return confirm('Are you sure you want to delete this Product?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else{
                                ?>
                                <tr>
                                    <td colspan="7"> No Record Found</td>
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