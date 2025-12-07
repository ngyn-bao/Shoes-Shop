<?php
require '../../config/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid Method']);
    exit;
}

$id      = (int)($_POST['id'] ?? 0);
$title   = $_POST['title'] ?? '';
$excerpt = $_POST['excerpt'] ?? '';
$content = $_POST['content'] ?? '';

if ($id <= 0 || empty($title) || empty($content)) {
    echo json_encode(['success' => false, 'message' => 'Thiếu thông tin bắt buộc']);
    exit;
}

//Xử lý logic Upload ảnh
$newImagePath = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $uploadDir = '../../public/img/';
    
    if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (in_array($ext, $allowed)) {
        $fileName = time() . '_' . uniqid() . '.' . $ext;
        
        // Di chuyển file vào thư mục
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
            $newImagePath = 'img/' . $fileName; 
        } else {
            echo json_encode(['success' => false, 'message' => 'Không thể lưu file ảnh']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'File ảnh không hợp lệ']);
        exit;
    }
}

if ($newImagePath) {
    // Có ảnh mới -> Cập nhật cột image
    $sql = "UPDATE articles SET title=?, image=?, excerpt=?, content=?, updated_at=NOW() WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $newImagePath, $excerpt, $content, $id);
} else {
    // Không có ảnh mới -> Giữ nguyên ảnh cũ
    $sql = "UPDATE articles SET title=?, excerpt=?, content=?, updated_at=NOW() WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $excerpt, $content, $id);
}

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cập nhật thành công']);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}
?>