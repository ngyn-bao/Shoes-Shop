<?php
include "../config/db.php"; // Kết nối DB

// Lấy danh sách người dùng
$query = $conn->query("SELECT user_id, full_name, email, phone, created_at FROM users ORDER BY created_at DESC");

// Xóa người dùng (nếu bạn dùng)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM users WHERE user_id = $id");
    header("Location: customers.php?deleted=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

    <!-- Tabler -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta19/dist/css/tabler.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

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

                    <li class="nav-item "><a class="nav-link text-white" href="admin_user.php"><i class="ti ti-user"></i><span class="ms-2 ">Quản lý người dùng</span></a></li>
                    <li class="nav-item "><a class="nav-link text-white" href="products.php"><i class="ti ti-box"></i><span class="ms-2">Quản lý sản phẩm</span></a></li>
                    <li class="nav-item "><a class="nav-link text-white" href="orders.php"><i class="ti ti-shopping-cart"></i><span class="ms-2">Quản lý đơn hàng</span></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="contacts.php"><i class="ti ti-mail"></i><span class="ms-2">Liên hệ</span></a></li>
                    <li class="nav-item "><a class="nav-link text-white" href="ArticleIndex.php"><i class="ti ti-news"></i><span class="ms-2">Bài báo</span></a></li>
                    <li class="nav-item "><a class="nav-link text-white" href="admin_faq.php"><i class="ti ti-question-mark"></i><span class="ms-2">FAQ</span></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="questions.php"><i class="ti ti-help"></i><span class="ms-2">Câu hỏi</span></a></li>
                </ul>

                <hr class="text-white">

                <button id="btnLogout" class="btn btn-danger w-100">Đăng xuất</button>
            </div>
        </aside>


        <!-- MAIN -->
        <div class="page-wrapper">
            <div class="container-xl">

                <h2 class="page-title my-4">👥 Danh sách người dùng</h2>

                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-success">Đã xoá người dùng!</div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">

                        <table class="table table-vcenter" id="userTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="./js/manage_users.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta19/dist/js/tabler.min.js"></script>
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