<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);
$full_name = $data['full_name'] ?? '';
$email = $data['email'] ?? '';
$password = password_hash($data['password'] ?? '', PASSWORD_BCRYPT);
$phone = $data['phone'] ?? '';
$address = $data['address'] ?? '';
$avatar = $data['avatar'] ?? '';

$query = "INSERT INTO users (full_name, email, password_hash, phone, address, avatar, role, status, created_at) VALUES (?, ?, ?, ?, ?, ?, 'customer', 'active', NOW())";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssss", $full_name, $email, $password, $phone, $address, $avatar);
$result = $stmt->execute();

if ($result) {
    echo json_encode(["success" => true, "message" => "Đăng ký tài khoản thành công"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi tạo tài khoản"]);
}
?>
