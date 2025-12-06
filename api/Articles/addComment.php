<?php
session_start();
header('Content-Type: application/json');

require_once '../../config/db.php';  

$article_id = (int)($_POST['article_id'] ?? 0);
$content    = trim($_POST['content'] ?? '');

if ($article_id <= 0 || empty($content)) {
    echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đủ thông tin']);
    exit;
}

$user_id = 0;
$email   = '';
$name    = 'Khách';

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) {
    $user_id = (int)$_SESSION['user_id'];

    $user_query = mysqli_query($conn, "SELECT full_name, email FROM users WHERE user_id = $user_id LIMIT 1");
    if ($user_query && $row = mysqli_fetch_assoc($user_query)) {
        $name  = !empty($row['full_name']) ? $row['full_name'] : 'Khách';
        $email = $row['email'] ?? '';
    }
} else {
    $email = trim($_POST['email'] ?? '');
    $name  = trim($_POST['name'] ?? 'Khách');
}

$name    = mysqli_real_escape_string($conn, $name);
$email   = mysqli_real_escape_string($conn, $email);
$content = mysqli_real_escape_string($conn, $content);

$sql = "INSERT INTO comments 
        (article_id, user_id, name, email, content, is_approved, created_at) 
        VALUES (?, ?, ?, ?, ?, 1, NOW())";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("iisss", $article_id, $user_id, $name, $email, $content);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Lỗi khi lưu bình luận']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi hệ thống']);
}

$conn->close();
?>