<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Shoes Shop</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="./assets/css/OwlCarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="./assets/css/OwlCarousel/owl.theme.default.min.css" />

    <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="m-0">Tin tức & Bài viết</h1>
        </div>
    </header>

    <!-- SEARCH BAR -->
    <section class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control border-start-0"
                           placeholder="Tìm kiếm bài viết..." aria-label="Tìm kiếm">
                </div>
            </div>
        </div>
    </section>

    <main class="container my-5">
        <div class="row g-4" id="postsContainer">
            <?php
            $posts = [
                [
                    'id' => 1,
                    'title' => 'Top 10 đôi giày thể thao đáng mua nhất 2025',
                    'image' => './images/blog1.jpg',
                    'excerpt' => 'Khám phá những mẫu giày được yêu thích nhất năm 2025 với thiết kế hiện đại, giá cả hợp lý...',
                ],
                [
                    'id' => 2,
                    'title' => 'Cách chọn giày phù hợp với dáng chân',
                    'image' => './images/blog2.jpg',
                    'excerpt' => 'Không phải ai cũng biết cách chọn giày để vừa vặn và thoải mái. Bài viết này sẽ giúp bạn...',
                ],
                [
                    'id' => 3,
                    'title' => 'Xu hướng thời trang giày 2025',
                    'image' => './images/blog3.jpg',
                    'excerpt' => 'Các nhà thiết kế đã mang đến những xu hướng mới mẻ cho thị trường giày năm nay...',
                ],
            ];

            foreach ($posts as $post): ?>
                <div class="col-md-4 post-card" 
                     data-title="<?= strtolower($post['title']) ?>"
                     data-excerpt="<?= strtolower($post['excerpt']) ?>">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= $post['image'] ?>" class="card-img-top" alt="<?= $post['title'] ?>" />
                        <div class="card-body">
                            <h5 class="card-title"><?= $post['title'] ?></h5>
                            <p class="card-text text-muted"><?= $post['excerpt'] ?></p>
                            <a href="articledetail.php?id=<?= $post['id'] ?>" class="btn btn-dark">Đọc tiếp</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- No results -->
        <div id="noResults" class="text-center mt-4 d-none">
            <p class="text-muted">Không tìm thấy bài viết nào phù hợp.</p>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p class="m-0">© 2025 Shoes Shop. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Owl Carousel -->
    <script src="../assets/js/OwlCarousel/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                responsive: {
                    0: { items: 1 },
                    768: { items: 2 },
                    1200: { items: 3 },
                },
            });
        });
    </script>

    <!-- Custom Search Script -->
    <script src="../assets/js/controllers/articlelist.js"></script>

    <!-- Other Cody House scripts -->
    <script src="../assets/js/helpers/util.js"></script>
    <script src="../assets/js/helpers/main.js"></script>
    
</body>
<?php include '../includes/footer.php'; ?>
</html>