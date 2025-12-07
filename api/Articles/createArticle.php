<?php
require_once '../../config/db.php';
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn chưa đăng nhập']);
    exit;
}

$title     = $_POST['title'] ?? '';
$excerpt   = $_POST['excerpt'] ?? ''; 
$content   = $_POST['content'] ?? '';
$author_id = $_SESSION['user_id'];

if (empty($title) || empty($content)) {
    echo json_encode(['success' => false, 'message' => 'Tiêu đề và nội dung bắt buộc']);
    exit;
}

$imagePath = 'img/no-image.jpg'; 

if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $uploadDir = '../../public/img/';
    
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileInfo = pathinfo($_FILES['image']['name']);
    $ext = strtolower($fileInfo['extension']);
    
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (in_array($ext, $allowed)) {
        $newFileName = time() . '_' . uniqid() . '.' . $ext;
        $targetFile = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = 'img/' . $newFileName; 
        } else {
            echo json_encode(['success' => false, 'message' => 'Lỗi không thể lưu file vào server']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Chỉ chấp nhận file ảnh (JPG, PNG, GIF)']);
        exit;
    }
}

$sql = "INSERT INTO articles (title, image, excerpt, content, created_at) VALUES (?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Lỗi SQL: ' . $conn->error]);
    exit;
}

$stmt->bind_param("ssss", $title, $imagePath, $excerpt, $content);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Thêm bài viết thành công']);
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi thực thi: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>