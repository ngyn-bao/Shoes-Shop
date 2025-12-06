<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/cart.model.php';
session_start();


if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        "success" => false,
        "message" => "Chưa đăng nhập"
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

if (!$user_id) {
    echo json_encode(["success" => false, "message" => "Thiếu user_id"]);
    exit;
}

$cart = new Cart($conn);
$items = $cart->getCart($user_id);

echo json_encode([
    "success" => true,
    "cart" => $items
]);
