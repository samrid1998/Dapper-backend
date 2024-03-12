<?php

session_start();

include('../server/connection.php');

if(isset($_SESSION['admin_logged_in'])){
  header('location: index.php');
}

if(isset($_POST['login_btn'])){

  $email = $_POST['email'];
  $password = ($_POST['password']);

  $stmt = $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  $stmt->execute();

  if($stmt->execute()){
      $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
      $stmt->store_result();


      if($stmt->num_rows() == 1){
        $stmt->fetch();

        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['admin_name'] = $admin_name;
        $_SESSION['admin_email'] = $admin_email;
        $_SESSION['admin_logged_in'] = true;

        header('location: index.php?login_success=logged in successfully');

      }else{
        header('location: login.php?error=could not verify your account'); 
      }

  }else{
    //error
    header('location: login.php?error=something went wrong');
  }



}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!--NAVIGATION-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
          <img src="../img/logo.png">
          <h1><b>Dapper</b></h1>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span><i id="bar" class="fa-solid fa-bars"></i></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a href="account.php"><i class="fa-solid fa-user nav-link active"></i></a>
                </li>
              </div>
        </div>
      </nav>

      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="login-form" method="POST" action="login.php">
              <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="email" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="password" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
                </div>
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
