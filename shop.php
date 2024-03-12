<?php

include("server/connection.php");

if(isset($_POST['search'])){
  //1. determine the page no.
  if(isset($_GET['page_no']) && $_GET['page_no'] != "") {
    //if the user has already entered the page then page number is the one that they selected
    $page_no = $_GET['page_no'];
  }else{
    //if the user just came or entered the page, the default page is 1
    $page_no = 1;
  }

  $category = $_POST['category'];
  $price = $_POST['price'];

  //2. returns the number of products
  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category =? AND product_price<=?");
  $stmt1->bind_param('si',$category,$price);
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  $stmt = $conn->prepare("SELECT * from products WHERE product_category = ? AND product_price <= ?");

  $stmt->bind_param('si',$category,$price);

  $stmt->execute();

  $products = $stmt->get_result();

  //3. set the number of products you want to display in each page
  $total_records_per_page = 8;

  $offset = ($page_no-1) * $total_records_per_page;

  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;

  $adjacents = "2";

  $total_number_of_pages = ceil($total_records/$total_records_per_page);

  //4. get all products
  $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset,$total_records_per_page");
  $stmt2->bind_param('si',$category,$price);
  $stmt2->execute();
  $products = $stmt2->get_result();

}else{

  //1. determine the page no.
  if(isset($_GET['page_no']) && $_GET['page_no'] != "") {
    //if the user has already entered the page then page number is the one that they selected
    $page_no = $_GET['page_no'];
  }else{
    //if the user just came or entered the page, the default page is 1
    $page_no = 1;
  }

  //2. returns the number of products
  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  //3. set the number of products you want to display in each page
  $total_records_per_page = 8;

  $offset = ($page_no-1) * $total_records_per_page;

  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;

  $adjacents = "2";

  $total_number_of_pages = ceil($total_records/$total_records_per_page);

  //4. get all products
  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
  $stmt2->execute();
  $products = $stmt2->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">
    <style>
        .product img{
            width: 100%;
            height: auto;
            box-sizing: border-box;
            object-fit: cover;
        }
        .pagination a{
          color: coral;
        }
        .pagination li:hover a{
          color: #fff;
          background-color: coral;
        }

    </style>


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
                <a class="nav-link active" href="shop.php">Shop</a>
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

      <section id="search" class="my-5 py-3 ms-2">
        <div class="container mt-5 py-5">
          <p>Search Products</p>
          <hr>
        </div>

        <form action="shop.php" method="POST">
        <div class="row mx-auto container">
          <div class="col-lg-12 col-md-12 col-12">
            <p>Category</p>
            <div class="form-check">
              <input class="form-check-input" value="Jacket" type="radio" name="category" id="category-one" <?php if(isset($category) && $category=='Jacket'){echo 'checked';}?>>
              <label class="form-check-label" for="flexRadioDefault1">
                Jackets
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" value="Sweater" type="radio" name="category" id="category-one" <?php if(isset($category) && $category=='Sweater'){echo 'checked';}?>>
              <label class="form-check-label" for="flexRadioDefault2">
                Sweaters
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" value="Hoodies and Jackets" type="radio" name="category" id="category-one" <?php if(isset($category) && $category=='Hoodies and Jackets'){echo 'checked';}?>>
              <label class="form-check-label" for="flexRadioDefault2">
                Hoodies and Jackets
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" value="Combos" type="radio" name="category" id="category-one" <?php if(isset($category) && $category=='Combos'){echo 'checked';}?>>
              <label class="form-check-label" for="flexRadioDefault2">
                Combos
              </label>
            </div>
            
            <div class="form-check">
              <input class="form-check-input" value="new" type="radio" name="category" id="category-one" <?php if(isset($category) && $category=='new'){echo 'checked';}?>>
              <label class="form-check-label" for="flexRadioDefault2">
                new
              </label>
            </div>

          </div>

        </div>
        <div class="row  mx-auto container mt-5">
          <div class="col-lg-12 col-md-12 col-sm-12">

            <p>Price</p>
            <input type="range" class="form-group w-50" name="price" value="<?php if(isset($price)){echo $price;}else{echo "100";}?>" min="1" max="1000" id="customRange2"/>
            <div class="w-50">
              <span style="float: left;">1</span>
              <span style="float: right;">1000</span>
            </div>
          </div>
        <div>
        <div class="form-group my-3 mx-3">
          <input type="submit" name="search" value="Search" class="btn btn-primary">
        </div>
      </form>
      </section>

      <section id="shop-products" class="my-5 py-1">
        <div class="container mt-5 py-5">
          <h3>Our products</h3>
          <hr>
          <p>Check out our latest products and buy at affordable price</p>
        </div>
        <div class="row mx-auto container">

        <?php while($row= $products->fetch_assoc()){ ?>
          <div class="product my-5 text-center col-lg-3 col-md-4 col-12">
            <img class="img-fluid mb-3" src="img/clothes/<?php echo $row['product_image']; ?>">
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>

            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
            <a class="btn buy-btn" href="<?php echo "sproduct.php?product_id=".$row['product_id']; ?>">Buy Now!</a>

          </div>

          <?php } ?>
          
          <nav aria-label="Page navigation example" class="mt-5">
            <ul class="pagination mt-5">
              <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
                <a class="page-link" href="<?php if($page_no <=1){echo '#';}else{echo "?page_no=".($page_no-1);} ?>">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
              <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

              <?php if($page_no >=3) {?>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no;?>"><?php echo $page_no;?></a></li>
              <?php }?>

              <li class="page-item <?php if($page_no>= $total_number_of_pages){echo 'disabled';} ?>">
                <a class="page-link" href="<?php if($page_no >= $total_number_of_pages) {echo '#';}else{ echo "?page_no=".($page_no+1);}?>">Next</a></li>
            </ul>
          </nav>


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