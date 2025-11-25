<?php
header("Content-Type: application/json");
require_once $_SERVER['DOCUMENT_ROOT'] . '/Shoes-Shop/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Shoes-Shop/models/product.model.php';

$productModel = new Product($conn);
$data = json_decode(file_get_contents("php://input"), true) ?? [];

if (empty($data['product_name']) || empty($data['price']) || empty($data['category_id']) || empty($data['brand_id'])) {
    echo json_encode(["success" => false, "message" => "Thiếu thông tin bắt buộc"]);
    exit;
}

$productId = $productModel->create($data);

if ($productId && !empty($data['image_url'])) {
    $productModel->addImage($productId, $data['image_url'], 1);
}

echo json_encode([
    "success" => !!$productId,
    "message" => $productId ? "Thêm thành công" : "Thêm thất bại",
    "id" => $productId
]);
?>