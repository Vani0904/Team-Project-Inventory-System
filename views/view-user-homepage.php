<?php
//include '../includes/check-if-user.php';  <!--This will be required once we have database integration.-->
include '../includes/head.php';
$counter = 0;
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
                <?php foreach ($manufacturers as $manufacturer)
                {
                    ?>
                <button><?= $manufacturer['manufacturer'] ?></button>
                <?php
                }
                ?>
            </div>
            <div id="price">
                <strong>By Price</strong>
                <button>£0.00 - £20.00</button>
                <button>£20.00 - £40.00</button>
                <button>£40.00 - £80.00</button>
                <button>£80+</button>
                <p><br>Under: (£)</p>
                <button><input type="range" min="1" max="300" value="100" id="slider-price" oninput="this.nextElementSibling.value = this.value"><output>100</output></button>
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
                <?php
                foreach ($products as $product) 
                {
                    if ($counter < 12) 
                    {
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

<?php //include '../pages/footer.html'; ?>

</html>