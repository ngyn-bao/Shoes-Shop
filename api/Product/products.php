<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/product.model.php';

$product = new Product($conn);
$data = $product->getAll();

echo json_encode($data);
?>
