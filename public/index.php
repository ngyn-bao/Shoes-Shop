<?php $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shoes Shop</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Owl Carousel -->
  <link rel="stylesheet" href="./assets/css/OwlCarousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="./assets/css/OwlCarousel/owl.theme.default.min.css" />

  <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>
  <?php include './includes/header.php'; ?>

  <nav class="secondary-nav">
    <div class="container">
      <ul class="d-flex align-items-center gap-4">
        <li class="nav-item">
          <a href="./index.php" class="nav-link active">Home</a>
        </li>
        <li class="nav-item"><a href="./index.php?category_id=1" class="nav-link">Men</a></li>
        <li class="nav-item"><a href="./index.php?category_id=2" class="nav-link">Women</a></li>
        <li class="nav-item"><a href="./index.php?category_id=3" class="nav-link">Kid</a></li>
        <li class="nav-item"><a href="./index.php?category_id=4" class="nav-link">Sport</a></li>
      </ul>
    </div>
  </nav>
  <!-- Banner -->
  <section class="banner">
    <div class="banner-content owl-carousel owl-theme" id="banner-content"></div>
  </section>

  <!-- Product Section -->
  <section class="feature p-5">
    <h2 class="text-center fs-1 fw-normal">- Product Feature -</h2>
    <div class="container my-3">
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" id="searchInput" type="search" placeholder="Search" aria-label="Search">
        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
      </form>
    </div>
    <div class="container">
      <div class="row g-5" id="product-list"></div>
      <div id="pagination-container" class="text-center mt-4"></div>
    </div>
  </section>

  <?php
  require_once '../config/db.php';
  $sql = "SELECT id, title, image, excerpt, created_at FROM articles ORDER BY created_at DESC";
  $result = mysqli_query($conn, $sql);

  if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
  }

  $posts = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $posts[] = $row;
  }
  ?>

  <section>
    <h2 class="text-center fs-1 fw-normal">- Articles & News -</h2>

    <!-- Search Bar -->
    <section class="container my-4">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
              <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Tìm kiếm bài viết..."
              autocomplete="off">
          </div>
        </div>
      </div>
    </section>

    <main class="container my-5">
      <div class="row g-4" id="postsContainer">
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
                  <a href="articledetail.php?id=<?= $post['id'] ?>" class="btn btn-dark btn-sm d-block mt-2">Đọc tiếp</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div id="noResults" class="text-center mt-5 d-none">
        <p class="text-muted fs-4">Không tìm thấy bài viết nào.</p>
      </div>
    </main>

    </main>
  </section>

  <?php include './includes/footer.php'; ?>

  <!-- backtoTop -->
  <a href="#" class="cd-top text-replace js-cd-top">
    <i class="fa-solid fa-angle-up"></i>
  </a>

  <!-- JS Libs -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/OwlCarousel/owl.carousel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
  <script src="./assets/js/helpers/util.js"></script>
  <script src="./assets/js/helpers/main.js"></script>

  <script src="./assets/js/controllers/products.controller.js">

  </script>
</body>

</html>