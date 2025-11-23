<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Detail</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>

  <body>
    <?php include './includes/header.php'; ?>

    <div class="container py-5">
      <div class="row" id="product-detail"></div>

      <h2 class="mb-3 text-center mt-5">- Related Products -</h2>
      <div class="row" id="related-products"></div>
    </div>

    <?php include './includes/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>

    <script src="./assets/js/helpers/loadDetail.js"></script>
  </body>
</html>
