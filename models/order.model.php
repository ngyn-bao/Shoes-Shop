<?php
class Order {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createOrder($user_id, $shipping_address, $payment_method, $items) {
        $this->conn->begin_transaction();

        try {
            $total = 0;
            foreach ($items as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $query = "INSERT INTO orders (user_id, total_amount, shipping_address, payment_method) 
                      VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("idss", $user_id, $total, $shipping_address, $payment_method);
            $stmt->execute();

            $order_id = $this->conn->insert_id;

            $queryDetail = "INSERT INTO order_details (order_id, product_id, size, quantity, price) 
                            VALUES (?, ?, ?, ?, ?)";
            $stmtDetail = $this->conn->prepare($queryDetail);

            foreach ($items as $item) {
                $stmtDetail->bind_param(
                    "iisid",
                    $order_id,
                    $item['product_id'],
                    $item['size'],
                    $item['quantity'],
                    $item['price']
                );
                $stmtDetail->execute();
            }

            $this->conn->commit();
            return $order_id;
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Create order failed: " . $e->getMessage());
            return false;
        }
    }

    public function getAllOrder() {
        $query = "SELECT o.*, u.full_name, u.email 
                  FROM orders o
                  JOIN users u ON o.user_id = u.user_id
                  ORDER BY o.created_at DESC";

        $result = mysqli_query($this->conn, $query);
        $data = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getOrderDetail($order_id) {
        // Lấy thông tin đơn hàng
        $queryOrder = "SELECT o.*, u.full_name, u.email 
                       FROM orders o
                       JOIN users u ON o.user_id = u.user_id
                       WHERE o.order_id = ?";
        $stmt = $this->conn->prepare($queryOrder);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $order = $stmt->get_result()->fetch_assoc();

        if (!$order) return null;

        // Lấy chi tiết sản phẩm trong đơn
        $queryDetails = "SELECT od.*, p.product_name 
                         FROM order_details od
                         JOIN products p ON od.product_id = p.product_id
                         WHERE od.order_id = ?";
        $stmt = $this->conn->prepare($queryDetails);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $details = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return [
            "order" => $order,
            "details" => $details
        ];
    }

    public function updateStatus($order_id, $status) {
        $query = "UPDATE orders SET status = ? WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $status, $order_id);
        return $stmt->execute();
    }

    public function cancelOrder($order_id) {
       $query = "UPDATE orders SET status = 'cancelled' WHERE order_id = ? AND status = 'pending'";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $order_id);
        return $stmt->execute();
    }
}
?>
