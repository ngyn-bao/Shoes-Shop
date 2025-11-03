<?php
require_once __DIR__ . '/../config/db.php';

class Product {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getAll() {
        $query = "SELECT * FROM products";
        $result = mysqli_query($this->conn, $query);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getById($id) {
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>