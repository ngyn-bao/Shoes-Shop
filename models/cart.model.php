<?php
require_once __DIR__ . '/../config/db.php';

class Cart {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCart($user_id) {
        $query = "
            SELECT ci.cart_item_id, ci.product_id, p.product_name, ci.size, ci.quantity, p.price, (p.price * ci.quantity) AS total
            FROM cart_items ci
            JOIN cart c ON ci.cart_id = c.cart_id
            JOIN products p ON ci.product_id = p.product_id
            WHERE c.user_id = ?
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        return $items;
    }

    // ➕ Thêm sản phẩm vào giỏ hàng
    public function addToCart($user_id, $product_id, $size, $quantity) {
        $queryCart = "SELECT cart_id FROM cart WHERE user_id = ?";
        $stmtCart = $this->conn->prepare($queryCart);
        $stmtCart->bind_param("i", $user_id);
        $stmtCart->execute();
        $cartResult = $stmtCart->get_result();
        $cart_id = null;

        if ($row = $cartResult->fetch_assoc()) {
            $cart_id = $row['cart_id'];
        } else {
            $insertCart = "INSERT INTO cart (user_id, created_at) VALUES (?, NOW())";
            $stmtInsert = $this->conn->prepare($insertCart);
            $stmtInsert->bind_param("i", $user_id);
            $stmtInsert->execute();
            $cart_id = $this->conn->insert_id;
        }


        $queryItem = "SELECT cart_item_id, quantity FROM cart_items WHERE cart_id = ? AND product_id = ? AND size = ?";
        $stmtItem = $this->conn->prepare($queryItem);
        $stmtItem->bind_param("iis", $cart_id, $product_id, $size);
        $stmtItem->execute();
        $result = $stmtItem->get_result();

        if ($row = $result->fetch_assoc()) {
            // Cập nhật số lượng
            $newQty = $row['quantity'] + $quantity;
            $updateQuery = "UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?";
            $stmtUpdate = $this->conn->prepare($updateQuery);
            $stmtUpdate->bind_param("ii", $newQty, $row['cart_item_id']);
            return $stmtUpdate->execute();
        } else {
            // Thêm mới
            $insertQuery = "INSERT INTO cart_items (cart_id, product_id, size, quantity) VALUES (?, ?, ?, ?)";
            $stmtInsert = $this->conn->prepare($insertQuery);
            $stmtInsert->bind_param("iisi", $cart_id, $product_id, $size, $quantity);
            return $stmtInsert->execute();
        }
    }

    public function updateQuantity($cart_item_id, $quantity) {
        $query = "UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $quantity, $cart_item_id);
        return $stmt->execute();
    }
    public function deleteItem($cart_item_id) {
        $query = "DELETE FROM cart_items WHERE cart_item_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $cart_item_id);
        return $stmt->execute();
    }
}
?>
