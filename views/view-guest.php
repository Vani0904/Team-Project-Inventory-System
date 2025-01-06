<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guest</title>
    <!---=-----------css ---->
    <link rel="stylesheet" href="../styles/desktop.css" />

    <!---------fontAwesome - for icons-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <!------popping font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <header class="guest">

    <button id="theme-switch">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>
      </button>
      <!-----------navigation ------->
      <nav class="g-nav">
        <!----logo------->
        <a href="#" class="logo">
          <img src="../images/logo.png" />
        </a>
        <!-----------search ------->
        <form class="g-search-box">
          <input type="text" placeholder="Search Items Here" />
          <button>
            <i class="fa-solid fa-magnifying-glass" style="color: #b197fc"></i>
          </button>
        </form>

         <!-------btn -->
      <div class="g-icon">
        <!---------login-->
        <a href="register.php" class="nav-user">
          <i class="fa-regular fa-user" style="color: #b197fc"></i>
        </a>
      </div>
      </nav>
      <!----nav -end -->

     
    </header>

    <!------------home pic--------------->
    <section class="home">
      <div class="g-content">
        <h3>Senteur Elégant</h3>
        <span>natural & refreshing fragrance</span>
        <p>
          Senteur Elegant is your local,full-line boutique featuring fine
          perfumes, men's colognes and more.
        </p>
      </div>
    </section>

    <!-----------product title --------->
    <section id="our-products">
      <!-----***** heading------->
      <div class="our-p-products">
        <h3>Our Products</h3>
        <!------filter---->
        <ul>
            <li class="<?= ($_GET['filter'] ?? 'mix') === 'mix' ? 'active' : '' ?>" data-filter="mix">Mix</li>
            <li class="<?= ($_GET['filter'] ?? '') === 'women' ? 'active' : '' ?>" data-filter="women">Women</li>
            <li class="<?= ($_GET['filter'] ?? '') === 'men' ? 'active' : '' ?>" data-filter="men">Men</li>
        </ul>
    </div>

    <div class="our-product-container">
        <?php foreach ($products as $product): ?>
            <div class="our-product-box">
            <img src="data:image/png;base64,<?= base64_encode($product['product_image']) ?>">
                <div class="our-product-text">
                <p><b><?= $product['manufacturer'] ?></b></p>
                            <p><?= $product['name'] ?></p>
                            <p>£<?= number_format($product['unit_price'], 2) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>


  </body>
  <?php include '../pages/footer.html'; ?>
 <!-----Jquery----->
<script src="../scripts/jquery-3.7.1.js"></script>
<script src="../scripts/darkmode.js"></script>
<script src="../scripts/guest-filtering.js"></script>

</html>
