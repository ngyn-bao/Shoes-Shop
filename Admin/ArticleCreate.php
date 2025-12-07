<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Viết bài mới - Shoes Shop Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <style>
      html, body { height: 100%; width: 100%; overflow-x: hidden; }
      .page { display: flex !important; flex-direction: row !important; width: 100%; min-height: 100vh; }
      .sidebar { flex-shrink: 0 !important; width: 260px; min-height: 100vh; }
      .page-wrapper { flex: 1; min-width: 0; display: flex; flex-direction: column; }
      
      .img-preview-box {
          background-color: #f8fafc;
          border: 1px dashed #ced4da;
          border-radius: 4px;
          min-height: 150px;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 10px;
      }
      #previewImg {
          max-height: 200px;
          max-width: 100%;
          border-radius: 4px;
          display: none; 
      }
      .placeholder-text { color: #adb5bd; font-size: 0.9rem; }
    </style>
  </head>
  <body class="theme-light">
    
    <div class="page">
      <?php include 'sidebar.php'; ?>

      <div class="page-wrapper">
        
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <div class="page-pretitle">Blog</div>
                <h2 class="page-title">
                  Viết bài mới
                </h2>
              </div>
            </div>
          </div>
        </div>

        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-12">
                
                <form id="createForm" class="card" enctype="multipart/form-data">
                  <div class="card-header">
                    <h3 class="card-title">Nội dung bài viết</h3>
                  </div>
                  
                  <div class="card-body">
                    <div class="row">
                      
                      <div class="col-lg-8">
                        <div class="mb-3">
                          <label class="form-label required">Tiêu đề bài viết</label>
                          <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề..." required>
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label">Tóm tắt ngắn</label>
                          <textarea name="excerpt" class="form-control" rows="3" placeholder="Mô tả ngắn gọn về nội dung..."></textarea>
                          <small class="form-hint">Hiển thị ở trang danh sách bài viết.</small>
                        </div>

                        <div class="mb-3">
                          <label class="form-label required">Nội dung chi tiết</label>
                          <textarea name="content" class="form-control" rows="15" required placeholder="Viết nội dung ở đây..."></textarea>
                        </div>
                      </div>

                      <div class="col-lg-4">
                         <div class="mb-3">
                            <label class="form-label required">Hình ảnh đại diện</label>
                            <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                            
                            <div class="mt-3 img-preview-box">
                                <span class="placeholder-text" id="placeholderText">Chưa chọn ảnh</span>
                                <img id="previewImg" src="" alt="Preview">
                            </div>
                         </div>
                      </div>

                    </div>
                  </div>
                  
                  <div class="card-footer text-end">
                    <div class="d-flex">
                      <a href="ArticleIndex.php" class="btn btn-link">Hủy bỏ</a>
                      <button type="submit" class="btn btn-primary ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Đăng bài viết
                      </button>
                    </div>
                  </div>

                </form>

              </div>
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
        // Check quyền
        const user = JSON.parse(localStorage.getItem("user"));
        if (!user || user["role"] !== "admin") {
           alert("Bạn phải là admin để truy cập trang này!");
           window.location.href = "../public/index.php";
        }

        // Logic Preview Ảnh
        const imageInput = document.getElementById('imageInput');
        const previewImg = document.getElementById('previewImg');
        const placeholderText = document.getElementById('placeholderText');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                    placeholderText.style.display = 'none';
                }
                reader.readAsDataURL(file);
            } else {
                previewImg.src = '';
                previewImg.style.display = 'none';
                placeholderText.style.display = 'block';
            }
        });

        // Logic Submit Form
        document.getElementById('createForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const btn = this.querySelector('button[type="submit"]');
            const oldHtml = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Đang xử lý...';

            try {
                const res = await fetch('../api/Articles/createArticle.php', { method: 'POST', body: formData });
                const data = await res.json();
                
                if (data.success) {
                    alert('Đăng bài thành công!');
                    window.location.href = 'ArticleIndex.php';
                } else {
                    alert('Lỗi: ' + (data.message || 'Không thể đăng bài'));
                }
            } catch (err) {
                console.error(err);
                alert('Lỗi kết nối server!');
            } finally {
                btn.disabled = false;
                btn.innerHTML = oldHtml;
            }
        });
    </script>
  </body>
</html>