<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/product.model.php';

$productModel = new Product($conn);

$id = $_GET['id'] ?? null;
if (!$id) {
    echo json_encode(["success" => false, "message" => "Thiếu product_id"]);
    exit;
}

$product = $productModel->getById($id);
echo json_encode([
    "success" => (bool) $product,
    "data" => $product
]);
?>
