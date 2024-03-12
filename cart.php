<?php
session_start();
if(isset($_POST['add_to_cart'])){
  if(isset($_SESSION['cart2'])){
      $products_array_ids = array_column($_SESSION['cart2'],"product_id");
      if(!in_array($_POST['product_id'],$products_array_ids)){
        $product_id=$_POST['product_id'];

          $product_array = array(
            'product_id'=> $_POST['product_id'],
            'product_name'=> $_POST['product_name'],
            'product_price'=> $_POST['product_price'],
            'product_image'=> $_POST['product_image'],
            'product_quantity'=> $_POST['product_quantity']
        );
        
        $_SESSION['cart2'][$product_id] = $product_array;


      }else{
          echo'<script>alert("Product was already added");</script>';
      }

  }else{
      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];

      $product_array = array(
                      'product_id'=> $product_id,
                      'product_name'=> $product_name,
                      'product_price'=> $product_price,
                      'product_image'=> $product_image,
                      'product_quantity'=> $product_quantity
      );
      $_SESSION['cart2'][$product_id] = $product_array;
  }

//update total
calculateTotalCart();



//remove product from the cart
}else if (isset($_POST['remove_product'])){

  $product_id = $_POST['product_id'];
  unset($_SESSION['cart2'][$product_id]);

  //calculate total
  calculateTotalCart();

}else if( isset($_POST['edit_quantity'])){
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = $_SESSION['cart2'][$product_id];

    $product_array['product_quantity'] = $product_quantity;

    $_SESSION['cart2'][$product_id] = $product_array;
  
//calculate total
  calculateTotalCart();

}else{
  //header('location:index.php');
}

function calculateTotalCart(){
  $total_price = 0;
  $total_quantity = 0;
  foreach($_SESSION['cart2'] as $key => $value){
    $product = $_SESSION['cart2'][$key];

    $price = $product['product_price'];
    $quantity = $product['product_quantity'];

    $total_price = $total_price + ($price * $quantity);
    $total_quantity = $total_quantity + $quantity;
  }

  $_SESSION['total'] = $total_price;
  $_SESSION['quantity'] = $total_quantity;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
              <a class="nav-link" href="index.php">Home</a>
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
              <a class="nav-link active" href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i></a>
            </li>
            
            
           
        </div>
      </div>
    </nav>
    <section class="cart container my-5 py-5">
      <div class="container mt-5">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr>
      </div>

      <table class="mt-5 pt-5">
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Sub Total</th>
        </tr>

        <?php if(isset($_SESSION['cart2'])){?>

          <?php foreach($_SESSION['cart2'] as $key => $value){?>

          <tr>
            <td>
              <div class="product-info">
                  <img src="img/clothes/<?php echo $value['product_image'];?>"/>
                  <div>
                    <p><?php echo $value['product_name'];?></p>
                    <smail><span>$</span><?php echo $value['product_price'];?></smail>
                    <br>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                        <input type="submit" name="remove_product" value="remove" class="remove-btn" href=""/>
                    </form>
                    
                  </div>
              </div>
            </td>
            <td>
              <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                  <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'];?>"/>
                  <input type="submit" class="edit-btn" value="edit" name="edit_quantity"/>
              </form>
            </td>
            
            <td>
              <span>$</span>
              <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price'];?></span>
            </td>
          </tr>
          <?php } ?>
        <?php }?>
      </table>
      <div class="cart-total">
      <table>
        <div>
          <tr>
            <td>Total</td>
            <?php if(isset($_SESSION['cart2'])){?>
              <td>$<?php echo $_SESSION['total']?></td>
            <?php }?>
          </tr>
        </div>
      </table>
      </div>
      <div class="checkout-container">
        <form method="POST" action="checkout.php">
          <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout"/>
        </form>
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