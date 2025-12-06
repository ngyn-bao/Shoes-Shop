<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/faq.model.php';

$faqModel = new FAQ($conn);

$category_id = $_POST['category_id'] ?? null;
$question = $_POST['question'] ?? null;
$answer = $_POST['answer'] ?? null;

if (!$category_id || !$question || !$answer) {
    echo json_encode([
        "success" => false,
        "message" => "Missing data"
    ]);
    exit;
}

$result = $faqModel->createFAQ($category_id, $question, $answer);

echo json_encode([
    "success" => $result,
    "message" => $result ? "Create FAQ successfully" : "FAQ creation failed"
]);
?>