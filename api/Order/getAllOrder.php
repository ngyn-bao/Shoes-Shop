<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/order.model.php';

$orderModel = new Order($conn);

$data = $orderModel->getAllOrder();

echo json_encode([
    "success" => true,
    "data" => $data
]);
?>
