<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Viết bài mới - Admin</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  
  <style>
    @media (max-width: 768px) {
        .btn {
            width: 100%; 
            margin-bottom: 10px;
            padding: 12px; 
        }
        .text-end {
            text-align: center !important; 
        }
    }
  </style>
</head>

<body class="bg-light">
  <?php include 'sidebar.php'; ?>

  <div class="main-content">

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-header bg-success text-white">
              <h4 class="mb-0">Viết bài mới</h4>
            </div>
            <div class="card-body">
              <form id="createForm" enctype="multipart/form-data">
                <div class="mb-3">
                  <label class="form-label fw-bold">Tiêu đề bài viết</label>
                  <input type="text" name="title" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">Hình ảnh đại diện</label>
                  <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                  <div id="imagePreview" class="mt-3 d-none p-2 border rounded bg-light text-center">
                    <img src="" alt="Preview" style="max-height: 250px; max-width: 100%; border-radius: 5px;">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Tóm tắt</label>
                  <textarea name="excerpt" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-4">
                  <label class="form-label fw-bold">Nội dung chi tiết</label>
                  <textarea name="content" class="form-control" rows="15" required></textarea>
                </div>
                
                <div class="text-end">
                  <a href="ArticleIndex.php" class="btn btn-secondary me-md-2">Hủy</a>
                  <button type="submit" class="btn btn-success btn-lg px-5">Đăng bài</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    const user = JSON.parse(localStorage.getItem("user"));
    if (!user || user["role"] !== "admin") {
      alert("Bạn phải là admin để truy cập trang này!");
      window.location.href = "../public/index.php";
    }

    document.getElementById('imageInput').addEventListener('change', function (e) {
      const file = e.target.files[0];
      const previewContainer = document.getElementById('imagePreview');
      const previewImage = previewContainer.querySelector('img');
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewImage.src = e.target.result;
          previewContainer.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
      } else {
        previewContainer.classList.add('d-none');
      }
    });

    document.getElementById('createForm').addEventListener('submit', async function (e) {
      e.preventDefault();
      const formData = new FormData(this);
      const btn = this.querySelector('button[type="submit"]');
      const oldText = btn.innerHTML;
      btn.disabled = true; btn.innerHTML = 'Đang đăng...';

      try {
        const response = await fetch('../api/Articles/createArticle.php', { method: 'POST', body: formData });
        const result = await response.json();
        if (result.success) {
          alert('Đăng bài thành công!');
          window.location.href = 'ArticleIndex.php';
        } else {
          alert('Lỗi: ' + (result.message || 'Không thể đăng'));
        }
      } catch (err) { alert('Lỗi kết nối!'); }
      finally { btn.disabled = false; btn.innerHTML = oldText; }
    });
  </script>
</body>

</html>