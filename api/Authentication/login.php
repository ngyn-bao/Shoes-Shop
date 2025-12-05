<?php
header("Content-Type: application/json; charset=UTF-8");
session_start();
require_once __DIR__ . '/../../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

$query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // CHỈ KIỂM TRA PASSWORD RAW
    if (password_verify($password, $user['password_hash'])) {

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];

        echo json_encode([
            "success" => true,
            "message" => "Đăng nhập thành công",
            "user" => [
                "user_id" => $user['user_id'],
                "full_name" => $user['full_name'],
                "role" => $user['role']
            ]
        ]);
        exit;
    }
}

echo json_encode([
    "success" => false,
    "message" => "Sai email hoặc mật khẩu"
]);
?>
