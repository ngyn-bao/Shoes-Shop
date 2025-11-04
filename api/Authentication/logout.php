<?php
header("Content-Type: application/json");
session_start();

// Huỷ tất cả session
$_SESSION = [];
session_unset();
session_destroy();

echo json_encode([
    "success" => true,
    "message" => "Đăng xuất thành công"
]);
?>
