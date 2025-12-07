<?php
require_once '../config/db.php';
$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
  header('Location: ArticleIndex.php');
  exit;
}
$result = mysqli_query($conn, "SELECT * FROM articles WHERE id = $id");
$article = mysqli_fetch_assoc($result);
if (!$article) {
  echo "Bài viết không tồn tại!";
  exit;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Sửa bài viết - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body class="bg-light">
  <?php include 'sidebar.php'; ?>

  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-header bg-warning text-dark">
              <h4 class="mb-0"><i class="fas fa-edit"></i> Sửa bài viết #<?= $id ?></h4>
            </div>
            <div class="card-body">
              <form id="editForm" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="mb-3">
                  <label class="form-label fw-bold">Tiêu đề</label>
                  <input type="text" name="title" class="form-control form-control-lg"
                    value="<?= htmlspecialchars($article['title']) ?>" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">Hình ảnh</label>
                  <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                  <div class="mt-3 p-2 border rounded bg-white text-center" style="width: fit-content">
                    <p class="text-muted small mb-1">Ảnh hiện tại:</p>
                    <img id="previewImg" src="../public/<?= htmlspecialchars($article['image']) ?>" alt="Preview"
                      style="max-height: 200px; max-width: 100%; border-radius: 5px;"
                      onerror="this.src='../public/img/no-image.jpg'">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Tóm tắt</label>
                  <textarea name="excerpt" class="form-control"
                    rows="3"><?= htmlspecialchars($article['excerpt']) ?></textarea>
                </div>
                <div class="mb-4">
                  <label class="form-label fw-bold">Nội dung</label>
                  <textarea name="content" class="form-control" rows="15"
                    required><?= htmlspecialchars($article['content']) ?></textarea>
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
  </div>
  <script>
    document.getElementById('imageInput').addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) { document.getElementById('previewImg').src = e.target.result; }
        reader.readAsDataURL(file);
      }
    });

    document.getElementById('editForm').addEventListener('submit', async function (e) {
      e.preventDefault();
      const formData = new FormData(this);
      const btn = this.querySelector('button[type="submit"]');
      const oldText = btn.innerHTML;
      btn.disabled = true; btn.innerHTML = 'Đang lưu...';

      try {
        const res = await fetch('../api/Articles/updateArticle.php', { method: 'POST', body: formData });
        const data = await res.json();
        if (data.success) {
          alert('Cập nhật thành công!');
          window.location.href = 'ArticleIndex.php';
        } else {
          alert('Lỗi: ' + data.message);
        }
      } catch (err) { alert('Lỗi kết nối server!'); }
      finally { btn.disabled = false; btn.innerHTML = oldText; }
    });
  </script>
</body>

</html>