<?php
header('Content-Type: application/json');
require '../../config/db.php';

$name = trim($_POST['name'] ?? '');
$content = trim($_POST['content'] ?? '');
$article_id = (int)($_POST['article_id'] ?? 0);

if ($name && $content && $article_id > 0) {
    $stmt = $pdo->prepare("INSERT INTO comments (article_id, name, content) VALUES (?, ?, ?)");
    $stmt->execute([$article_id, $name, $content]);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Thiếu thông tin']);
}