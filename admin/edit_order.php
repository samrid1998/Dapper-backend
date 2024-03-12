<?php 
include('../server/connection.php');

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();
        
    $order = $stmt->get_result();
}else if(isset($_POST['edit_order_btn'])){

    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];
    
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id = ?");
    $stmt->bind_param('si',$order_status,$order_id);

    if($stmt->execute()){
        header('location: index.php?order_updated=Order has been updated successfully');
    }else{
        header('location: index.php?order_updated_failure=Error occured. Try Again.');
    }

}else{
    header('location:index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #edit-order{
            padding-top:  120px;
        }

    </style>
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
                <a href="account.php"><i class="fa-solid fa-user"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="index.php">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="products.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="add_new_product.php">Add New Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php?logout=1">Log Out</a>
              </li>
              
              
             
          </div>
        </div>
      </nav>

      <section id="edit-order" class="container">
        <h1>Edit Order</h1>
        <hr>
        <div class="mx-auto container">
            <form id="edit-order-form" method="POST" action="edit_order.php">
                
                <?php foreach($order as $r){ ?>

                <p style="color:red;"><?php if (isset($_GET['error'])){echo $_GET['error'];}?></p>
                <div class="form-group mt-2">
                    <label>Order Id :</label>
                    <p><?php echo $r['order_id'];?></p>
                </div>
                <div class="form-group mt-2">
                    <label> Order Cost :</label>
                    <p><?php echo $r['order_cost'];?></p>
                </div>

                <input type="hidden" name="order_id" value="<?php echo $r['order_id'];?>"/>

                <div class="form-group mt-2">
                    <label>Order Status :</label>
                    <select class="form-select" required name="order_status">
                        <option value="not paid" <?php if($r['order_status']=='not paid'){echo "selected";}?> >Not Paid</option>
                        <option value="paid" <?php if($r['order_status']=='paid'){echo "selected";}?> >Paid</option>
                        <option value="shipped" <?php if($r['order_status']=='shipped'){echo "selected";}?> >Shipped</option>
                        <option value="delivered" <?php if($r['order_status']=='delivered'){echo "selected";}?> >Delivered</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label>Order date :</label>
                    <p><?php echo $r['order_date'];?></p>
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary" id="edit-order-btn" name="edit_order_btn" value="Edit"/>
                </div>
                <?php }?>
            </form>
        </div>





        
      <footer class="mt-5 py-5">
        <div class="row container mx-auto py-5">
          <div class="footer-one col-lg-4 col-md-6 col-12">
            <img src="../img/logo.png">  <h4 class="pt-3">Dapper</h4>
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
              <img class="img-fluid w-25 h-100 m-2" src="../img/clothes/9.jpg">
              <img class="img-fluid w-25 h-100 m-2" src="../img/clothes/15.jpg">
              <img class="img-fluid w-25 h-100 m-2" src="../img/clothes/17.jpg">
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
