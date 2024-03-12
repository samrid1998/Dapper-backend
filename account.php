<?php
session_start();
include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
}
if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
  }
}

if(isset($_POST['change_password'])){

  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $user_email = $_SESSION['user_email'];

  //check if passwords match or not
  if($password !== $confirmPassword){
    header('location: account.php?error=passwords do not match');
  }

  //check if the password is too small i.e atleast 6 characters
  else if(strlen($password)<6){
    header('location: account.php?error=password must be atleast 6 characters');
  
  //no error
  }else{
    $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
    $stmt->bind_param('ss',md5($password),$user_email);

    if($stmt->execute()){
      header('location: account.php?message=password has been updated successfully');
    }else{
      header('location: account.php?error=could not update password');
    }
  }
}
//get_orders
if(isset($_SESSION['logged_in'])){

  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT * from orders where user_id = ? ");

  $stmt->bind_param('i',$user_id);

  $stmt->execute();

  $orders = $stmt->get_result();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
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
              <a href="account.php"><i class="fa-solid fa-user nav-link active"></i></a>
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
              <a class="nav-link" href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i></a>
            </li>
            
            
           
        </div>
      </div>
    </nav>
    
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-12">
            <p class="text-center" style="color:green"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; }?></p>
            <p class="text-center" style="color:green"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; }?></p>
                <h5>Account-info</h5>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name: <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; } ?></span></p>
                    <p>Email: <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email']; } ?></span></p>
                    <p><a href="#order-container" id="order-btn">Your Orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Log-out</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <form id="account-form" method="POST" action="account.php">
                  <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                  <p class="text-center" style="color:green"><?php if(isset($_GET['message'])){ echo $_GET['message']; }?></p>
                    <h5>Change Password</h5>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required/>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Password" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn"/>
                    </div>
                </form>
            </div>
         </div>

    </section>

    <section id="order-container" class="order container my-5 py-3">
      <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="mx-auto">
      </div>

      <table  class="mt-5 pt-5" width="100%">
        <tr>
          <th>Order id</th>
          <th>Order cost</th>
          <th>Order status</th>
          <th>Order date</th>
          <th>Order details</th>
        </tr>

        <?php while($row = $orders->fetch_assoc()){?>
        <tr>
          <td>
            <span><?php echo $row['order_id']; ?></span>
          </td>
          <td>
            <span><?php echo $row['order_cost']; ?></span>
          </td>
          <td>
            <span><?php echo $row['order_status']; ?></span>
          </td>
          <td>
            <span><?php echo $row['order_date']; ?></span>
          </td>
          <td>
            <form method="POST" action="order_details.php">
              <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status"/>
              <input type="hidden" value="<?php echo $row['order_id']?>" name="order_id"/>
              <input class="btn order-details-btn" name="order_details_btn" type="submit" value="details"/>
            </form>
          </td>
        </tr>
        <?php } ?>
        </table>
        
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
