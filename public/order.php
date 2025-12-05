<!DOCTYPE html>
<html lang="en">

<head>
  <title>Order</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

  <!-- Bootstrap -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

  <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>
  <?php include './includes/header.php'; ?>

  <!-- MAIN CONTENT -->
  <div class="container py-5">
    <h2 class="text-center mb-4">Order</h2>

    <div class="row">
      <!-- ORDER SUMMARY -->
      <div class="col-lg-6 mb-4">
        <div class="card p-3 shadow-sm">
          <h4 class="mb-3">Your Order</h4>
          <ul class="list-group" id="order-items"></ul>

          <div class="d-flex justify-content-between mt-3">
            <strong>Total:</strong>
            <strong id="total-price" class="text-danger">$0</strong>
          </div>
        </div>
      </div>

      <!-- CUSTOMER INFO -->
      <div class="col-lg-6">
        <div class="card p-3 shadow-sm">
          <h4 class="mb-3">Customer Information</h4>

          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input id="fullName" class="form-control" />
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input id="email" type="email" class="form-control" />
          </div>

          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input id="phone" class="form-control" />
          </div>

          <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea id="address" class="form-control"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Note</label>
            <textarea id="note" class="form-control"></textarea>
          </div>

          <h4 class="mt-4">Payment</h4>

          <select id="paymentMethod" class="form-select mb-4">
            <option value="COD">Cash on Delivery</option>
            <option value="BANKING">Banking</option>
            <option value="CARD">Visa / Mastercard</option>
          </select>

          <button class="btn btn-dark w-100" id="btnOrder">
            Confirm Order
          </button>
        </div>
      </div>
    </div>
  </div>

  <?php include './includes/footer.php'; ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>

  <script src="./assets/js/controllers/order.controller.js"></script>
</body>

</html>