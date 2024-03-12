<?php
include('../server/connection.php');

if(isset($_POST['edit_image_btn'])){
    $product_name = $_POST['product_name'];
    $product_id= $_POST['product_id'];
    

    $image = $_FILES['image']['tmp_name'];

    $image_name = $product_name.".jpg";

    //upload images
    move_uploaded_file($image,"../img/clothes/".$image_name);


    //create a new product
    $stmt = $conn->prepare("UPDATE products  SET product_image=? WHERE product_id=?");
    
    $stmt->bind_param('si',$image_name,$product_id);

    if($stmt->execute()){
        header('location: products.php?image_edited=Product Image has been edited successfully');
    }else{
        header('location: products.php?image_edited_failure=Image could not be edited, try again');
    }
}
?>