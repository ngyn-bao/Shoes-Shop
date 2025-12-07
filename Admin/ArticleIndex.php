<?php require_once '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Admin - Quản lý Tin tức</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    body { background: #f8f9fa; }
    .card { border-radius: 12px; }
    
    .title-cell {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    @media (max-width: 768px) {
        .title-cell {
            white-space: normal; 
            max-width: 150px;
            font-size: 0.9rem;
        }
        .btn-sm {
            padding: 0.25rem 0.4rem;
            font-size: 0.75rem;
        }
    }
  </style>
</head>

<body>
  <?php include 'sidebar.php'; ?>
  
  <div class="main-content">
      <div class="container-fluid py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
          <h2 class="text-primary m-0"><i class="fas fa-cog"></i> Quản lý Tin tức</h2>
          <a href="ArticleCreate.php" class="btn btn-success shadow w-100 w-md-auto">
            <i></i> Viết bài mới
          </a>
        </div>

        <div class="card shadow">
          <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-list"></i> Danh sách bài viết</h5>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover mb-0 align-middle">
                <thead class="table-secondary">
                  <tr>
                    <th class="d-none d-md-table-cell" width="80">ID</th>
                    
                    <th>Tiêu đề bài viết</th>
                    
                    <th class="d-none d-md-table-cell" width="150">Ngày đăng</th>
                    
                    <th width="180" class="text-center">Hành động</th>
                  </tr>
                </thead>
                <tbody id="articlesTableBody">
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="mt-4 text-center">
          <a href="comments.php" class="btn btn-lg btn-primary shadow w-100 w-md-auto">
            <i class="fas fa-comments"></i> Quản lý Bình luận
          </a>
        </div>
      </div>
  </div>

  <script>
    const user = JSON.parse(localStorage.getItem("user"));
    if (!user || user["role"] !== "admin") {
      alert("Bạn phải là admin để truy cập trang này!");
      window.location.href = "../public/index.php";
    }

    // Load danh sách bài viết
    fetch('../api/Articles/getAllArticles.php')
        .then(r => r.json())
        .then(articles => {
          const tbody = document.getElementById('articlesTableBody');
          tbody.innerHTML = '';
          
          if(articles.length === 0) {
              tbody.innerHTML = '<tr><td colspan="4" class="text-center py-3">Chưa có bài viết nào</td></tr>';
              return;
          }

          articles.forEach(a => {
            tbody.innerHTML += `
          <tr>
            <td class="d-none d-md-table-cell fw-bold">#${a.id}</td>
            
            <td class="title-cell" title="${a.title}">
                <span class="fw-medium">${a.title}</span>
                <div class="d-md-none text-muted small mt-1">
                    <i class="far fa-clock"></i> ${new Date(a.created_at).toLocaleDateString('vi-VN')}
                </div>
            </td>
            
            <td class="d-none d-md-table-cell">${new Date(a.created_at).toLocaleDateString('vi-VN')}</td>
            
            <td class="text-center">
                <div class="btn-group btn-group-sm">
                  <a href="../public/articledetail.php?id=${a.id}" target="_blank" class="btn btn-info text-white" title="Xem"><i class="fas fa-eye"></i></a>
                  <a href="ArticleEdit.php?id=${a.id}" class="btn btn-warning" title="Sửa"><i class="fas fa-edit"></i></a>
                  <button onclick="deleteArticle(${a.id})" class="btn btn-danger" title="Xóa"><i class="fas fa-trash"></i></button>
                </div>
            </td>
          </tr>`;
          });
        })
        .catch(err => console.error("Lỗi load bài viết:", err));

    function deleteArticle(id) {
      if (confirm('Bạn có chắc chắn muốn xóa bài viết này?')) {
        fetch('../api/Articles/deleteArticle.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
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