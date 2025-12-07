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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <style>
        body { background: #f8f9fa; }
        
        /* Tối ưu ảnh xem trước trên mobile */
        #previewImg {
            max-width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
        }

        /* Trên mobile, nút bấm sẽ to ra để dễ ấn */
        @media (max-width: 768px) {
            .form-actions {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .form-actions .btn {
                width: 100%; /* Nút full chiều ngang */
                padding: 12px; /* Nút cao hơn */
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body class="bg-light">
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div class="container-fluid py-3 py-md-4"> <div class="row">
                <div class="col-12">
                    <div class="card shadow border-0">
                        <div class="card-header bg-warning text-dark py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-edit"></i> Sửa bài viết #<?= $id ?></h5>
                        </div>
                        <div class="card-body p-3 p-md-4">
                            
                            <form id="editForm" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tiêu đề</label>
                                    <input type="text" name="title" class="form-control form-control-lg"
                                        value="<?= htmlspecialchars($article['title']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Hình ảnh</label>
                                    <input type="file" name="image" id="imageInput" class="form-control mb-2" accept="image/*">
                                    
                                    <div class="p-2 border rounded bg-light text-center">
                                        <p class="text-muted small mb-1">Ảnh hiện tại:</p>
                                        <img id="previewImg" src="../public/<?= htmlspecialchars($article['image']) ?>"
                                            alt="Preview"
                                            onerror="this.src='../public/img/no-image.jpg'">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tóm tắt</label>
                                    <textarea name="excerpt" class="form-control"
                                        rows="3"><?= htmlspecialchars($article['excerpt']) ?></textarea>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Nội dung</label>
                                    <textarea name="content" class="form-control" rows="15"
                                        required><?= htmlspecialchars($article['content']) ?></textarea>
                                </div>
                                
                                <div class="form-actions text-end">
                                    <a href="ArticleIndex.php" class="btn btn-secondary px-4">Hủy</a>
                                    <button type="submit" class="btn btn-warning px-5 fw-bold">Cập nhật</button>
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

        // Logic xem trước ảnh
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Logic gửi form
        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const btn = this.querySelector('button[type="submit"]');
            const oldText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang lưu...';

            try {
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
            } catch (err) {
                alert('Lỗi kết nối server!');
            } finally {
                btn.disabled = false;
                btn.innerHTML = oldText;
            }
        });
    </script>
</body>
</html>