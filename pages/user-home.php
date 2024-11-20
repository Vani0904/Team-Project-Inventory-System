<?php //include '../includes/check-if-user.php';  <!--This will be required once we have database integration.-->
include '../includes/head.php';
?>

<head>
    <title>Shop</title>
</head>

<script>
function searchAllProducts () 
{
  var data = new FormData(document.getElementById("mySearch"));

  fetch("controller.php", { method:"POST", "body":data })
  .then(res => res.json())
  .then(res => {
    let results = document.getElementById("results");
    results.innerHTML = "";
    if (res !== null) { for (let r of res) {
      results.innerHTML += `<div>${r.id} - ${r.name}</div>`;
    }}
  });
  return false;
}
</script>

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
                    <img src="" alt="product category" width="125px" height="125px">
                    <label>Product Category A (Perfumes?)</label>
                </div>
                <div class="section">
                    <img src="" alt="product category" width="125px" height="125px">
                    <label>Product Category B (Aftershaves?)</label>
                </div>
                <div class="section">
                    <img src="" alt="product category" width="125px" height="125px">
                    <label>Product Category C ???</label>
                </div>
                <div class="section">
                    <img src="" alt="product category" width="125px" height="125px">
                    <label>Product Category D ???</label>
                </div>
            </div>
            <div id="products-grid-container">
                <div class="section">
                <div>
                <p id="mySearch">Stephen</p>   
                </div>
                    <div id="results">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>