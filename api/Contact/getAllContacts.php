<?php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/Contact.php';

// Lấy danh sách liên hệ
$data = Contact::getAll();

echo json_encode([
    "success" => true,
    "data" => $data
]);
