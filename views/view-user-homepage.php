<?php
//include '../includes/check-if-user.php';  <!--This will be required once we have database integration.-->
include '../includes/head.php';
$counter = 0;

//echo count($products);

?>

<head>
    <title>Shop</title>
</head>

<body>
    <div class="container">
        <div id="navigation-sidebar">
            <form method="GET" action="user-homepage.php" id="product-filtering">
                <label>Brand:</label>
                <?php foreach ($manufacturers as $manufacturer)
                {
                    ?>
                    <button type="submit" name="brand" value="<?= $manufacturer['manufacturer'] ?>"><?= $manufacturer['manufacturer'] ?></button>
                    <?php
                }
                ?>

                <label>Price Range (£):</label>
                <input type="range" min="1" max="300" id="slider-price-min" name="price-min" oninput="this.nextElementSibling.value = this.value" value="<?= $_GET['price-min'] ?? '0' ?>"><output><?= $_GET['price-min'] ?? '0' ?></output>
                <input type="range" min="1" max="300" id="slider-price-max" name="price-max" oninput="this.nextElementSibling.value = this.value" value="<?= $_GET['price-max'] ?? '300' ?>"><output><?= $_GET['price-max'] ?? '300' ?></output>

                <button type="submit">Apply Price Filter</button>
            </form>
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
                <?php
                foreach ($products as $product) 
                {
                    if ($counter < 12) {
                        $counter++;
                        ?>
                        <div class="section">
                            <img src="data:image/png;base64,<?= base64_encode($product['product_image']) ?>">
                            <p><b><?= $product['manufacturer'] ?></b></p>
                            <p><?= $product['name'] ?></p>
                            <p>£<?= number_format($product['unit_price'], 2) ?></p>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

<?php include '../pages/footer.html'; ?>

</html>