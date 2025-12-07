<?php
require_once '../config/db.php';

$limit = 6; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$start = ($page - 1) * $limit;

$totalResults = mysqli_query($conn, "SELECT COUNT(id) AS id FROM articles");
$totalCount = mysqli_fetch_assoc($totalResults)['id'];
$totalPages = ceil($totalCount / $limit);

$sql = "SELECT id, title, image, excerpt, created_at FROM articles ORDER BY created_at DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}

$posts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $posts[] = $row;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tin tức & Bài viết - Shoes Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>
    <?php include './includes/header.php'; ?>

    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="m-0">Tin tức & Bài viết</h1>
        </div>
    </header>

    <section class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control border-start-0"
                        placeholder="Tìm kiếm bài viết trên trang này..." autocomplete="off">
                </div>
            </div>
        </div>
    </section>

    <main class="container my-5">
        <div class="row g-4" id="postsContainer">
            <?php if (count($posts) > 0): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="col-md-4 post-card" data-title="<?= strtolower(htmlspecialchars($post['title'])) ?>"
                        data-excerpt="<?= strtolower(htmlspecialchars($post['excerpt'])) ?>">
                        <div class="card h-100 shadow-sm">
                            <img src="../public/<?= htmlspecialchars($post['image']) ?>" class="card-img-top"
                                style="height:200px; object-fit:cover;" onerror="this.src='../public/img/no-image.jpg'">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                                <p class="card-text text-muted flex-grow-1">
                                    <?= htmlspecialchars($post['excerpt'] ?: 'Xem chi tiết...') ?>
                                </p>
                                <div class="mt-auto">
                                    <small class="text-muted">
                                        <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                                    </small>
                                    <a href="articledetail.php?id=<?= $post['id'] ?>"
                                        class="btn btn-dark btn-sm d-block mt-2">Đọc tiếp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Hiện chưa có bài viết nào.</p>
            <?php endif; ?>
        </div>

        <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation" class="mt-5">
                <ul class="pagination justify-content-center">   
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>

        <div id="noResults" class="text-center mt-5 d-none">
            <p class="text-muted fs-4">Không tìm thấy bài viết nào.</p>
        </div>
    </main>

    <?php include './includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase().trim();
                var hasResult = false;
                $(".post-card").each(function() {
                    var title = $(this).data("title"); 
                    var excerpt = $(this).data("excerpt");
                    if (title.indexOf(value) > -1 || excerpt.indexOf(value) > -1) {
                        $(this).show(); 
                        hasResult = true;
                    } else {
                        $(this).hide(); 
                    }
                });
                if (!hasResult) { $("#noResults").removeClass("d-none"); } 
                else { $("#noResults").addClass("d-none"); }
            });
        });
    </script>
</body>
</html>