<?php
require_once '../../config/db.php';
header('Content-Type: application/json');

$title   = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
$image   = mysqli_real_escape_string($conn, $_POST['image'] ?? '');
$excerpt = mysqli_real_escape_string($conn, $_POST['excerpt'] ?? '');
$content = mysqli_real_escape_string($conn, $_POST['content'] ?? '');

if (empty($title) || empty($content)) {
    echo json_encode(['success' => false, 'message' => 'Tiêu đề và nội dung bắt buộc']);
    exit;
}

$sql = "INSERT INTO articles (title, image, excerpt, content) 
        VALUES ('$title', '$image', '$excerpt', '$content')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
}
?>