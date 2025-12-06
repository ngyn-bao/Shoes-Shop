<?php
require_once __DIR__ . '/../../models/Contact.php';

// đọc JSON input
$data = json_decode(file_get_contents("php://input"), true);

$name = $data['full_name'] ?? null;
$email = $data['email'] ?? null;
$phone = $data['phone'] ?? null;
$message = $data['message'] ?? null;

// kiểm tra rỗng
if (!$name || !$email || !$phone || !$message) {
    echo json_encode(["error" => "Missing fields"]);
    exit;
}

$result = Contact::create($name, $email, $phone, $message);
echo json_encode(["success" => $result]);
