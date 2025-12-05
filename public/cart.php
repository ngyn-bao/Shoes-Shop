<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cart</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
  <!-- Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

  <!-- Bootstrap -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

  <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>
  <?php include './includes/header.php'; ?>

  <!-- MAIN -->
  <div class="container py-5">
    <h2 class="text-center mb-4">Your Cart</h2>

    <!-- Cart List -->
    <div class="row">
      <div class="col-lg-8">
        <div class="card p-3 shadow-sm">
          <div id="cart-list"></div>

          <div class="text-end mt-3">
            <button id="clearCart" class="btn btn-outline-danger btn-sm">
              Clear Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Summary -->
      <div class="col-lg-4">
        <div class="card p-3 shadow-sm">
          <h4>Summary</h4>

          <div class="d-flex justify-content-between mt-3">
            <span>Total:</span>
            <strong id="cartTotal" class="text-danger">$0</strong>
          </div>

          <a href="./order.php" class="btn btn-dark w-100 mt-4">Proceed to Checkout</a>
        </div>
      </div>
    </div>
  </div>

  <?php include './includes/footer.php'; ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>

  <script src="./assets/js/controllers/cart.controller.js">

  </script>
</body>

</html>