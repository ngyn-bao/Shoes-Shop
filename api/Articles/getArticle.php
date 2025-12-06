<?php
require '../../config/db.php';
header('Content-Type: application/json');
$result = mysqli_query($conn, "SELECT article_id, title, image_url, content, created_at FROM articles ORDER BY created_at DESC");
$articles = [];
while ($row = mysqli_fetch_assoc($result)) $articles[] = $row;
echo json_encode($articles);
