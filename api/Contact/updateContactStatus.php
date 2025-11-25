<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/Contact.php';

$data = json_decode(file_get_contents("php://input"), true);

$id     = $data['contact_id'] ?? null;
$status = $data['status'] ?? null;

if (!$id || !$status) {
    echo json_encode([
        "success" => false,
        "message" => "Thiếu contact_id hoặc status"
    ]);
    exit;
}

$contactModel = new Contact($conn);

$result = $contactModel->updateStatus($id, $status);

echo json_encode([
    "success" => $result,
    "message" => $result ? "Cập nhật thành công" : "Cập nhật thất bại"
]);
