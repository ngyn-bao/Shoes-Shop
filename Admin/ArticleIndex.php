<?php require_once '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Admin - Quản lý Tin tức</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    body {
      background: #f8f9fa;
    }

    .card {
      border-radius: 12px;
    }

    .btn-sm i {
      font-size: 0.9rem;
    }
  </style>
</head>

<body>
  <div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-primary"><i class="fas fa-cog"></i> Quản lý Tin tức</h2>
      <a href="ArticleCreate.php" class="btn btn-success shadow">
        <i class="fas fa-plus"></i> Viết bài mới
      </a>
    </div>

    <div class="card shadow">
      <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><i class="fas fa-list"></i> Danh sách bài viết</h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="table-secondary">
              <tr>
                <th width="80">ID</th>
                <th>Tiêu đề bài viết</th>
                <th width="150">Ngày đăng</th>
                <th width="180" class="text-center">Hành động</th>
              </tr>
            </thead>
            <tbody id="articlesTableBody">
            </tbody>

            <script>
              fetch('../api/Articles/getAllArticles.php')
                .then(r => r.json())
                .then(articles => {
                  const tbody = document.getElementById('articlesTableBody');
                  tbody.innerHTML = '';
                  articles.forEach(a => {
                    tbody.innerHTML += `
                  <tr>
                    <td>#${a.article_id}</td>
                    <td>${a.title}</td>
                    <td>${new Date(a.created_at).toLocaleDateString('vi-VN')}</td>
                    <td class="text-center">
                      <a href="../public/articledetail.php?id=${a.article_id}" target="_blank" class="btn btn-sm btn-info">Xem</a>
                      <a href="./ArticleEdit.php?id=${a.article_id}" class="btn btn-sm btn-warning">Sửa</a>
                      <button onclick="deleteArticle(${a.article_id})" class="btn btn-sm btn-danger">Xóa</button>
                    </td>
                  </tr>`;
                  });
                });
            </script>
          </table>
        </div>
      </div>
    </div>

    <div class="mt-4 text-center">
      <a href="comments.php" class="btn btn-lg btn-primary shadow">
        <i class="fas fa-comments"></i> Quản lý Bình luận
      </a>
    </div>
  </div>

  <script>
    function deleteArticle(id) {
      if (confirm('Bạn có chắc chắn muốn xóa bài viết này?')) {
        fetch('../api/Articles/deleteArticle.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + id
          })
          .then(r => r.json())
          .then(data => {
            if (data.success) {
              alert('Xóa thành công!');
              location.reload();
            } else {
              alert('Lỗi: ' + (data.message || 'Không thể xóa'));
            }
          })
          .catch(() => alert('Lỗi kết nối'));
      }
    }
  </script>
</body>

</html>