

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Chi tiết bài viết - Shoes Shop</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <a href="articlelist.php" class="text-white text-decoration-none">
                <i class="fa fa-arrow-left me-2"></i>Quay lại danh sách
            </a>
        </div>
    </header>

    <main class="container my-5">
        <?php
        $id = $_GET['id'] ?? 0;
        $posts = [
            1 => [
                'title' => 'Top 10 đôi giày thể thao đáng mua nhất 2025',
                'image' => './images/blog1.jpg',
                'content' => 'Năm 2025 đánh dấu sự trở lại của các dòng giày cổ điển...',
            ],
            2 => [
                'title' => 'Cách chọn giày phù hợp với dáng chân',
                'image' => './images/blog2.jpg',
                'content' => 'Một đôi giày tốt không chỉ đẹp mà còn phải mang lại cảm giác thoải mái...',
            ],
            3 => [
                'title' => 'Xu hướng thời trang giày 2025',
                'image' => './images/blog3.jpg',
                'content' => 'Năm 2025 hứa hẹn sẽ là năm của những đôi giày mang phong cách tự nhiên...',
            ],
        ];
        $post = $posts[$id] ?? null;
        ?>

        <?php if ($post): ?>
            <div class="card shadow-sm">
                <img src="<?= $post['image'] ?>" class="card-img-top" alt="<?= $post['title'] ?>" />
                <div class="card-body">
                    <h2 class="card-title mb-3"><?= $post['title'] ?></h2>
                    <p class="card-text"><?= nl2br($post['content']) ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">Bài viết không tồn tại.</div>
        <?php endif; ?>
    </main>

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"
        integrity="sha512-DdX/YwF5e41Ok+AI81HI8f5/5UsoxCVT9GKYZRIzpLxb8Twz4ZwPPX+jQMwMhNQ9b5+zDEefc+dcvQoPWGNZ3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
    <!-- Owl Carousel -->
    <link
      rel="stylesheet"
      href="./assets/css/OwlCarousel/owl.carousel.min.css"
    />
    <link
      rel="stylesheet"
      href="./assets/css/OwlCarousel/owl.theme.default.min.css"
    />

    <link rel="stylesheet" href="./assets/css/style.css" />
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

    <!-- Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"
        integrity="sha512-DdX/YwF5e41Ok+AI81HI8f5/5UsoxCVT9GKYZRIzpLxb8Twz4ZwPPX+jQMwMhNQ9b5+zDEefc+dcvQoPWGNZ3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Cody House -->
    <script src="../assets/js/helpers/util.js"></script>
    <script src="../assets/js/helpers/main.js"></script>

    <script src="../assets/js/controllers/articledetail.js"></script>

</body>

</html>
<?php include '../includes/footer.php'; ?>
