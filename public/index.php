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
        <li class="nav-item"><a href="./articlelist.php" class="nav-link">Blog</a></li>
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
  $sql = "SELECT article_id, title, image_url, content , created_at FROM articles ORDER BY created_at DESC LIMIT 3"; // Giới hạn lấy 3 bài mới nhất cho đẹp trang chủ
  $result = mysqli_query($conn, $sql);

  if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
  }

  $posts = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $posts[] = $row;
  }
  ?>

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