<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/cart.model.php';

$data = json_decode(file_get_contents("php://input"), true);
$cart_item_id = $data['cart_item_id'] ?? null;
$quantity = $data['quantity'] ?? null;

if (!$cart_item_id || $quantity === null) {
    echo json_encode(["success" => false, "message" => "Thiếu cart_item_id hoặc quantity"]);
    exit;
}

$cart = new Cart($conn);
$result = $cart->updateQuantity($cart_item_id, $quantity);

echo json_encode([
    "success" => $result,
    "message" => $result ? "Cập nhật giỏ hàng thành công" : "Lỗi khi cập nhật"
]);
