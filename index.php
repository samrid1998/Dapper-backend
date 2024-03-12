<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!--NAVIGATION-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
          <img src="img/logo.png">
          <h1><b>Dapper</b></h1>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span><i id="bar" class="fa-solid fa-bars"></i></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              
              <li class="nav-item">
                <a href="account.php"><i class="fa-solid fa-user"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="blog.html">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cart.php">
                  <i class="fa-solid fa-cart-shopping">
                    <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) {?>
                      <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>
                    <?php } ?>
                  </i>
                </a>
              </li>
              
              
             
          </div>
        </div>
      </nav>
      <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span> Best Price</span> This Year</h1>
            <p>Wanna look cool?<br> You're in the<br> right place. </p>
            <a href="shop.php"><button>Shop Now!</button></a>
        </div>
      </section>
      <section id="brand" class="container">
        <div class="row m-0 py-2 " ></div>
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brands/3.webp">
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brands/4.webp">
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brands/5.webp">
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brands/6.webp">
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brands/1.webp">
      </section>
      <section id="new" class="w-100">

        <div class="row p-0 m-0">

        <?php include('server/get_new.php');?>

        <?php while ($row=$new->fetch_assoc()){ ?>

          <div class="one col-lg-4 col-md-12 col-12 p-0" >
            <img class="img-fluid" src="img/clothes/<?php echo $row['product_image'];?>">
            <div class="details">
              <h2><?php echo $row['product_name'];?></h2>
              <a href="<?php echo "sproduct.php?product_id=".$row['product_id']?>"><button class="buy-btn text-uppercase">Buy now</button></a>
            </div>
          </div>
          <?php } ?>

        </div>

      </section>
      <section id="products" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
          <h3>Our products</h3>
          <hr class="mx-auto">
          <p>Check out our latest products and buy at affordable price</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_our_products.php');?>
        
        <?php while ($row=$our_products->fetch_assoc()){ ?>

          <div class="product text-center col-lg-3 col-md-4 col-12">
            <img class="img-fluid mb-3" src="img/clothes/<?php echo $row['product_image'];?>">
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name'];?></h5>
            <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
            <a href="<?php echo "sproduct.php?product_id=".$row['product_id']?>"><button class="buy-btn">Buy Now!</button></a>
          </div>
          <?php }?>
        </div>

      </section>
      <section id="banner" class="my-5 py-5">
        <div class="container">
          <h4>SEASON'S SALE</h4>
          <h1>SUMMER COLLECTION<br>UP TO 25% OFF</h1>
          <a href="shop.php"><button class="text-uppercase">Shop Now!</button></a>
        </div>
      </section>
      <section id="Sweaters" class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3>Sweaters</h3>
          <hr class="mx-auto">
          <p>Sweaters can be cool!</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_sweaters.php');?>

        <?php while ($row=$sweater->fetch_assoc()){ ?>

          <div class="product text-center col-lg-3 col-md-4 col-12">
            <img class="img-fluid mb-3" src="img/clothes/<?php echo $row['product_image'];?>">
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>

            </div>
            <h5 class="p-name"><?php echo $row['product_name'];?></h5>
            <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
            <a href="<?php echo "sproduct.php?product_id=".$row['product_id']?>"><button class="buy-btn">Buy Now!</button></a>

          </div>
          <?php }?>

        </div>

      </section>
      <section id="Hoodies" class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3>Hoodies and Jackets</h3>
          <hr class="mx-auto">
          <p>Hoodies and Jackets for casual look.</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include("server/get_hoodies_jackets.php");?>

        <?php while($row=$hoodies_jackets->fetch_assoc()){?>

          <div class="product text-center col-lg-3 col-md-4 col-12">
            <img class="img-fluid mb-3" src="img/clothes/<?php echo $row['product_image'];?>">
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>

            </div>
            <h5 class="p-name"><?php echo $row['product_name'];?></h5>
            <h4 class="p-price">$<?php echo $row ['product_price'];?></h4>
            <a href="<?php echo "sproduct.php?product_id=".$row['product_id']?>"><button class="buy-btn">Buy Now!</button></a>

          </div>
          <?php }?>
          
          

        </div>

      </section>
      <section id="combination" class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3>Combos</h3>
          <hr class="mx-auto">
          <p>Combinations that you must have in your closet!</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include("server/get_combos.php");?>

        <?php while($row=$combos->fetch_assoc()){?>

          <div class="product text-center col-lg-3 col-md-4 col-12">
            <img class="img-fluid mb-3" src="img/clothes/<?php echo $row['product_image'];?>">
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>

            </div>
            <h5 class="p-name"><?php echo $row['product_name'];?></h5>
            <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
            <a href="<?php echo "sproduct.php?product_id=".$row['product_id']?>"><button class="buy-btn">Buy Now!</button></a>

          </div>
          <?php }?>

        </div>

      </section>
      <footer class="mt-5 py-5">
        <div class="row container mx-auto py-5">
          <div class="footer-one col-lg-4 col-md-6 col-12">
            <img src="img/logo.png">  <h4 class="pt-3">Dapper</h4>
            <p>Dapper is a online website for men's upper body clothes that are classy and trendy. Buy the latest trends at Dapper and look cool.</p>
          </div>
          <div class="footer-one col-lg-4 col-md-6 col-12">
            <h4 class="pb-2">Contact</h4>
            <div>
              <h6 class="text-uppercase">Address</h6>
              <p>Ward21,Lagantole,KTM</p>
            </div>
            <div>
              <h6 class="text-uppercase">Phone</h6>
              <p>9841921351</p>
            </div>
            <div>
              <h6 class="text-uppercase">Email</h6>
              <p>samrid.dangol.sd@gmail.com</p>
            </div>
          </div>
          <div class="footer-one col-lg-4 col-md-6 col-12">
            <h4 class="pb-2">Instagram</h4>
            <div class="row">
              <img class="img-fluid w-25 h-100 m-2" src="img/clothes/9.jpg">
              <img class="img-fluid w-25 h-100 m-2" src="img/clothes/15.jpg">
              <img class="img-fluid w-25 h-100 m-2" src="img/clothes/17.jpg">
            </div>
          </div>
        </div>

        <div class="copyright mt-5"> 
          <div class="row container mx-auto">
            <div class="col-lg-3 col-md-6 col-12 mb-4">
              <img src="img/payment.png">
            </div>
            <div class="col-lg-6 col-md-6 col-12 text-nowrap mb-2">
              <p>Dapper eCommerce © 2024. All Rights Reserved</p>
            </div>
            <div class="col-lg-2 col-md-6 col-12">
              <a href="#"><i class="fa-brands fa-facebook"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
          </div>
        </div>
      </footer> 
      
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
</body>
</html>
