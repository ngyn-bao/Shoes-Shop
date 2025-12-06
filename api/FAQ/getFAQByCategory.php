<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/faq.model.php';

$faqModel = new FAQ($conn);

$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

if (!$category_id) {
    echo json_encode([
        "success" => false,
        "message" => "Missing category_id"
    ]);
    exit;
}

$data = $faqModel->getFAQByCategory($category_id);

echo json_encode([
    "success" => true,
    "data" => $data
]);
?>