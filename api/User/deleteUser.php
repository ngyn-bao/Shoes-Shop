<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../../config/db.php";

$user_id = intval($_POST["user_id"] ?? 0);

if ($user_id <= 0) {
    echo json_encode(["success" => false, "message" => "Invalid user id"]);
    exit;
}

$sql = "DELETE FROM users WHERE user_id = $user_id";
mysqli_query($conn, $sql);

echo json_encode(["success" => true, "message" => "User deleted"]);
