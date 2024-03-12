<?php
include("connection.php");

$stmt = $conn->prepare("SELECT * from products where product_category = 'new' LIMIT 3");

$stmt->execute();

$new = $stmt->get_result();


?>