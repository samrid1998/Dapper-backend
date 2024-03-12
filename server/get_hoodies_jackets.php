<?php
include("connection.php");

$stmt = $conn->prepare("SELECT * from products where product_category = 'Hoodies and Jackets' LIMIT 4");

$stmt->execute();

$hoodies_jackets = $stmt->get_result();


?>