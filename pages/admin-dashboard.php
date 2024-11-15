<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/desktop.css">
</head>

<body>
    <div class="admin-db-container">
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <?php include '../includes/nav-menu.php'; ?>
        <div class="dashboard-content">
            <?php include '../includes/header-admin.php'; ?>
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
                    <h2>Rate Of Return</h2>
                    <p>7%</p>
                </div>
                <div>
                    <h2>Average Inventory</h2>
                    <p>400 Units</p>
                </div>
            </div>
            <div class="nav-btns">
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
                        <option value="Saint Laurent">Saint Laurent</option>
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
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="ID">1</td>
                            <td data-label="Name">Perfume</td>
                            <td data-label="Branch">Sheffield</td>
                            <td data-label="Price">£49.99</td>
                            <td data-label="Quantity">8</td>
                            <td data-label="Category">Dior</td>
                            <td data-label="Actions">
                                <a href="" class="edit-item-btn">Edit</a>
                                <a href="" class="delete-item-btn"
                                    onclick="return confirm('Are you sure you want to delete this Product?')">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="ID">2</td>
                            <td data-label="Name">Deodrant</td>
                            <td data-label="Branch">Leeds</td>
                            <td data-label="Price">£19.99</td>
                            <td data-label="Quantity">5</td>
                            <td data-label="Category">Dior</td>
                            <td data-label="Actions">
                                <a href="" class="edit-item-btn">Edit</a>
                                <a href="" class="delete-item-btn"
                                    onclick="return confirm('Are you sure you want to delete this Product?')">Delete</a>
                            </td>
                        </tr>
                        <!-- <tr>
                        <td colspan="7"> No Record Found</td>
                    </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>