<?php
require '../../config/db.php';
header('Content-Type: application/json');
$id = (int)($_GET['article_id'] ?? 0);
$result = mysqli_query($conn, "SELECT * FROM comments WHERE article_id = $id AND is_approved = 1 ORDER BY created_at DESC");
$comments = [];
while ($row = mysqli_fetch_assoc($result)) $comments[] = $row;
echo json_encode($comments);