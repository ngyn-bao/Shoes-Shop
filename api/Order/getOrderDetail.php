<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/order.model.php';

$orderModel = new Order($conn);

$order_id = $_GET['order_id'] ?? null;

if (!$order_id || !is_numeric($order_id)) {
    echo json_encode(["success" => false, "message" => "Thiếu hoặc sai order_id"]);
    exit;
}

// TÍNH LẠI TỔNG TIỀN CHÍNH XÁC TRƯỚC KHI TRẢ VỀ
$orderModel->recalculateTotal($order_id);  // ← DÒNG QUAN TRỌNG

$result = $orderModel->getOrderDetail($order_id);

if ($result) {
    echo json_encode(["success" => true, "data" => $result]);
} else {
    echo json_encode(["success" => false, "message" => "Không tìm thấy đơn hàng"]);
}
?>