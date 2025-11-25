<?php
require_once '../config/db.php';
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: ArticleIndex.php'); exit; }

$result = mysqli_query($conn, "SELECT * FROM articles WHERE id = $id");
$article = mysqli_fetch_assoc($result);
if (!$article) { echo "Bài viết không tồn tại!"; exit; }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Sửa bài viết - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow">
        <div class="card-header bg-warning text-dark">
          <h4 class="mb-0"><i class="fas fa-edit"></i> Sửa bài viết #<?= $id ?></h4>
        </div>
        <div class="card-body">
          <form action="../api/Articles/updateArticle.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
              <label class="form-label fw-bold">Tiêu đề</label>
              <input type="text" name="title" class="form-control form-control-lg" value="<?= htmlspecialchars($article['title']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Hình ảnh</label>
              <input type="url" name="image" class="form-control" value="<?= htmlspecialchars($article['image']) ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Tóm tắt</label>
              <textarea name="excerpt" class="form-control" rows="3"><?= htmlspecialchars($article['excerpt']) ?></textarea>
            </div>
            <div class="mb-4">
              <label class="form-label fw-bold">Nội dung</label>
              <textarea name="content" class="form-control" rows="15" required><?= htmlspecialchars($article['content']) ?></textarea>
            </div>
            <div class="text-end">
              <a href="ArticleIndex.php" class="btn btn-secondary me-2">Hủy</a>
              <button type="submit" class="btn btn-warning btn-lg px-5">Cập nhật</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
fetch('../api/Articles/getArticle.php?id=<?= $id ?>')
  .then(r => r.json())
  .then(article => {
    document.querySelector('[name="title"]').value = article.title || '';
    document.querySelector('[name="image"]').value = article.image || '';
    document.querySelector('[name="excerpt"]').value = article.excerpt || '';
    document.querySelector('[name="content"]').value = article.content || '';
  });

document.querySelector('form').onsubmit = async function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  const res = await fetch('../api/Articles/updateArticle.php', {
    method: 'POST',
    body: formData
  });
  const data = await res.json();

  if (data.success) {
    alert('Cập nhật thành công!');
    window.location.href = 'ArticleIndex.php';
  } else {
    alert('Lỗi: ' + data.message);
  }
};
</script>
</body>
</html>