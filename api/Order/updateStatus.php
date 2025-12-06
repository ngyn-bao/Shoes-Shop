<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/order.model.php';

// Chỉ nhận POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "success" => false,
        "message" => "Phương thức không hợp lệ"
    ]);
    exit;
}

// Lấy JSON body
$input = json_decode(file_get_contents("php://input"), true);

// Validate
if (!isset($input['order_id']) || !isset($input['status'])) {
    echo json_encode([
        "success" => false,
        "message" => "Thiếu order_id hoặc status"
    ]);
    exit;
}

$order_id = intval($input['order_id']);
$status = trim($input['status']);

// Danh sách trạng thái hợp lệ
$validStatus = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

if (!in_array($status, $validStatus)) {
    echo json_encode([
        "success" => false,
        "message" => "Trạng thái không hợp lệ"
    ]);
    exit;
}

$order = new Order($conn);

// Kiểm tra order tồn tại
$orderData = $order->getOrderDetail($order_id);
if (!$orderData) {
    echo json_encode([
        "success" => false,
        "message" => "Đơn hàng không tồn tại"
    ]);
    exit;
}

// Cập nhật
$updated = $order->updateStatus($order_id, $status);

echo json_encode([
    "success" => $updated,
    "message" => $updated ? "Cập nhật trạng thái thành công" : "Cập nhật thất bại"
]);
