<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/siteContent.model.php';

$siteContent = new SiteContent($conn);

$page = $_GET['page'] ?? '';

if (!$page) {
    echo json_encode([
        "success" => false,
        "message" => "Missing page"
    ]);
    exit;
}

$data = $siteContent->getPageContent($page);

if ($data) {
    echo json_encode([
        "success" => true,
        "data" => $data
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Page content not found"
    ]);
}
?>
