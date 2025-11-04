<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Product.php';

$productModel = new Product($conn);
$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['product_name']) || empty($data['price'])) {
    echo json_encode(["success" => false, "message" => "Thiếu thông tin sản phẩm"]);
    exit;
}

$result = $productModel->create($data);
echo json_encode([
    "success" => $result,
    "message" => $result ? "Thêm sản phẩm thành công" : "Thêm sản phẩm thất bại"
]);
?>
