<?php
class Order {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Tạo đơn hàng mới
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
                $stmtDetail->bind_param("iisid", $order_id, $item['product_id'], $item['size'], $item['quantity'], $item['price']);
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

    // Lấy danh sách tất cả đơn hàng (dùng cho trang orders.html)
    public function getAllOrder() {
        $query = "SELECT o.*, u.full_name 
                  FROM orders o
                  JOIN users u ON o.user_id = u.user_id
                  ORDER BY o.created_at DESC";

        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Tính lại tổng tiền chính xác từ order_details
    public function recalculateTotal($order_id) {
        $sql = "SELECT COALESCE(SUM(quantity * price), 0) AS total FROM order_details WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $new_total = $stmt->get_result()->fetch_assoc()['total'];

        $update = "UPDATE orders SET total_amount = ? WHERE order_id = ?";
        $stmt2 = $this->conn->prepare($update);
        $stmt2->bind_param("di", $new_total, $order_id);
        $stmt2->execute();

        return $new_total;
    }

    // LẤY CHI TIẾT ĐƠN HÀNG – HOÀN HẢO CHO TRANG order-detail.html
    public function getOrderDetail($order_id) {
        // 1. Lấy thông tin đơn hàng + khách hàng
        $sql = "SELECT 
                    o.order_id,
                    o.total_amount,
                    o.created_at,
                    o.status,
                    u.full_name AS fullname,
                    u.phone,
                    u.address
                FROM orders o
                JOIN users u ON o.user_id = u.user_id
                WHERE o.order_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return false;
        }
        $order = $result->fetch_assoc();

        // 2. Tính lại tổng tiền chính xác (rất quan trọng!)
        $real_total = $this->recalculateTotal($order_id);

        // 3. Lấy chi tiết sản phẩm (có size, quantity, price)
        $sqlItems = "SELECT 
                        od.product_id,
                        od.size,
                        od.quantity,
                        od.price,
                        p.product_name
                     FROM order_details od
                     JOIN products p ON od.product_id = p.product_id
                     WHERE od.order_id = ?
                     ORDER BY od.order_detail_id";

        $stmt2 = $this->conn->prepare($sqlItems);
        $stmt2->bind_param("i", $order_id);
        $stmt2->execute();
        $items = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);

        // Thêm ảnh mặc định vì bảng products không có cột image
        foreach ($items as &$item) {
            $item['image'] = 'default-product.jpg'; // Đặt file này trong uploads/products/
        }
        unset($item); // tốt cho tham chiếu

        // Trả về dữ liệu đúng format frontend đang dùng
        return [
            "order" => [
                "order_id"     => $order['order_id'],
                "total_amount" => $real_total,                    // ← Luôn chính xác!
                "created_at"   => $order['created_at'],
                "status"       => $order['status'] ?? 'pending',
                "fullname"     => $order['fullname'] ?? 'Khách hàng',
                "phone"        => $order['phone'] ?? '',
                "address"      => $order['address'] ?? ''
            ],
            "items" => $items
        ];
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus($order_id, $status) {
        $allowed = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        if (!in_array($status, $allowed)) return false;

        $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $order_id);
        return $stmt->execute();
    }

    // Hủy đơn hàng (chỉ khi đang pending)
    public function cancelOrder($order_id) {
        $sql = "UPDATE orders SET status = 'cancelled' WHERE order_id = ? AND status = 'pending'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        return $stmt->execute();
    }
}
?>