<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Nạp composer autoload

use Dotenv\Dotenv;

// Tải file .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Lấy giá trị từ .env
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'] ?? 3307;
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';

// Cấu hình hiển thị lỗi
if ($_ENV['APP_DEBUG'] === 'true') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Kết nối MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname, $port);

// Kiểm tra kết nối
if (!$conn) {
    die("Connection failed to " . mysqli_connect_error());
}

// Thiết lập charset
mysqli_set_charset($conn, $charset);
