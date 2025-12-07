<?php
include "../config/db.php";

// Tổng sản phẩm
$total_products = $conn->query("SELECT COUNT(*) AS total_products FROM products")->fetch_assoc()['total_products'];

// Tổng đơn hàng
$total_orders = $conn->query("SELECT COUNT(*) AS total_orders FROM orders")->fetch_assoc()['total_orders'];

// Tổng người dùng
$total_users = $conn->query("SELECT COUNT(*) AS total_users FROM users")->fetch_assoc()['total_users'];

// Tổng liên hệ
$total_contacts = $conn->query("SELECT COUNT(*) AS total_contacts FROM contacts")->fetch_assoc()['total_contacts'];

// Tổng bài báo
$total_articles = $conn->query("SELECT COUNT(*) AS total_articles FROM articles")->fetch_assoc()['total_articles'] ?? 0;

// Tổng câu hỏi FAQ
$total_faq = $conn->query("SELECT COUNT(*) AS total_faq FROM faq")->fetch_assoc()['total_faq'] ?? 0;

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shoes Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta19/dist/css/tabler.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fa;
        }

        .stat-card {
            cursor: pointer;
            transition: 0.25s ease;
            border-radius: 14px;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 26px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="page">

        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-dark bg-dark navbar-expand-lg">
            <div class="container-fluid">

                <h2 class="navbar-brand text-white mt-3 mb-4">👟 Shoes Admin</h2>

                <ul class="navbar-nav sidebar-menu">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="ti ti-home"></i>
                            <span class="ms-2">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item"><a class="nav-link text-white" href="admin_user.php"><i class="ti ti-user"></i><span class="ms-2">Quản lý người dùng</span></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="products.php"><i class="ti ti-box"></i><span class="ms-2">Quản lý sản phẩm</span></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="orders.php"><i class="ti ti-shopping-cart"></i><span class="ms-2">Quản lý đơn hàng</span></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="contacts.php"><i class="ti ti-mail"></i><span class="ms-2">Liên hệ</span></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="ArticleIndex.php"><i class="ti ti-news"></i><span class="ms-2">Bài báo</span></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="faq.php"><i class="ti ti-question-mark"></i><span class="ms-2">FAQ</span></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="questions.php"><i class="ti ti-help"></i><span class="ms-2">Câu hỏi</span></a></li>
                </ul>

                <hr class="text-white">

                <button id="btnLogout" class="btn btn-danger w-100">Đăng xuất</button>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-xl">

                <h2 class="page-title my-4">📊 Dashboard Tổng Quan</h2>

                <div class="row row-cards">

                    <!-- User -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card stat-card bg-info text-white" onclick="location.href='admin_user.php'">
                            <div class="card-body text-center">
                                <i class="ti ti-user stat-icon"></i>
                                <div class="h1"><?php echo $total_users; ?></div>
                                <div>Users</div>
                            </div>
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card stat-card bg-primary text-white" onclick="location.href='products.php'">
                            <div class="card-body text-center">
                                <i class="ti ti-box stat-icon"></i>
                                <div class="h1"><?php echo $total_products; ?></div>
                                <div>Sản phẩm</div>
                            </div>
                        </div>
                    </div>

                    <!-- Orders -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card stat-card bg-success text-white" onclick="location.href='orders.php'">
                            <div class="card-body text-center">
                                <i class="ti ti-shopping-cart stat-icon"></i>
                                <div class="h1"><?php echo $total_orders; ?></div>
                                <div>Đơn hàng</div>
                            </div>
                        </div>
                    </div>

                    <!-- Contacts -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card stat-card bg-danger text-white" onclick="location.href='contacts.php'">
                            <div class="card-body text-center">
                                <i class="ti ti-mail stat-icon"></i>
                                <div class="h1"><?php echo $total_contacts; ?></div>
                                <div>Liên hệ</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="row row-cards mt-4">

                    <!-- Articles -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card stat-card bg-secondary text-white" onclick="location.href='ArticleIndex.php'">
                            <div class="card-body text-center">
                                <i class="ti ti-news stat-icon"></i>
                                <div class="h1"><?php echo $total_articles; ?></div>
                                <div>Bài báo</div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card stat-card bg-warning text-dark" onclick="location.href='admin_faq.php'">
                            <div class="card-body text-center">
                                <i class="ti ti-question-mark stat-icon"></i>
                                <div class="h1"><?php echo $total_faq; ?></div>
                                <div>FAQ</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>

    <script>
        // Lấy user từ localStorage
        const user = JSON.parse(localStorage.getItem("user"));

        if (!user || user.role !== "admin") {
            alert("Bạn phải là admin để truy cập trang này!");
            window.location.href = "../public/index.php";
        }

        // Logout
        document.getElementById("btnLogout").addEventListener("click", async () => {
            try {
                const res = await axios.post("../api/Authentication/logout.php");

                if (res.data.success) {
                    localStorage.removeItem("user");
                    localStorage.removeItem("cart");

                    alert("Đăng xuất thành công!");
                    window.location.href = "../public/login.php";
                }
            } catch (err) {
                alert("Server error!");
            }
        });
    </script>

</body>

</html>