<?php
require_once __DIR__ . '/../config/db.php';

class Product {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

   public function getAll($page = null, $limit = null) {
        // Base query
        $query = "
            SELECT 
                p.*,
                COALESCE(pi.image_url, './img/default.jpg') AS image_url
            FROM products p
            LEFT JOIN product_images pi 
                ON p.product_id = pi.product_id AND pi.is_main = 1
            ORDER BY p.created_at DESC
        ";

        // Nếu có phân trang
        if ($page !== null && $limit !== null) {
            $offset = ($page - 1) * $limit;
            $query .= " LIMIT $limit OFFSET $offset";
        }

        $result = mysqli_query($this->conn, $query);

        if (!$result) {
            throw new Exception("Database query failed: " . mysqli_error($this->conn));
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        // Nếu có phân trang, trả thêm tổng số dòng để tính tổng trang
        if ($page !== null && $limit !== null) {
            $countQuery = "SELECT COUNT(*) AS total FROM products";
            $countResult = mysqli_query($this->conn, $countQuery);
            $total = mysqli_fetch_assoc($countResult)['total'];

            return [
                "data" => $data,
                "pagination" => [
                    "page" => (int)$page,
                    "limit" => (int)$limit,
                    "total" => (int)$total,
                    "total_pages" => ceil($total / $limit)
                ]
            ];
        }

        // Nếu không có phân trang → chỉ trả danh sách sản phẩm
        return $data;
    }


    public function getById($id) {
        $query = "
            SELECT 
                p.*,
                COALESCE(pi.image_url, './img/default.jpg') AS image_url
            FROM products p
            LEFT JOIN product_images pi 
                ON p.product_id = pi.product_id AND pi.is_main = 1
            WHERE p.product_id = ?
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();

        if ($product) {
            $product['images'] = $this->getImages($id);
        }

        return $product;
    }
    public function create($data) {
        $query = "INSERT INTO products (product_name, category_id, brand_id, price, discount, description, stock) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "siiddsi",
            $data['product_name'],
            $data['category_id'],
            $data['brand_id'],
            $data['price'],
            $data['discount'],
            $data['description'],
            $data['stock']
        );

        if (!$stmt->execute()) {
            throw new Exception("Create product failed: " . $stmt->error);
        }

        return mysqli_insert_id($this->conn);
    }

    public function update($id, $data) {
        $query = "UPDATE products 
                  SET product_name=?, category_id=?, brand_id=?, price=?, discount=?, description=?, stock=?, updated_at=NOW() 
                  WHERE product_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "siiddsii",
            $data['product_name'],
            $data['category_id'],
            $data['brand_id'],
            $data['price'],
            $data['discount'],
            $data['description'],
            $data['stock'],
            $id
        );

        if (!$stmt->execute()) {
            throw new Exception("Update product failed: " . $stmt->error);
        }

        return true;
    }

    public function delete($id) {
        // Xóa ảnh trước
        $this->deleteAllImages($id);

        $query = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function getImages($product_id) {
        $query = "SELECT * FROM product_images WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function addImage($product_id, $image_url, $is_main = 0) {
        $query = "INSERT INTO product_images (product_id, image_url, is_main) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isi", $product_id, $image_url, $is_main);
        return $stmt->execute();
    }


    public function deleteImage($image_id) {
        $query = "DELETE FROM product_images WHERE image_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $image_id);
        return $stmt->execute();
    }

    public function deleteAllImages($product_id) {
        $query = "DELETE FROM product_images WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
    }
}
?>
