<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

// Lấy dữ liệu
$full_name = trim($data['full_name'] ?? '');
$email = trim($data['email'] ?? '');
$password_raw = $data['password'] ?? '';
$phone = trim($data['phone'] ?? '');
$address = trim($data['address'] ?? '');
$avatar = trim($data['avatar'] ?? '');

// Kiểm tra dữ liệu rỗng
if (!$full_name || !$email || !$password_raw || !$phone) {
    echo json_encode(["success" => false, "message" => "Thiếu dữ liệu bắt buộc"]);
    exit;
}

// Check email hợp lệ
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Email không hợp lệ"]);
    exit;
}

// Check password tối thiểu 6 ký tự
if (strlen($password_raw) < 6) {
    echo json_encode(["success" => false, "message" => "Mật khẩu phải từ 6 ký tự trở lên"]);
    exit;
}

// Check email đã tồn tại
$check = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email đã tồn tại"]);
    exit;
}

// Hash password
$password = password_hash($password_raw, PASSWORD_BCRYPT);

// Insert user
$query = "INSERT INTO users (full_name, email, password_hash, phone, address, avatar, role, status, created_at) 
          VALUES (?, ?, ?, ?, ?, ?, 'customer', 'active', NOW())";

$stmt = $conn->prepare($query);
$stmt->bind_param("ssssss", $full_name, $email, $password, $phone, $address, $avatar);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Đăng ký tài khoản thành công"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi tạo tài khoản"]);
}
?>
