<?php require_once '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý Bình luận - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h2 class="mb-4 text-primary"><i class="fas fa-comments"></i> Quản lý Bình luận</h2>

  <div class="card shadow">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th width="200">Bài viết</th>
              <th width="150">Người gửi</th>
              <th>Nội dung</th>
              <th width="140">Ngày</th>
              <th width="80">Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT c.*, a.title FROM comments c 
                    JOIN articles a ON c.article_id = a.id 
                    ORDER BY c.created_at DESC";
            $result = mysqli_query($conn, $sql);
            while ($c = mysqli_fetch_assoc($result)):
            ?>
            <tr>
              <td>
                <a href="../public/article_detail.php?id=<?= $c['article_id'] ?>" target="_blank" class="text-decoration-none">
                  <?= htmlspecialchars(mb_substr($c['title'], 0, 40)) ?>...
                </a>
              </td>
              <td><?= htmlspecialchars($c['name']) ?></td>
              <td><?= htmlspecialchars(mb_substr($c['content'], 0, 100)) ?>...</td>
              <td><?= date('d/m/Y H:i', strtotime($c['created_at'])) ?></td>
              <td>
                <button onclick="deleteComment(<?= $c['id'] ?>)" class="btn btn-sm btn-danger">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="mt-3 text-center">
    <a href="ArticleIndex.php" class="btn btn-secondary">Quay lại quản lý bài viết</a>
  </div>
</div>

<script>

function deleteComment(id) {
  if (confirm('Xóa bình luận này?')) {
    fetch('../api/Articles/deleteComment.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'id=' + id
    })
    .then(r => r.json())
    .then(d => d.success ? location.reload() : alert('Lỗi'))
  }
}
</script>
</body>
</html>