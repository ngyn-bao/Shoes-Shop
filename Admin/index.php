<?php
include_once "../config/db.php";

$total_products = $conn->query("SELECT COUNT(*) AS total_products FROM products")->fetch_assoc()['total_products'];
$total_orders   = $conn->query("SELECT COUNT(*) AS total_orders FROM orders")->fetch_assoc()['total_orders'];
$total_users    = $conn->query("SELECT COUNT(*) AS total_users FROM users")->fetch_assoc()['total_users'];
$total_contacts = $conn->query("SELECT COUNT(*) AS total_contacts FROM contacts")->fetch_assoc()['total_contacts'];
$total_articles = $conn->query("SELECT COUNT(*) AS total_articles FROM articles")->fetch_assoc()['total_articles'] ?? 0;
$total_faq      = $conn->query("SELECT COUNT(*) AS total_faq FROM faq")->fetch_assoc()['total_faq'] ?? 0;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Dashboard - Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

    <style>
        html, body { height: 100%; width: 100%; overflow-x: hidden; }
        .page { display: flex !important; flex-direction: row !important; width: 100%; min-height: 100vh; }
        .sidebar { flex-shrink: 0 !important; width: 260px; min-height: 100vh; }
        .page-wrapper { flex: 1; min-width: 0; display: flex; flex-direction: column; }
        
        .stat-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }
        .h1 { font-weight: 700; margin-bottom: 0; }
    </style>
</head>

<body class="theme-light">

    <div class="page">
        
        <?php include 'sidebar.php'; ?>

        <div class="page-wrapper">
            
            <div class="page-header d-print-none">
                <div class="container-xl"> <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">Tổng quan</div>
                            <h2 class="page-title">Dashboard</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">

                        <div class="col-sm-6 col-lg-3">
                            <div class="card stat-card bg-azure text-white" onclick="location.href='admin_user.php'">
                                <div class="card-body text-center">
                                    <i class="ti ti-users stat-icon"></i>
                                    <div class="h1"><?= $total_users; ?></div>
                                    <div class="font-weight-medium">Người dùng</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card stat-card bg-primary text-white" onclick="location.href='products.php'">
                                <div class="card-body text-center">
                                    <i class="ti ti-box stat-icon"></i>
                                    <div class="h1"><?= $total_products; ?></div>
                                    <div class="font-weight-medium">Sản phẩm</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card stat-card bg-green text-white" onclick="location.href='orders.php'">
                                <div class="card-body text-center">
                                    <i class="ti ti-shopping-cart stat-icon"></i>
                                    <div class="h1"><?= $total_orders; ?></div>
                                    <div class="font-weight-medium">Đơn hàng</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card stat-card bg-red text-white" onclick="location.href='contacts.php'">
                                <div class="card-body text-center">
                                    <i class="ti ti-mail stat-icon"></i>
                                    <div class="h1"><?= $total_contacts; ?></div>
                                    <div class="font-weight-medium">Liên hệ</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card stat-card bg-purple text-white" onclick="location.href='ArticleIndex.php'">
                                <div class="card-body text-center">
                                    <i class="ti ti-news stat-icon"></i>
                                    <div class="h1"><?= $total_articles; ?></div>
                                    <div class="font-weight-medium">Bài báo</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card stat-card bg-yellow text-white" onclick="location.href='admin_faq.php'">
                                <div class="card-body text-center">
                                    <i class="ti ti-help stat-icon"></i>
                                    <div class="h1"><?= $total_faq; ?></div>
                                    <div class="font-weight-medium">FAQ</div>
                                </div>
                            </div>
                        </div>

                    </div> </div>
            </div>

            <footer class="footer footer-transparent d-print-none mt-auto">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; 2025 <a href="." class="link-secondary">Shoes Shop Admin</a>.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const user = JSON.parse(localStorage.getItem("user"));
        if (!user || user.role !== "admin") {
            alert("Bạn phải là admin để truy cập trang này!");
            window.location.href = "../public/index.php";
        }
        
        // Nút Logout trong Sidebar đã được xử lý bởi sidebar.php, không cần viết lại
    </script>
</body>
</html>