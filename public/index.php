<?php $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shoes Shop</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="./assets/css/OwlCarousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="./assets/css/OwlCarousel/owl.theme.default.min.css" />

  <link rel="stylesheet" href="./assets/css/style.css" />

  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    footer {
      margin-top: auto;
    }

    .group-category:hover .dropdown-menu {
      display: block;
      margin-top: 0;
    }

    .secondary-nav .dropdown-menu {
      border: none;
      border-radius: 8px;
      padding: 10px 0;
    }

    .secondary-nav .dropdown-item {
      padding: 8px 20px;
      transition: 0.2s;
    }

    .secondary-nav .dropdown-item:hover {
      background-color: #f8f9fa;
      color: #000;
    }
  </style>
</head>

<body>
  <?php include './includes/header.php'; ?>

  <nav class="secondary-nav">
    <div class="container">
      <ul class="d-flex align-items-center gap-4 list-unstyled m-0">

        <li class="nav-item">
          <a href="./index.php" class="nav-link active">Home</a>
        </li>

        <li class="nav-item dropdown group-category">
          <a href="#" class="nav-link dropdown-toggle">Category</a>

          <ul class="dropdown-menu shadow">
            <li><a class="dropdown-item" href="./index.php?category_id=1">Men</a></li>
            <li><a class="dropdown-item" href="./index.php?category_id=2">Women</a></li>
            <li><a class="dropdown-item" href="./index.php?category_id=3">Kid</a></li>
            <li><a class="dropdown-item" href="./index.php?category_id=4">Sport</a></li>
          </ul>
        </li>

        <li class="nav-item"><a href="./articlelist.php" class="nav-link">Blog</a></li>

        <li class="nav-item"><a href="./faq.php" class="nav-link">Faq</a></li>
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
  $sql = "SELECT id, title, image, content , created_at FROM articles ORDER BY created_at DESC LIMIT 3";
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


  <a href="#" class="cd-top text-replace js-cd-top">
    <i class="fa-solid fa-angle-up"></i>
  </a>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/OwlCarousel/owl.carousel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
  <script src="./assets/js/helpers/util.js"></script>
  <script src="./assets/js/helpers/main.js"></script>

  <script src="./assets/js/controllers/products.controller.js"></script>


</body>

</html>