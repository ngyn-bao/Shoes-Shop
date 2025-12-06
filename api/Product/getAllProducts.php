<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/product.model.php';

$productModel = new Product($conn);

// Nhận page & limit từ query string (nếu có)
$page = isset($_GET['page']) ? (int)$_GET['page'] : null;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : null;
$category_id = $_GET["category_id"] ?? null;
$search = isset($_GET['search']) ? $_GET['search'] : null;

try {
    $result = $productModel->getAll($page, $limit, $category_id, $search);
    echo json_encode([
        "success" => true,
        "data" => $result
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
