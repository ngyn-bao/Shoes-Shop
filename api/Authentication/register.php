<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);
$full_name = $data['full_name'] ?? '';
$email = $data['email'] ?? '';
$password = password_hash($data['password'] ?? '', PASSWORD_BCRYPT);

$query = "INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $full_name, $email, $password);
$stmt->execute();

echo json_encode(["message" => "User registered successfully"]);
?>
