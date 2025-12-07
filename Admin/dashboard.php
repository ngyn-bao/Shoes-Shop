<?php
include "../config/db.php"; 

// Tổng sản phẩm
$result1 = $conn->query("SELECT COUNT(*) AS total_products FROM products");
$total_products = $result1->fetch_assoc()['total_products'];

// Tổng đơn hàng
$result2 = $conn->query("SELECT COUNT(*) AS total_orders FROM orders");
$total_orders = $result2->fetch_assoc()['total_orders'];

// Tổng khách hàng
$result3 = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$total_users = $result3->fetch_assoc()['total_users'];

// Tổng tin nhắn liên hệ
$result4 = $conn->query("SELECT COUNT(*) AS total_contacts FROM contacts");
$total_contacts = $result4->fetch_assoc()['total_contacts'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Shoes Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta19/dist/css/tabler.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

    <style>
        body { background: #f4f6fa; }
        .sidebar { height: 100vh; }
        .stat-card {
            transition: 0.25s ease;
            cursor: pointer;
            border-radius: 14px;
        }
        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 28px rgba(0,0,0,0.12);
        }
        .stat-icon {
            font-size: 42px;
            margin-bottom: 8px;
        }
    </style>
</head>

<body>

<div class="page">

    <!-- Sidebar -->
    <aside class="navbar navbar-vertical navbar-dark bg-dark navbar-expand-lg sidebar">
        <div class="container-fluid">

            <h2 class="navbar-brand text-white mt-3 mb-4">👟 Shoes Admin</h2>

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">
                        <i class="ti ti-home"></i>
                        <span class="ms-2">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="products.php">
                        <i class="ti ti-box"></i>
                        <span class="ms-2">Quản lý sản phẩm</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="orders.php">
                        <i class="ti ti-shopping-cart"></i>
                        <span class="ms-2">Quản lý đơn hàng</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="customers.php">
                        <i class="ti ti-users"></i>
                        <span class="ms-2">Khách hàng</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contacts.php">
                        <i class="ti ti-mail"></i>
                        <span class="ms-2">Liên hệ</span>
                    </a>
                </li>

            </ul>

            <hr class="text-white">

            <a href="#" class="btn btn-danger w-100">Đăng xuất</a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-xl">

            <h2 class="page-title my-4">📊 Dashboard Tổng Quan</h2>

            <div class="row row-cards">

                <!-- Tổng sản phẩm -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card bg-primary text-white" onclick="location.href='products.php'">
                        <div class="card-body text-center">
                            <i class="ti ti-box stat-icon"></i>
                            <div class="h1 mb-0"><?php echo $total_products; ?></div>
                            <div class="text-white">Tổng sản phẩm</div>
                        </div>
                    </div>
                </div>

                <!-- Tổng đơn hàng -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card bg-success text-white" onclick="location.href='orders.php'">
                        <div class="card-body text-center">
                            <i class="ti ti-shopping-cart stat-icon"></i>
                            <div class="h1 mb-0"><?php echo $total_orders; ?></div>
                            <div class="text-white">Tổng đơn hàng</div>
                        </div>
                    </div>
                </div>

                <!-- Tổng khách hàng -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card bg-warning text-dark" onclick="location.href='customers.php'">
                        <div class="card-body text-center">
                            <i class="ti ti-users stat-icon"></i>
                            <div class="h1 mb-0"><?php echo $total_users; ?></div>
                            <div class="text-dark">Tổng khách hàng</div>
                        </div>
                    </div>
                </div>

                <!-- Tổng tin nhắn liên hệ -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card stat-card bg-danger text-white" onclick="location.href='contacts.php'">
                        <div class="card-body text-center">
                            <i class="ti ti-mail stat-icon"></i>
                            <div class="h1 mb-0"><?php echo $total_contacts; ?></div>
                            <div class="text-white">Tin nhắn khách hàng</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta19/dist/js/tabler.min.js"></script>
</body>
</html>
