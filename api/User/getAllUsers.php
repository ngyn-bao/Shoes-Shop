<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../../config/db.php";

$sql = "SELECT user_id, email, phone, role, created_at FROM users ORDER BY user_id ASC";
$result = mysqli_query($conn, $sql);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $users
]);
