<?php
// Dùng include_once để tránh lỗi nếu sidebar cũng gọi file này
include_once "../config/db.php"; 

// 1. Xử lý Xóa người dùng (Logic cũ của bạn)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Kiểm tra không cho xóa chính mình (nếu cần)
    // if ($id == $_SESSION['user']['user_id']) { alert... }
    
    $conn->query("DELETE FROM users WHERE user_id = $id");
    
    // Redirect bằng JS để tránh lỗi header sent
    echo "<script>alert('Đã xóa người dùng thành công!'); window.location.href='admin_user.php';</script>";
    exit;
}

// 2. Lấy danh sách người dùng
$users = [];
$query = "SELECT user_id, full_name, email, phone, role, created_at FROM users ORDER BY created_at DESC";
$result = $conn->query($query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
?>
<!doctype html>
<html lang="vi">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Quản lý người dùng - Shoes Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <style>
      html, body { height: 100%; width: 100%; overflow-x: hidden; }
      
      .page {
        display: flex !important;
        flex-direction: row !important; 
        width: 100%;
        min-height: 100vh;
      }

      .sidebar {
        flex-shrink: 0 !important;
        width: 260px;
        min-height: 100vh;
      }

      .page-wrapper {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
      }

      .container-fluid {
        width: 100% !important;
        max-width: 100% !important;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
      }
      
      .avatar-placeholder {
          width: 30px; height: 30px;
          background-color: #e6f7ff; color: #0054a6;
          border-radius: 50%; display: flex;
          align-items: center; justify-content: center;
          font-weight: bold; font-size: 0.8rem;
      }
    </style>
  </head>
  <body class="theme-light">
    
    <div class="page">
      
      <?php include 'sidebar.php'; ?>

      <div class="page-wrapper">
        
        <div class="page-header d-print-none">
          <div class="container-fluid">
            <div class="row g-2 align-items-center">
              <div class="col">
                <div class="page-pretitle">Admin</div>
                <h2 class="page-title">Quản lý người dùng</h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
                </div>
            </div>
          </div>
        </div>

        <div class="page-body">
          <div class="container-fluid">
            
            <?php if (isset($_GET['deleted'])): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  Đã xóa người dùng thành công!
                  <a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            <?php endif; ?>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách tài khoản (<?= count($users) ?>)</h3>
              </div>
              
              <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable" id="userTable">
                  <thead>
                    <tr>
                      <th class="w-1">ID</th>
                      <th>Họ tên</th>
                      <th>Email</th>
                      <th>Số điện thoại</th>
                      <th>Vai trò</th>
                      <th>Ngày tạo</th>
                      <th class="text-end">Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($users) > 0): ?>
                        <?php foreach ($users as $u): ?>
                        <tr>
                          <td><span class="text-secondary">#<?= $u['user_id'] ?></span></td>
                          <td>
                              <div class="d-flex py-1 align-items-center">
                                  <?php $initial = !empty($u['full_name']) ? mb_substr($u['full_name'], 0, 1) : '?'; ?>
                                  <span class="avatar-placeholder me-2"><?= strtoupper($initial) ?></span>
                                  <div class="flex-fill">
                                      <div class="font-weight-medium"><?= htmlspecialchars($u['full_name'] ?? 'Không tên') ?></div>
                                  </div>
                              </div>
                          </td>
                          <td>
                              <a href="mailto:<?= htmlspecialchars($u['email']) ?>" class="text-reset">
                                  <?= htmlspecialchars($u['email']) ?>
                              </a>
                          </td>
                          <td>
                              <?= htmlspecialchars($u['phone'] ?? '---') ?>
                          </td>
                          <td>
                              <?php if (($u['role'] ?? 'user') === 'admin'): ?>
                                  <span class="badge bg-red-lt">Admin</span>
                              <?php else: ?>
                                  <span class="badge bg-blue-lt">User</span>
                              <?php endif; ?>
                          </td>
                          <td>
                              <?= date('d/m/Y', strtotime($u['created_at'])) ?>
                          </td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Hành động</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Xem chi tiết</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#" onclick="confirmDelete(<?= $u['user_id'] ?>)">
                                  Xóa tài khoản
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center p-3">Chưa có người dùng nào.</td></tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              
              <div class="card-footer d-flex align-items-center">
                 <p class="m-0 text-secondary">Hiển thị <span><?= count($users) ?></span> kết quả</p>
              </div>

            </div>
          </div>
        </div>
        
        <footer class="footer footer-transparent d-print-none mt-auto">
          <div class="container-fluid">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2025 Shoes Shop.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    
    <script>
      const user = JSON.parse(localStorage.getItem("user"));
      if (!user || user.role !== "admin") {
          alert("Bạn phải là admin để truy cập trang này!");
          window.location.href = "../public/index.php";
      }

      function confirmDelete(id) {
          if (confirm('Bạn có chắc chắn muốn xóa người dùng này không? Hành động này không thể hoàn tác!')) {
              window.location.href = `admin_user.php?delete=${id}`;
          }
      }
    </script>
  </body>
</html>