<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/order.model.php';

$orderModel = new Order($conn);

// Nhận dữ liệu từ body
$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data['user_id'] ?? null;
$shipping_address = $data['shipping_address'] ?? '';
$payment_method = $data['payment_method'] ?? 'cod';
$items = $data['items'] ?? [];

if (!$user_id || empty($items)) {
    echo json_encode(["success" => false, "message" => "Thiếu user_id hoặc danh sách sản phẩm"]);
    exit;
}

$order_id = $orderModel->createOrder($user_id, $shipping_address, $payment_method, $items);

if ($order_id) {
    echo json_encode(["success" => true, "message" => "Tạo đơn hàng thành công", "order_id" => $order_id]);
} else {
    echo json_encode(["success" => false, "message" => "Không thể tạo đơn hàng"]);
}
