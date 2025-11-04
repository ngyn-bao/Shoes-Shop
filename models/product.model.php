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

       public function create($data) {
        $query = "INSERT INTO products (name, price, stock, description, image_url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdiss", $data['name'], $data['price'], $data['stock'], $data['description'], $data['image_url']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE products SET name=?, price=?, stock=?, description=?, image_url=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdissi", $data['name'], $data['price'], $data['stock'], $data['description'], $data['image_url'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>