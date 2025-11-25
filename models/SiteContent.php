<?php
require_once __DIR__ . '/../config/db.php';

class SiteContent {

    public static function getPage($page) {
        global $conn; // lấy biến $conn từ db.php

        $stmt = $conn->prepare("
            SELECT content_id, title, content_html, image_url 
            FROM site_content 
            WHERE page_name = ?
        ");
        $stmt->bind_param("s", $page);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function update($id, $title, $html, $image) {
        global $conn;

        $stmt = $conn->prepare("
            UPDATE site_content 
            SET title=?, content_html=?, image_url=? 
            WHERE content_id=?
        ");
        $stmt->bind_param("sssi", $title, $html, $image, $id);

        return $stmt->execute();
    }

}
