<?php
header("Content-Type: application/json");
require_once $_SERVER['DOCUMENT_ROOT'] . '/Shoes-Shop/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Shoes-Shop/models/product.model.php';

$productModel = new Product($conn);
$data = json_decode(file_get_contents("php://input"), true) ?? [];

$id = $data['product_id'] ?? null;
if (!$id) {
    echo json_encode(["success" => false, "message" => "Thiếu product_id"]);
    exit;
}

unset($data['product_id'], $data['image_url']); // không update 2 field này ở bảng products

$result = $productModel->update($id, $data);

if ($result) {
    // Xử lý ảnh chính
    $productModel->conn->query("DELETE FROM product_images WHERE product_id = $id AND is_main = 1");
    if (!empty($data['image_url'])) {
        $productModel->addImage($id, $data['image_url'], 1);
    }
}

echo json_encode([
    "success" => $result,
    "message" => $result ? "Cập nhật thành công" : "Cập nhật thất bại"
]);
?>