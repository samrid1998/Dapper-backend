<?php
include("connection.php");

$stmt = $conn->prepare("SELECT * from products LIMIT 4");

$stmt->execute();

$our_products = $stmt->get_result();


?>