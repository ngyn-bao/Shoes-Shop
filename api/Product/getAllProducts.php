<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Product.php';

$productModel = new Product($conn);
$products = $productModel->getAll();

echo json_encode([
    "success" => true,
    "data" => $products
]);
?>
