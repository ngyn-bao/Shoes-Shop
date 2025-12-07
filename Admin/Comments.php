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

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Quản lý Bình luận - Admin</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <style>
      html, body { height: 100%; width: 100%; overflow-x: hidden; }
      .page { display: flex !important; flex-direction: row !important; width: 100%; min-height: 100vh; }
      .sidebar { flex-shrink: 0 !important; width: 260px; min-height: 100vh; }
      .page-wrapper { flex: 1; min-width: 0; display: flex; flex-direction: column; }
      
      .avatar-placeholder {
          width: 32px; height: 32px;
          background-color: #f1f5f9;
          color: #64748b;
          border-radius: 50%;
          display: flex; align-items: center; justify-content: center;
          font-weight: 600; font-size: 0.85rem;
          text-transform: uppercase;
      }
      
      .content-cell {
          max-width: 350px;
          white-space: normal; 
          font-size: 0.9rem;
          color: #666;
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
                <div class="page-pretitle">Blog</div>
                <h2 class="page-title">
                  Quản lý Bình luận
                </h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <a href="ArticleIndex.php" class="btn btn-outline-secondary d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                  Quay lại bài viết
                </a>
                <a href="ArticleIndex.php" class="btn btn-outline-secondary d-sm-none btn-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="page-body">
          <div class="container-fluid">
            
            <div class="card d-none d-md-block">
              <div class="card-header">
                <h3 class="card-title">Danh sách bình luận (<?= count($comments) ?>)</h3>
              </div>
              <div class="table-responsive">
                <table class="table card-table table-vcenter datatable">
                  <thead>
                    <tr>
                      <th class="w-1">ID</th>
                      <th>Người gửi</th>
                      <th>Nội dung bình luận</th>
                      <th>Bài viết</th>
                      <th>Ngày gửi</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($comments) > 0): ?>
                        <?php foreach ($comments as $c): ?>
                        <tr>
                          <td><span class="text-secondary">#<?= $c['id'] ?></span></td>
                          <td>
                              <div class="d-flex py-1 align-items-center">
                                  <div class="avatar-placeholder me-2"><?= substr($c['name'], 0, 1) ?></div>
                                  <div class="flex-fill">
                                      <div class="font-weight-medium"><?= htmlspecialchars($c['name']) ?></div>
                                  </div>
                              </div>
                          </td>
                          <td class="content-cell">
                              <?= htmlspecialchars($c['content']) ?>
                          </td>
                          <td>
                              <a href="../public/articledetail.php?id=<?= $c['article_id'] ?>" target="_blank" class="text-reset">
                                  <?= htmlspecialchars(mb_substr($c['title'], 0, 30)) ?>...
                              </a>
                          </td>
                          <td class="text-nowrap text-secondary">
                              <?= date('d/m/Y H:i', strtotime($c['created_at'])) ?>
                          </td>
                          <td class="text-end">
                            <button class="btn btn-ghost-danger btn-icon" onclick="deleteComment(<?= $c['id'] ?>)" title="Xóa">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </button>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center py-4">Chưa có bình luận nào.</td></tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="d-md-none">
                <?php if (count($comments) > 0): ?>
                    <?php foreach ($comments as $c): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-placeholder me-2 bg-azure text-white"><?= substr($c['name'], 0, 1) ?></div>
                                    <div>
                                        <div class="fw-bold"><?= htmlspecialchars($c['name']) ?></div>
                                        <div class="text-secondary small"><?= date('d/m/Y', strtotime($c['created_at'])) ?></div>
                                    </div>
                                </div>
                                <button class="btn btn-action text-danger" onclick="deleteComment(<?= $c['id'] ?>)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </button>
                            </div>
                            
                            <div class="bg-muted-lt p-2 rounded mb-2 text-dark">
                                "<?= htmlspecialchars($c['content']) ?>"
                            </div>
                            
                            <div class="text-end">
                                <span class="text-secondary small">Bài viết:</span>
                                <a href="../public/articledetail.php?id=<?= $c['article_id'] ?>" class="fw-bold text-azure ms-1">
                                    <?= htmlspecialchars(mb_substr($c['title'], 0, 25)) ?>...
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty">
                        <div class="empty-icon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" /><path d="M12 12l0 .01" /><path d="M8 12l0 .01" /><path d="M16 12l0 .01" /></svg></div>
                        <p class="empty-title">Chưa có bình luận nào</p>
                    </div>
                <?php endif; ?>
            </div>

          </div>
        </div>

        <footer class="footer footer-transparent d-print-none">
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
                  if(d.success) { location.reload(); } 
                  else { alert('Lỗi: ' + (d.message || 'Không thể xóa')); }
              })
              .catch(() => alert('Lỗi kết nối'));
          }
      }
    </script>
  </body>
</html>