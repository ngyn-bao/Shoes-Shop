<?php
require '../../config/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ']);
    exit;
}

$id      = (int)($_POST['id'] ?? 0);
$title   = trim($_POST['title'] ?? '');
$image   = trim($_POST['image'] ?? '');
$excerpt = trim($_POST['excerpt'] ?? '');
$content = trim($_POST['content'] ?? '');

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID bài viết không hợp lệ']);
    exit;
}
if (empty($title) || empty($content)) {
    echo json_encode(['success' => false, 'message' => 'Tiêu đề và nội dung không được để trống']);
    exit;
}

$title   = mysqli_real_escape_string($conn, $title);
$image   = mysqli_real_escape_string($conn, $image);
$excerpt = mysqli_real_escape_string($conn, $excerpt);
$content = mysqli_real_escape_string($conn, $content);

$sql = "UPDATE articles 
        SET title = '$title',
            image = '$image',
            excerpt = '$excerpt',
            content = '$content',
            updated_at = NOW()
        WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true, 'message' => 'Cập nhật bài viết thành công!']);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Lỗi database: ' . mysqli_error($conn)
    ]);
}
?>
