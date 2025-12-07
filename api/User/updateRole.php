<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../../config/db.php";

$user_id = intval($_POST["user_id"]);
$role = $_POST["role"] ?? "user";

if (!in_array($role, ["user", "admin"])) {
    echo json_encode(["success" => false, "message" => "Invalid role"]);
    exit;
}

$sql = "UPDATE users SET role = '$role' WHERE user_id = $user_id";
mysqli_query($conn, $sql);

echo json_encode(["success" => true, "message" => "Role updated"]);
