<?php
header('Content-Type: application/json');
require '../../config/db.php';
session_start();

// Nếu user đã login thì lấy user_id
$user_id = $_SESSION['user_id'] ?? 0;

$article_id = (int)($_POST['article_id'] ?? 0);
$comment_text = trim($_POST['comment_text'] ?? '');
$rating = (int)($_POST['rating'] ?? 0);

if ($article_id > 0 && $user_id > 0 && $comment_text !== '' && $rating >= 1 && $rating <= 5) {

    $stmt = $conn->prepare("
        INSERT INTO comments (article_id, user_id, comment_text, rating)
        VALUES (?, ?, ?, ?)
    ");

    // i = integer, s = string → "iisi"
    $stmt->bind_param("iisi", $article_id, $user_id, $comment_text, $rating);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Thiếu thông tin hoặc chưa đăng nhập']);
}
