<?php 
require_once '../config/db.php'; 

$sql = "SELECT c.*, a.title 
        FROM comments c 
        JOIN articles a ON c.article_id = a.id 
        ORDER BY c.created_at DESC";
$result = mysqli_query($conn, $sql);
$comments = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Quản lý Bình luận - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
      body { background: #f8f9fa; }
      .card { border: none; border-radius: 12px; }
      .avatar-placeholder {
          width: 35px; height: 35px;
          background-color: #e9ecef;
          color: #495057;
          border-radius: 50%;
          display: flex; align-items: center; justify-content: center;
          font-weight: bold; font-size: 0.9rem;
      }
  </style>
</head>

<body class="bg-light">
  <?php include 'sidebar.php'; ?>
  
  <div class="main-content">
      <div class="container-fluid py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary m-0 fw-bold"><i class="fas fa-comments"></i> Quản lý Bình luận</h2>
            <a href="ArticleIndex.php" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> <span class="d-none d-md-inline">Quay lại bài viết</span>
            </a>
        </div>

        <div class="card shadow d-none d-md-block">
          <div class="card-header bg-dark text-white py-3">
             <h5 class="mb-0"><i class="fas fa-list"></i> Danh sách bình luận</h5>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover mb-0 align-middle">
                <thead class="table-secondary">
                  <tr>
                    <th width="25%">Bài viết</th>
                    <th width="15%">Người gửi</th>
                    <th>Nội dung</th>
                    <th width="15%">Ngày</th>
                    <th width="80" class="text-center">Xóa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($comments) > 0): ?>
                      <?php foreach ($comments as $c): ?>
                      <tr>
                        <td>
                          <a href="../public/articledetail.php?id=<?= $c['article_id'] ?>" target="_blank" class="text-decoration-none fw-bold text-dark">
                            <?= htmlspecialchars(mb_substr($c['title'], 0, 40)) ?>...
                          </a>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-placeholder me-2"><?= strtoupper(substr($c['name'], 0, 1)) ?></div>
                                <?= htmlspecialchars($c['name']) ?>
                            </div>
                        </td>
                        <td class="text-muted"><?= htmlspecialchars(mb_substr($c['content'], 0, 80)) ?>...</td>
                        <td><?= date('d/m/Y H:i', strtotime($c['created_at'])) ?></td>
                        <td class="text-center">
                          <button onclick="deleteComment(<?= $c['id'] ?>)" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr><td colspan="5" class="text-center py-4">Chưa có bình luận nào.</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="d-md-none">
            <?php if (count($comments) > 0): ?>
                <?php foreach ($comments as $c): ?>
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex align-items-center">
                                <div class="avatar-placeholder me-2 bg-primary text-white"><?= strtoupper(substr($c['name'], 0, 1)) ?></div>
                                <div>
                                    <span class="fw-bold d-block"><?= htmlspecialchars($c['name']) ?></span>
                                    <small class="text-muted" style="font-size: 0.8rem"><?= date('d/m/Y', strtotime($c['created_at'])) ?></small>
                                </div>
                            </div>
                            <button onclick="deleteComment(<?= $c['id'] ?>)" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        
                        <p class="mb-2 bg-light p-2 rounded text-secondary fst-italic">
                            "<?= htmlspecialchars($c['content']) ?>"
                        </p>

                        <div class="text-end">
                            <small class="text-muted me-1">Tại bài:</small>
                            <a href="../public/articledetail.php?id=<?= $c['article_id'] ?>" class="text-decoration-none fw-bold">
                                <?= htmlspecialchars(mb_substr($c['title'], 0, 30)) ?>... <i class="fas fa-external-link-alt small"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center text-muted py-5">Chưa có bình luận nào.</div>
            <?php endif; ?>
        </div>

      </div>
  </div>

  <script>
    const user = JSON.parse(localStorage.getItem("user"));
    if (!user || user["role"] !== "admin") {
      alert("Bạn phải là admin để truy cập trang này!");
      window.location.href = "../public/index.php";
    }

    function deleteComment(id) {
      if (confirm('Bạn chắc chắn muốn xóa bình luận này?')) {
        fetch('../api/Articles/deleteComment.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'id=' + id
        })
          .then(r => r.json())
          .then(d => {
              if(d.success) {
                  location.reload();
              } else {
                  alert('Lỗi: ' + (d.message || 'Không thể xóa'));
              }
          })
          .catch(() => alert('Lỗi kết nối'));
      }
    }
  </script>
</body>
</html>