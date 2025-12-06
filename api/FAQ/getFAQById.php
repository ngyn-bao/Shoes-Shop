<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/faq.model.php';

$faqModel = new FAQ($conn);

$faq_id = isset($_GET['faq_id']) ? (int)$_GET['faq_id'] : null;

if (!$faq_id) {
    echo json_encode([
        "success" => false,
        "message" => "Missing faq_id"
    ]);
    exit;
}

$data = $faqModel->getFAQById($faq_id);

echo json_encode([
    "success" => true,
    "data" => $data
]);
?>