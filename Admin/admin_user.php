<?php require_once '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý Người dùng - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./img/admin-icon.png">
</head>

<body class="bg-light">
    <?php include 'sidebar.php'; ?>
    <div class="container mt-4">
        <h3>User Management</h3>

        <table class="table table-bordered mt-3" id="userTable">
            <thead class="table-dark">
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

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="./js/manage_users.js"></script>
    <script>
        const user = JSON.parse(localStorage.getItem("user"));
        if (user["role"] !== "admin") {
            alert("Bạn phải là admin để truy cập trang này!");
            window.location.href = "../public/index.php";
        }
    </script>
</body>

</html>