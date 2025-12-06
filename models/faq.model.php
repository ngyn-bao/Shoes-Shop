<?php
require_once __DIR__ . '/../config/db.php';

class FAQ {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // ========================================
    // Get All FAQ
    // ========================================
    public function getAllFAQ() {
        $sql = "
            SELECT f.*, c.name AS category_name 
            FROM faq f 
            JOIN faq_categories c ON f.category_id = c.id 
            ORDER BY f.faq_id ASC
        ";
        
        $result = mysqli_query($this->conn, $sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    // ========================================
    // Get All FAQ Categories
    // ========================================
    public function getAllCategories() {
        $sql = "
            SELECT * 
            FROM faq_categories
        ";
        
        $result = mysqli_query($this->conn, $sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    // ========================================
    // Get FAQ By Category
    // ========================================
    public function getFAQByCategory($category_id) {
        $sql = "
            SELECT f.*, c.name AS category_name 
            FROM faq f 
            JOIN faq_categories c ON f.category_id = c.id 
            WHERE f.category_id = ? 
            ORDER BY f.faq_id DESC
        ";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $category_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    // ========================================
    // Get FAQ By ID
    // ========================================
    public function getFAQById($faq_id) {
        $sql = "
            SELECT * 
            FROM faq 
            WHERE faq_id = ?
        ";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $faq_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // ========================================
    // Create FAQ (Admin)
    // ========================================
    public function createFAQ($category_id ,$question, $answer) {
        $sql = "
            INSERT INTO faq (category_id, question, answer) 
            VALUES (?, ?, ?)
        ";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $category_id, $question, $answer);

        return mysqli_stmt_execute($stmt);
    }

    // ========================================
    // Update FAQ (Admin)
    // ========================================
    public function updateFAQ($faq_id, $category_id, $question, $answer) {
        $sql = "
            UPDATE faq 
            SET category_id = ?, question = ?, answer = ? 
            WHERE faq_id = ?
        ";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "issi", $category_id, $question, $answer, $faq_id);

        return mysqli_stmt_execute($stmt);
    }

    // ========================================
    // Delete FAQ (Admin)
    // ========================================
    public function deleteFAQ($faq_id) {
        $sql = "
            DELETE FROM faq 
            WHERE faq_id = ?
        ";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $faq_id);

        return mysqli_stmt_execute($stmt);
    }

    // ========================================
    // Create Question (Customer)
    // ========================================
    public function createQuestion($user_id, $category_id, $question) {
        $sql = "
            INSERT INTO faq_questions (user_id, category_id, question) 
            VALUES (?, ?, ?)
        ";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "iis", $user_id, $category_id, $question);

        return mysqli_stmt_execute($stmt);
    }

    // ========================================
    // Get All Questions (Admin)
    // ========================================
    public function getAllQuestions() {
        $sql = "
            SELECT f.*, u.full_name AS user_name, u.email AS user_email, c.name AS category_name 
            FROM faq_questions f 
            JOIN users u ON f.user_id = u.user_id 
            LEFT JOIN faq_categories c ON f.category_id = c.id 
            ORDER BY f.question_id DESC
        ";
        
        $result = mysqli_query($this->conn, $sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    // ========================================
    // Delete Question (Admin)
    // ========================================
    public function deleteQuestion($question_id) {
        $sql = "
            DELETE FROM faq_questions 
            WHERE question_id = ?
        ";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $question_id);

        return mysqli_stmt_execute($stmt);
    }
}
?>
