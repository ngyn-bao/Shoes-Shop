<?php
require_once '../config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: articlelist.php');
    exit;
}

$sql_article = "SELECT * FROM articles WHERE id = $id LIMIT 1";
$result_article = mysqli_query($conn, $sql_article);
$article = mysqli_fetch_assoc($result_article);

if (!$article) {
    echo "<h2 class='text-center my-5'>Bài viết không tồn tại!</h2>";
    exit;
}

$sql_comments = "SELECT name, email, content, created_at FROM comments 
                 WHERE article_id = $id AND is_approved = 1 
                 ORDER BY created_at DESC";
$result_comments = mysqli_query($conn, $sql_comments);
$comments = [];
while ($row = mysqli_fetch_assoc($result_comments)) {
    $comments[] = $row;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($article['title']) ?> - Shoes Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>
<body>
    <?php include './includes/header.php'; ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <article class="bg-white shadow rounded p-4 p-md-5">
                    <h1 class="display-5 fw-bold mb-4"><?= htmlspecialchars($article['title']) ?></h1>

                    <?php if ($article['image']): ?>
                        <img src="../public/<?= htmlspecialchars($article['image']) ?>" 
                             class="img-fluid rounded mb-4" 
                             style="max-height:500px; width:100%; object-fit:cover;"
                             onerror="this.src='../public/img/no-image.jpg'"
                             alt="<?= htmlspecialchars($article['title']) ?>">
                    <?php endif; ?>

                    <div class="text-muted mb-4">
                        <small><i class="far fa-calendar"></i> <?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></small>
                    </div>

                    <div class="content lh-lg">
                        <?= htmlspecialchars_decode($article['content']) ?>
                        <!-- <?= nl2br(htmlspecialchars_decode($article['content'])) ?> -->
                    </div>
                </article>

                <section class="mt-5 bg-white shadow rounded p-4">
                    <h3 class="mb-4">Bình luận (<?= count($comments) ?>)</h3>
                    <form id="commentForm" class="mb-5">
                        <input type="hidden" name="article_id" value="<?= $id ?>">
                        
                        <div class="mb-3">
                            <textarea name="content" class="form-control" rows="4" placeholder="Viết bình luận..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                    </form>

                    <div id="commentsList">
                        <?php foreach ($comments as $c): ?>
                            <div class="border-bottom pb-3 mb-3">
                                <strong><?= htmlspecialchars($c['name']) ?></strong>
                                <small class="text-muted ms-2"><?= date('d/m/Y H:i', strtotime($c['created_at'])) ?></small>
                                <p class="mt-2 mb-0"><?= nl2br(htmlspecialchars($c['content'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <?php include './includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $('#commentForm').on('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: '../api/Articles/addComment.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.success) location.reload();
                    else alert(res.message || 'Lỗi khi gửi bình luận');
                },
                error: () => alert('Lỗi kết nối')
            });
        });
    </script>
</body>
</html>