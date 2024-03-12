<?php
include('../server/connection.php');

if(isset($_POST['add_product_btn'])){
    $product_name = $_POST['title'];
    $product_description = $_POST['description'];
    $product_price = $_POST['price'];
    $product_category = $_POST['category'];

    $image = $_FILES['image']['tmp_name'];

    $image_name = $product_name.".jpg";

    //upload images
    move_uploaded_file($image,"../img/clothes/".$image_name);


    //create a new product
    $stmt = $conn->prepare("INSERT INTO products (product_name,product_image,product_description,product_price,product_category)
                            VALUES(?,?,?,?,?)");
    
    $stmt->bind_param('sssss',$product_name,$image_name,$product_description,$product_price,$product_category);

    if($stmt->execute()){
        header('location: products.php?product_added=Product has been added successfully');
    }else{
        header('location: products.php?product_added_failure=Product could not be added, try again');
    }
}
?>