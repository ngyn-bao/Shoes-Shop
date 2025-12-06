<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/faq.model.php';

$faqModel = new FAQ($conn);

$faq_id = $_POST['faq_id'] ?? null;

if (!$faq_id) {
    echo json_encode([
        "success" => false,
        "message" => "Missing faq_id"
    ]);
    exit;
}

$result = $faqModel->deleteFAQ($faq_id);

echo json_encode([
    "success" => $result,
    "message" => $result ? "FAQ deleted successfully" : "FAQ deletion failed"
]);
?>