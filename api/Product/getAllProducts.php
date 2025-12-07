<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/product.model.php';

$productModel = new Product($conn);

// Nhận page & limit từ query string (nếu có)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 6;
$category_id = $_GET["category_id"] ?? 1;
$search = isset($_GET['search']) ? $_GET['search'] : "";

try {
    $result = $productModel->getAll($page, $limit, $category_id, $search);

    echo json_encode([
        "success" => true,
        "data" => $result,
        "pagination" => [
            "page" => $page,
            "limit" => $limit,
            "total" => $result["total"]
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
