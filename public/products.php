<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Shoes Shop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />

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
  </head>

  <body>
<?php include './includes/header.php'; ?>

<!-- Banner start -->
    <section class="banner">
      <div class="banner-content owl-carousel owl-theme" id="banner-content">
      </div>
    </section>
    <!-- Banner end -->

<section class="feature p-5">
  <h2 class="text-center fs-1 fw-normal">- Product Feature -</h2>
  <div class="container">
    <div class="row g-5" id="product-list"></div>
  </div>
</section>

<?php include './includes/footer.php'; ?>
    <!-- backtoTop -->
    <a href="#" class="cd-top text-replace js-cd-top">
      <i class="fa-solid fa-angle-up"></i>
    </a>

    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"
      integrity="sha512-DdX/YwF5e41Ok+AI81HI8f5/5UsoxCVT9GKYZRIzpLxb8Twz4ZwPPX+jQMwMhNQ9b5+zDEefc+dcvQoPWGNZ3g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <!-- jQuery -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

 <!-- Owl Carousel -->
    <script src="./assets/js/OwlCarousel/owl.carousel.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
     <!-- Cody House -->
    <script src="./assets/js/helpers/util.js"></script>
    <script src="./assets/js/helpers/main.js"></script>
<script>
   
async function loadProducts() {
  try {
    const res = await axios.get("../api/Product/getAllProducts.php");
    const products = res.data.data || [];

    const container = document.getElementById("product-list");
    container.innerHTML = products.map(p => `
      <div class="col-md-4">
        <div class="card shadow-sm">
          <img src="${p.image_url}" class="card-img-top" alt="${p.product_name}">
          <div class="card-body text-center">
            <h5>${p.product_name}</h5>
            <p class="text-muted">${p.description || ""}</p>
            <p class="fw-bold text-danger">${Number(p.price).toLocaleString()} VND</p>
            <a href="product_detail.php?id=${p.product_id}" class="btn btn-warning text-white">Xem chi tiết</a>
          </div>
        </div>
      </div>
    `).join("");
  } catch (err) {
    console.error(err);
    alert("Lỗi khi tải danh sách sản phẩm!");
  }
}
loadProducts();
</script>
  </body>
</html>