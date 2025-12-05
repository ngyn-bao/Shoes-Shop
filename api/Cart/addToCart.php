<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/cart.model.php';

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $data['user_id'] ?? null;
$product_id = $data['product_id'] ?? null;
$size = $data['size'] ?? '';
$quantity = $data['quantity'] ?? 1;

if (!$user_id || !$product_id) {
    echo json_encode(["success" => false, "message" => "Thiếu user_id hoặc product_id"]);
    exit;
}

$cart = new Cart($conn);
$result = $cart->addToCart($user_id, $product_id, $size, $quantity);

echo json_encode([
    "success" => $result ? true : false,
    "cart_item_id" => $result,
    "message" => $result ? "Thêm sản phẩm vào giỏ hàng thành công" : "Lỗi khi thêm vào giỏ hàng"
]);
