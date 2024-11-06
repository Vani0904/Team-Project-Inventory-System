<?php //include '../includes/check-if-admin.php'; ?> <!--This will be required once we have database integration.-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style/desktop.css"> 
</head>
<body>
    <div class="admin-db-container">
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <nav class="nav-menu">
            <img src="../images/logo_main.png" alt="logo">
            <a href=""><img src="../images/dashboard-icon.png" alt="dashboard icon"></a>
            <a href="admin-analytics.php"><img src="../images/analytics-icon.png" alt="analytics icon"></a>
            <a href="admin-invoices.php"><img src="../images/invoices-icon.png" alt="invoices icon"></a>
        </nav>
        <div class="dashboard-content">
            <header class="header-admin">
                <label for="menu-toggle" class="hamburger-icon">
                    <img src="../images/admin-dashboard-menu-icon-black.png" alt="admin dashboard icon">
                </label>
                <label class="header-admin-details">[First Name]</label>
                <label class="header-admin-details">[Last Name]</label>
                <img class="header-admin-icon" src="" width="50" height="50">
                <img class="header-admin-icon" src="../images/log-out-icon.png" width="50" height="50">
            </header>
            <h1>Inventory Management KPIs</h1>
            <div class="Kpi">
                <div><h2>Inventory Turnover Rate</h2><p>5</p></div>
                <div><h2>Product Sales</h2><p>£7,500</p></div>
                <div><h2>Rate Of Return</h2><p>7%</p></div>
                <div><h2>Average Inventory</h2><p>400 Units</p></div>
            </div>
            <div class="nav-btns">
                <a href="">Generate Report</a>
                <a href="admin-analytics.php">View Analytics</a>
                <a href="">Add Product</a>
            </div>
            <div class="filter-inputs">
                <div>
                    <label for="category"><strong>Item category:</strong></label>
                        <select id="category" name ="category">
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                </div>
                <div id="search-inventory-product">
                    <label for="search-product"><strong>Search for product:</strong></label>
                    <input type="text" id="search-product" placeholder="Search..." name="search-product">
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
                                <a href="" class="delete-item-btn" onclick="return confirm('Are you sure you want to delete this Product?')">Delete</a>
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
                                <a href="" class="delete-item-btn" onclick="return confirm('Are you sure you want to delete this Product?')">Delete</a>
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