<?php
session_start();
header("Content-Type: application/json");
require_once "../../config/db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$old = $data['old_password'];
$new = password_hash($data['new_password'], PASSWORD_BCRYPT);

$user_id = $_SESSION['user_id'];

$check = mysqli_query($conn, "SELECT password_hash FROM users WHERE user_id=$user_id");
$row = mysqli_fetch_assoc($check);

if (!password_verify($old, $row['password_hash'])) {
    echo json_encode(["success" => false, "message" => "Incorrect old password"]);
    exit;
}

mysqli_query($conn, "UPDATE users SET password='$new' WHERE user_id=$user_id");

echo json_encode(["success" => true, "message" => "Password updated"]);
