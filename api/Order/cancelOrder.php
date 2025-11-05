<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/order.model.php';

$orderModel = new Order($conn);
$data = json_decode(file_get_contents("php://input"), true);
$order_id = $data['order_id'] ?? null;

if (!$order_id) {
    echo json_encode(["success" => false, "message" => "Thiếu order_id"]);
    exit;
}

$result = $orderModel->cancelOrder($order_id);

if ($result) {
    echo json_encode(["success" => true, "message" => "Đã hủy đơn hàng"]);
} else {
    echo json_encode(["success" => false, "message" => "Không thể hủy (đơn đã xử lý hoặc không tồn tại)"]);
}
?>
