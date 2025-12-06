<?php
session_start();
header("Content-Type: application/json");
require_once "../../config/db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$full_name = $data['full_name'];
$phone    = $data['phone'];
$address  = $data['address'];
$user_id  = $_SESSION['user_id'];

$query = "UPDATE users SET full_name='$full_name', phone='$phone', address='$address' WHERE user_id=$user_id";
mysqli_query($conn, $query);

echo json_encode(["success" => true, "message" => "Profile updated successfully"]);
