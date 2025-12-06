<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/faq.model.php';

$faqModel = new FAQ($conn);

$question_id = $_POST['question_id'] ?? null;

if (!$question_id) {
    echo json_encode([
        "success" => false,
        "message" => "Missing question_id"
    ]);
    exit;
}

$result = $faqModel->deleteQuestion($question_id);

echo json_encode([
    "success" => $result,
    "message" => $result ? "Question deleted successfully" : "Question deletion failed"
]);
?>