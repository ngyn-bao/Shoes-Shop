<?php
require_once __DIR__ . '/../config/db.php';

class Contact
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public static function create($name, $email, $phone, $message)
    {
        global $conn;

        $stmt = $conn->prepare("
            INSERT INTO contacts(full_name, email, phone, message)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        return $stmt->execute();
    }

    public static function getAll()
    {
        global $conn;
        $result = $conn->query("SELECT * FROM contacts ORDER BY contact_id DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function updateStatus($id, $status)
    {
        global $conn;

        $stmt = $conn->prepare("UPDATE contacts SET status=? WHERE contact_id=?");
        $stmt->bind_param("si", $status, $id);

        return $stmt->execute();
    }

    public static function delete($id)
    {
        global $conn;

        $stmt = $conn->prepare("DELETE FROM contacts WHERE contact_id=?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
