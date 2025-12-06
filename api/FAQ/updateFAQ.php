<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/faq.model.php';

$faqModel = new FAQ($conn);

$faq_id = $_POST['faq_id'] ?? null;
$category_id = $_POST['category_id'] ?? null;
$question = $_POST['question'] ?? null;
$answer = $_POST['answer'] ?? null;

if (!$faq_id || !$category_id || !$question || !$answer) {
    echo json_encode([
        "success" => false,
        "message" => "Missing data"
    ]);
    exit;
}

$result = $faqModel->updateFAQ($faq_id, $category_id, $question, $answer);

echo json_encode([
    "success" => $result,
    "message" => $result ? "FAQ updated successfully" : "FAQ update failed"
]);
?>