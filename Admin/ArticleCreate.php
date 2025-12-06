<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Viết bài mới - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow">
          <div class="card-header bg-success text-white">
            <h4 class="mb-0">Viết bài mới</h4>
          </div>
          <div class="card-body">
            <form id="createForm">
              <div class="mb-3">
                <label class="form-label fw-bold">Tiêu đề bài viết</label>
                <input type="text" name="title" class="form-control form-control-lg" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Link hình ảnh</label>
                <input type="url" name="image_url" class="form-control" placeholder="https://example.com/image.jpg">
              </div>

              <div class="mb-4">
                <label class="form-label fw-bold">Nội dung chi tiết</label>
                <textarea name="content" class="form-control" rows="15" required></textarea>
              </div>

              <div class="text-end">
                <a href="ArticleIndex.php" class="btn btn-secondary me-2">Hủy</a>
                <button type="submit" class="btn btn-success btn-lg px-5">Đăng bài</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('createForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const formData = new FormData(this);
      const btn = this.querySelector('button[type="submit"]');
      const oldText = btn.innerHTML;

      btn.disabled = true;
      btn.innerHTML = 'Đang đăng...';

      try {
        const response = await fetch('../api/Articles/createArticle.php', {
          method: 'POST',
          body: formData
        });

        const result = await response.json();
        console.log(result);

        if (result.success) {
          alert('Đăng bài thành công!');
          window.location.href = 'ArticleIndex.php';
        } else {
          alert('Lỗi: ' + (result.message || 'Không thể đăng bài'));
        }
      } catch (err) {
        alert('Lỗi kết nối API');
        console.error(err);
      } finally {
        btn.disabled = false;
        btn.innerHTML = oldText;
      }
    });
  </script>
</body>

</html>