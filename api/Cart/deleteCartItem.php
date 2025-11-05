<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/Cart.php';

$data = json_decode(file_get_contents("php://input"), true);
$cart_item_id = $data['cart_item_id'] ?? null;

if (!$cart_item_id) {
    echo json_encode(["success" => false, "message" => "Thiếu cart_item_id"]);
    exit;
}

$cart = new Cart($conn);
$result = $cart->deleteItem($cart_item_id);

echo json_encode([
    "success" => $result,
    "message" => $result ? "Xóa sản phẩm khỏi giỏ hàng thành công" : "Không thể xóa sản phẩm"
]);
?>
