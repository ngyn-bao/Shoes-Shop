<?php require_once '../config/db.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Quản lý Tin tức - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="./img/admin-icon.png">
    <style>
      html, body {
          height: 100%;
          width: 100%;
          overflow-x: hidden; 
      }

      .page {
          flex: 1;             
          width: 100%;         
          display: flex;       
          flex-direction: row; 
          min-height: 100vh;
      }

      .sidebar {
          width: 260px;
          min-height: 100vh;
          flex-shrink: 0;      
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
      
      @import url('https://rsms.me/inter/inter.css');
      :root { --tblr-font-sans-serif: 'Inter Var', sans-serif; }
      
      .title-cell {
          max-width: 300px;
          white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
      }
      .title-cell a { text-decoration: none; color: inherit; }
      .title-cell a:hover { text-decoration: underline; color: #0054a6; }
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
                <div class="page-pretitle">Tổng quan</div>
                <h2 class="page-title">Quản lý Tin tức</h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="comments.php" class="btn btn-white d-none d-sm-inline-block">
                    <i class="fas fa-comments me-2"></i> Bình luận
                  </a>
                  <a href="ArticleCreate.php" class="btn btn-primary d-none d-sm-inline-block">
                    <i class="fas fa-plus me-2"></i> Viết bài mới
                  </a>
                  <a href="ArticleCreate.php" class="btn btn-primary d-sm-none btn-icon">
                    <i class="fas fa-plus"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="page-body">
          <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách bài viết</h3>
              </div>
              
              <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>
                    <tr>
                      <th class="w-1">ID</th>
                      <th>Tiêu đề bài viết</th>
                      <th>Ngày đăng</th>
                      <th class="text-end">Hành động</th>
                    </tr>
                  </thead>
                  <tbody id="articlesTableBody">
                    </tbody>
                </table>
              </div>
              <div id="loading" class="text-center p-3">
                  <div class="spinner-border text-primary" role="status"></div>
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
    <script>
      const user = JSON.parse(localStorage.getItem("user"));
      if (!user || user["role"] !== "admin") {
        alert("Bạn phải là admin để truy cập trang này!");
        window.location.href = "../public/index.php";
      }

      fetch('../api/Articles/getAllArticles.php')
          .then(r => r.json())
          .then(articles => {
            const tbody = document.getElementById('articlesTableBody');
            document.getElementById('loading').style.display = 'none';
            tbody.innerHTML = '';
            
            if(articles.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center py-3">Chưa có bài viết nào</td></tr>';
                return;
            }

            articles.forEach(a => {
              tbody.innerHTML += `
            <tr>
              <td><span class="text-secondary">#${a.id}</span></td>
              <td class="title-cell">
                  <a href="ArticleEdit.php?id=${a.id}" class="fw-bold">${a.title}</a>
              </td>
              <td>${new Date(a.created_at).toLocaleDateString('vi-VN')}</td>
              <td class="text-end">
                <span class="dropdown">
                  <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Hành động</button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="../public/articledetail.php?id=${a.id}" target="_blank">Xem chi tiết</a>
                    <a class="dropdown-item" href="ArticleEdit.php?id=${a.id}">Chỉnh sửa</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#" onclick="deleteArticle(${a.id})">Xóa bài viết</a>
                  </div>
                </span>
              </td>
            </tr>`;
            });
          })
          .catch(err => {
              console.error(err);
              document.getElementById('loading').innerHTML = '<span class="text-danger">Lỗi tải dữ liệu</span>';
          });

      function deleteArticle(id) {
        if (confirm('Bạn có chắc chắn muốn xóa?')) {
          fetch('../api/Articles/deleteArticle.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + id
          }).then(r => r.json()).then(data => {
              if (data.success) { alert('Xóa thành công!'); location.reload(); } 
              else { alert('Lỗi: ' + data.message); }
          });
        }
      }
    </script>
  </body>
</html>