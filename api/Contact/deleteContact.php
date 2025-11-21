<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/Contact.php';

// Lấy JSON body
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['contact_id'] ?? null;

if (!$id) {
    echo json_encode([
        "success" => false,
        "message" => "Thiếu contact_id"
    ]);
    exit;
}

$result = Contact::delete($id);

echo json_encode([
    "success" => $result,
    "message" => $result ? "Xóa liên hệ thành công" : "Xóa thất bại"
]);
