<?php
require '../../config/db.php';
$id = (int)$_POST['id'];
mysqli_query($conn, "DELETE FROM comments WHERE id = $id");
echo json_encode(['success' => true]);