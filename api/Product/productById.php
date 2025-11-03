<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/product.model.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing product ID"]);
    exit;
}

$product = new Product($conn);
$data = $product->getById($_GET['id']);

if ($data) {
    echo json_encode($data);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Product not found"]);
}
?>
