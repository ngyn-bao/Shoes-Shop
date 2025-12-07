<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/order.model.php';

$orderModel = new Order($conn);
$order_id = $_POST['order_id'] ?? null;

if (!$order_id) {
    echo json_encode(["success" => false, "message" => "Thiếu order_id"]);
    exit;
}

$new_total = $orderModel->recalculateTotal($order_id);

echo json_encode([
    "success" => true,
    "message" => "Đã tính lại tổng tiền",
    "new_total" => $new_total,
    "formatted" => number_format($new_total, 0, ',', '.') . '₫'
]);
?>
