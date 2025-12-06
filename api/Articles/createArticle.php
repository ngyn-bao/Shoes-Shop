<?php
require_once '../../config/db.php';
session_start();
header('Content-Type: application/json');

// Check login
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn chưa đăng nhập']);
    exit;
}

// Input
$title     = $_POST['title'] ?? '';
$image_url = $_POST['image_url'] ?? '';
$content   = $_POST['content'] ?? '';
$author_id = $_SESSION['user_id'];

if (empty($title) || empty($content)) {
    echo json_encode(['success' => false, 'message' => 'Tiêu đề và nội dung bắt buộc']);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO articles (title, image_url, content, author_id)
    VALUES (?, ?, ?, ?)
");
$stmt->bind_param("sssi", $title, $image_url, $content, $author_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}
