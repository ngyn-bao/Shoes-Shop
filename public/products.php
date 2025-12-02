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

    <!-- Banner -->
    <section class="banner">
      <div class="banner-content owl-carousel owl-theme" id="banner-content"></div>
    </section>

    <!-- Product Section -->
    <section class="feature p-5">
      <h2 class="text-center fs-1 fw-normal">- Product Feature -</h2>
      <div class="container">
        <div class="row g-5" id="product-list"></div>
        <div id="pagination-container" class="text-center mt-4"></div>
      </div>
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
