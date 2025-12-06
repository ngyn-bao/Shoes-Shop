<?php
header("Content-Type: application/json");
session_start(); // DÙNG SESSION ĐỂ LẤY THÔNG TIN CHỦ TÀI KHOẢN

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/faq.model.php';

$faqModel = new FAQ($conn);

$user_id = $_SESSION['user_id'] ?? null;
$category_id = $_POST['category_id'] ?? null;
$question = $_POST['question'] ?? null;

if (!$user_id) {
    echo json_encode([
        "success" => false,
        "message" => "Please login"
    ]);
    exit;
}

if (!$category_id || !$question) {
    echo json_encode([
        "success" => false,
        "message" => "Missing data"
    ]);
    exit;
}

$result = $faqModel->createQuestion($user_id, $category_id, $question);

echo json_encode([
    "success" => $result,
    "message" => $result ? "Create question successfully" : "Question creation failed"
]);
?>