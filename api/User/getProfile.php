<?php
session_start();
header("Content-Type: application/json");
require_once "../../config/db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT full_name, email, phone, address FROM users WHERE user_id = $user_id";
$res = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($res);

echo json_encode(["success" => true, "data" => $user]);
