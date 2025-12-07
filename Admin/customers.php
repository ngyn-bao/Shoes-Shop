<?php
include "../config/db.php"; // Kết nối DB

// Lấy danh sách khách hàng
$query = $conn->query("SELECT user_id, full_name, email, phone, created_at FROM users ORDER BY created_at DESC");

// Xóa khách hàng (nếu bạn dùng)
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
    <title>Quản lý khách hàng - Shoes Shop Admin</title>

    <!-- Tabler -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta19/dist/css/tabler.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

</head>
<body>

<div class="page">

    <!-- SIDEBAR -->
    <aside class="navbar navbar-vertical navbar-dark bg-dark navbar-expand-lg sidebar">
        <div class="container-fluid">

            <h2 class="navbar-brand text-white mt-3 mb-4">👟 Shoes Admin</h2>

            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="ti ti-home"></i><span class="ms-2">Dashboard</span></a></li>
                <li class="nav-item"><a class="nav-link" href="products.php"><i class="ti ti-box"></i><span class="ms-2">Sản phẩm</span></a></li>
                <li class="nav-item"><a class="nav-link" href="orders.php"><i class="ti ti-shopping-cart"></i><span class="ms-2">Đơn hàng</span></a></li>
                <li class="nav-item"><a class="nav-link active" href="customers.php"><i class="ti ti-users"></i><span class="ms-2">Khách hàng</span></a></li>
                <li class="nav-item"><a class="nav-link" href="contacts.php"><i class="ti ti-mail"></i><span class="ms-2">Liên hệ</span></a></li>
            </ul>

            <hr class="text-white">
            <a class="btn btn-danger w-100" href="#">Đăng xuất</a>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="page-wrapper">
        <div class="container-xl">

            <h2 class="page-title my-4">👥 Danh sách khách hàng</h2>

            <?php if (isset($_GET['deleted'])): ?>
                <div class="alert alert-success">Đã xoá khách hàng!</div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">

                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Ngày tạo</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php while ($row = $query->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['user_id']; ?></td>

                                <td>
                                    <strong><?php echo $row['full_name']; ?></strong>
                                </td>

                                <td><?php echo $row['email']; ?></td>

                                <td><?php echo $row['phone']; ?></td>

                                <td><?php echo date("d/m/Y H:i", strtotime($row['created_at'])); ?></td>

                                <td class="text-center">
                                    <a href="customers.php?delete=<?php echo $row['user_id']; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Bạn chắc chắn muốn xoá khách hàng này?')">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta19/dist/js/tabler.min.js"></script>
</body>
</html>
