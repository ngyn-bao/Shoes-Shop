<?php
require_once __DIR__ . '/../config/db.php';

class SiteContent {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // ========================================
    // Get Page Content
    // ========================================
    public function getPageContent($page) {
        $sql = "
            SELECT * 
            FROM site_content 
            WHERE page = ?
        ";

        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $page);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // ========================================
    // Update Page Content (Admin)
    // ========================================
    public function updatePageContent($page, $title, $content, $image) {
        $sql = "
            UPDATE site_content 
            SET title = ?, content = ?, image_url = ? 
            WHERE page = ?
        ";

        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $title, $content, $image, $page);

        return mysqli_stmt_execute($stmt);
    }
}
?>