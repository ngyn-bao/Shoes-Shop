<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/product.model.php';

$productModel = new Product($conn);
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['product_id'] ?? null;
if (!$id) {
    echo json_encode(["success" => false, "message" => "Thiếu product_id"]);
    exit;
}

$result = $productModel->update($id, $data);
echo json_encode([
    "success" => $result,
    "message" => $result ? "Cập nhật thành công" : "Cập nhật thất bại"
]);
?>
