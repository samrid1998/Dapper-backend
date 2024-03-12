<?php

session_start();

include('connection.php');

//if user is logged in
if(!isset($_SESSION['logged_in'])){
    header('location: ../checkout.php?message=Please login/register to place an order');
    exit;

//if user id not logged in 
}else{
    if(isset($_POST['place_order'])){
        //1.get user info and store it in the database.
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['address'];
        $address = $_POST['city'];
        $order_cost = $_SESSION['total'];
        $order_status ="not paid";
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s');
    
        $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                                    VALUES (?,?,?,?,?,?,?); ");
        $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);
    
        $stmt_status = $stmt->execute();
    
        if(!$stmt_status){
            header('location: index.php');
            exit;
        }
    
        //2. issue new order and store order info in database
    
        $order_id = $stmt->insert_id;
    
        //3. get products from cart(from session)
        $_SESSION['cart2'];
        foreach($_SESSION['cart2'] as $key => $value){
    
            $product = $_SESSION['cart2'][$key];
    
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];
    
            //4. store each single item in order_items database
    
            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,user_id,order_date,product_price,product_quantity)
                                        VALUES (?,?,?,?,?,?,?,?)");
    
            $stmt1->bind_param('iissisii',$order_id,$product_id,$product_name,$product_image,$user_id,$order_date,$product_price,$product_quantity);
    
            $stmt1->execute();
    
        }
        
        //5.inform user whether everything is fine or there is a problem
    
        header('location: ../payment.php?order_status=Order placed successfully!');
    
    }

}


?>