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
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>Sửa bài viết - Shoes Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            overflow-x: hidden;
        }

        .page {
            display: flex !important;
            flex-direction: row !important;
            width: 100%;
            min-height: 100vh;
        }

        .sidebar {
            flex-shrink: 0 !important;
            width: 260px;
            min-height: 100vh;
        }

        .page-wrapper {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        /* Style cho ảnh xem trước */
        .img-preview {
            max-height: 200px;
            border-radius: 4px;
            border: 1px solid #e6e7e9;
            padding: 4px;
            background: #fff;
        }
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
                            <h2 class="page-title">
                                Sửa bài viết #<?= $id ?>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">

                            <form id="editForm" class="card" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $id ?>">

                                <div class="card-header">
                                    <h4 class="card-title">Thông tin bài viết</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label required">Tiêu đề</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="<?= htmlspecialchars($article['title']) ?>" required
                                                    placeholder="Nhập tiêu đề bài viết">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Tóm tắt</label>
                                                <textarea name="excerpt" class="form-control" rows="3"
                                                    placeholder="Mô tả ngắn gọn..."><?= htmlspecialchars($article['excerpt']) ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label required">Nội dung chi tiết</label>
                                                <textarea name="content" class="form-control" rows="12"
                                                    required><?= htmlspecialchars($article['content']) ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Hình ảnh đại diện</label>
                                                <input type="file" name="image" id="imageInput" class="form-control"
                                                    accept="image/*">
                                                <div class="mt-3 text-center bg-light p-3 rounded border">
                                                    <div class="text-secondary small mb-2">Ảnh hiện tại</div>
                                                    <img id="previewImg" class="img-preview"
                                                        src="../public/<?= htmlspecialchars($article['image']) ?>"
                                                        alt="Preview" onerror="this.src='../public/img/no-image.jpg'">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <div class="d-flex">
                                        <a href="ArticleIndex.php" class="btn btn-link">Hủy bỏ</a>
                                        <button type="submit" class="btn btn-primary ms-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l5 5l10 -10" />
                                            </svg>
                                            Cập nhật bài viết
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
        const user = JSON.parse(localStorage.getItem("user"));
        if (!user || user["role"] !== "admin") {
            alert("Bạn phải là admin để truy cập trang này!");
            window.location.href = "../public/index.php";
        }
        // Logic xem trước ảnh
        document.getElementById('imageInput').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('previewImg').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Logic Submit
        document.getElementById('editForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const btn = this.querySelector('button[type="submit"]');
            const oldHtml = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Đang lưu...';

            try {
                const res = await fetch('../api/Articles/updateArticle.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    alert('Cập nhật thành công!');
                    window.location.href = 'ArticleIndex.php';
                } else {
                    alert('Lỗi: ' + data.message);
                }
            } catch (err) { alert('Lỗi kết nối!'); }
            finally { btn.disabled = false; btn.innerHTML = oldHtml; }
        });
    </script>
</body>

</html>