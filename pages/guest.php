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
      </nav>
      <!----nav -end -->

      <!-------btn -->
      <div class="g-icon">
        <!---------login-->
        <a href="register.php" class="nav-user">
          <i class="fa-regular fa-user" style="color: #b197fc"></i>
        </a>
      </div>
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
            <li class="active" data-filter="mix">Mix</li>
            <li data-filter="women">women</li>
            <li data-filter="men">Men</li>
        </ul>

      </div>
 <!-----------product grid --------->
 <div class="our-product-container ">
<!-----box1-->
       <div class="our-product-box women">
        <a href="#" class="our-product-img"></a>
        <img src="../images/1.jpg" alt="dior">
        <!----text-->
        <div class="our-product-text">
          <a href="=" class="our-product-title">Miss Dior</a>
          <span>£72</span>
        </div>

       </div>


       <!-----box2-->
       <div class="our-product-box  men">
        <a href="#" class="our-product-img"></a>
        <img src="../images/5.jpeg" alt="dior">
        <!----text-->
        <div class="our-product-text">
          <a href="=" class="our-product-title">Miss Dior</a>
          <span>£72</span>
        </div>

       </div>


       <!-----box3-->
       <div class="our-product-box  women">
        <a href="#" class="our-product-img"></a>
        <img src="../images/2.jpg" alt="dior">
        <!----text-->
        <div class="our-product-text">
          <a href="=" class="our-product-title">Miss Dior</a>
          <span>£72</span>
        </div>

       </div>

       <!-----box4-->
       <div class="our-product-box men">
        <a href="#" class="our-product-img"></a>
        <img src="../images/6.jpg" alt="dior">
        <!----text-->
        <div class="our-product-text">
          <a href="=" class="our-product-title">Miss Dior</a>
          <span>£72</span>
        </div>

       </div>


         <!-----box5-->
         <div class="our-product-box women">
          <a href="#" class="our-product-img"></a>
          <img src="../images/3.jpg" alt="dior">
          <!----text-->
          <div class="our-product-text">
            <a href="=" class="our-product-title">Miss Dior</a>
            <span>£72</span>
          </div>
  
         </div>

           <!-----box6-->
       <div class="our-product-box men">
        <a href="#" class="our-product-img"></a>
        <img src="../images/7.jpeg" alt="dior">
        <!----text-->
        <div class="our-product-text">
          <a href="=" class="our-product-title">Miss Dior</a>
          <span>£72</span>
        </div>

       </div>


         <!-----box7-->
         <div class="our-product-box women">
          <a href="#" class="our-product-img"></a>
          <img src="../images/4.jpg" alt="dior">
          <!----text-->
          <div class="our-product-text">
            <a href="=" class="our-product-title">Miss Dior</a>
            <span>£72</span>
          </div>
  
         </div>

           <!-----box8-->
       <div class="our-product-box  men">
        <a href="#" class="our-product-img"></a>
        <img src="../images/8.jpeg" alt="dior">
        <!----text-->
        <div class="our-product-text">
          <a href="=" class="our-product-title">Miss Dior</a>
          <span>£72</span>
        </div>

       </div>
 </div>
    </section>

    <!-----Jquery------>
    <script src="../scripts/jquery-3.7.1.js"></script>
    <script src="../scripts/footer.js"></script>
<!-------------script- for- filtering active link-------->
<script>
  var selector = '.our-p-products li';

  $(selector).on('click', function(){
      $(selector).removeClass('active')
      $(this).addClass('active')
  });

  /*---box filter */
  $(document).ready(function (){
    $('.our-p-products li').click(function(){
      const value = $(this).attr('data-filter');
      if(value == 'mix'){
        $('.our-product-box').show('1000');
      }
      else{
        $('.our-product-box').not('.'+value).hide('1000');
        $('.our-product-box').filter('.'+value).show('1000');
      }
    });

  });
</script>
  
  </body>
</html>
