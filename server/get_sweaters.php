<?php
include("connection.php");

$stmt = $conn->prepare("SELECT * from products where product_category = 'sweater' LIMIT 4");

$stmt->execute();

$sweater = $stmt->get_result();


?>