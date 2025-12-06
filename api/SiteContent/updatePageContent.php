<?php
header("Content-Type: application/json; charset=UTF-8");
session_start();

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/siteContent.model.php';

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     echo json_encode([
//         "success" => false,
//         "message" => "No access"
//     ]);
//     exit;
// }

$page = $_POST['page'];
$title = $_POST['title'];
$content = $_POST['content'];
$image = $_POST['image'];

if (!$page || !$title || !$content) {
    echo json_encode([
        "success" => false,
        "message" => "Missing data"
    ]);
    exit;
}

$siteContent = new SiteContent($conn);
$result = $siteContent->updatePageContent($page, $title, $content, $image);

echo json_encode([
    "success" => $result,
    "message" => $result ? "Content updated successfully" : "Content update failed"
]);
?>
