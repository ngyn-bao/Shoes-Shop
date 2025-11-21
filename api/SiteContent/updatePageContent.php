<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/SiteContent.php';

$data = json_decode(file_get_contents("php://input"), true);

$id    = $data['content_id']   ?? null;
$title = $data['title']        ?? null;
$html  = $data['content_html'] ?? null;
$image = $data['image_url']    ?? null;

if (!$id || !$title || !$html) {
    echo json_encode([
        "success" => false,
        "message" => "Thiếu content_id, title hoặc content_html"
    ]);
    exit;
}

$siteContentModel = new SiteContent($conn);
$result = $siteContentModel->update($id, $title, $html, $image);

echo json_encode([
    "success" => $result,
    "message" => $result ? "Cập nhật thành công" : "Cập nhật thất bại"
]);
