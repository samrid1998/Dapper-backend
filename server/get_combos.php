<?php
include("connection.php");

$stmt = $conn->prepare("SELECT * from products where product_category = 'Combos' LIMIT 4");

$stmt->execute();

$combos = $stmt->get_result();


?>