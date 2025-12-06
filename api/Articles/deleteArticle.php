<?php
require '../../config/db.php';
$article_id = (int)$_POST['id'];
mysqli_query($conn, "DELETE FROM articles WHERE article_id = $article_id");
echo json_encode(['success' => true]);
