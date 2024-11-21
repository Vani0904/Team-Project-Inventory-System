<?php
//include '../includes/check-if-user.php';  <!--This will be required once we have database integration.-->
include '../includes/head.php';
?>

<head>
    <title>Shop</title>
</head>

<body>
    <div class="container">
        <div id="navigation-sidebar">
            <div id="breaker">

            </div>
            <div>
                <strong>Filter Results:</strong>
            </div>
            <div id="brand">
                <strong>By Brand</strong>
                <button>Brand 1</button>
                <button>Brand 2</button>
                <button>Brand 3</button>
                <button>Brand 4</button>
            </div>
            <div id="price">
                <strong>By Price</strong>
                <button>Price Bracket 1</button>
                <button>Price Bracket 2</button>
                <button>Price Bracket 3</button>
                <button>Price Bracket 4</button>
            </div>
            <div>
                <button>Clear Filters</button>
            </div>
        </div>
        <div class="segment-margined">
            <?php include '../includes/header-user.php'; ?>
            <div id="products-banner">
                <div class="section">
                    <img src="" alt="perfumes" width="125px" height="125px">
                    <label>Perfumes</label>
                </div>
                <div class="section">
                    <img src="" alt="aftershaves" width="125px" height="125px">
                    <label>Aftershaves</label>
                </div>
            </div>
            <div id="products-grid-container">
                <?php foreach ($products as $product): ?>
                    <div class="section">
                        <img src="data:image/png;base64,<?= base64_encode($product['product_image']) ?>">
                        <p><b><?= $product['manufacturer'] ?></b></p>
                        <p><?= $product['name'] ?></p>
                        <p>£<?= number_format($product['unit_price'], 2) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

<?php include '../pages/footer.html'; ?>

</html>