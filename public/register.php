<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>

  <body>
    <?php include './includes/header.php'; ?>

    <section class="register p-3">
      <div class="container">
        <h3 class="text-center">Register</h3>

        <form id="registerForm">
          <div class="row m-3">
            <div class="col-6">
              <span class="text-danger">(*)</span>
              <input
                type="text"
                id="full_name"
                class="form-control"
                placeholder="Full Name"
                required
              />
            </div>

            <div class="col-6">
              <span class="text-danger">(*)</span>
              <input
                type="email"
                id="email"
                class="form-control"
                placeholder="Email"
                required
              />
            </div>
          </div>

          <div class="row m-3">
            <div class="col-6">
              <span class="text-danger">(*)</span>
              <input
                type="password"
                id="password"
                class="form-control"
                placeholder="Password"
                required
                autocomplete="off"
              />
            </div>

            <div class="col-6">
              <span class="text-danger">(*)</span>
              <input
                type="password"
                id="password_confirm"
                class="form-control"
                placeholder="Password Confirm"
                required
              />
            </div>
          </div>

          <div class="row m-3">
            <div class="col-6">
              <span class="text-danger">(*)</span>
              <input
                type="tel"
                id="phone"
                class="form-control"
                placeholder="Phone"
                required
              />
            </div>

            <div class="col-6">
              <input
                type="text"
                id="address"
                class="form-control"
                placeholder="Address (optional)"
              />
            </div>
          </div>

          <div class="row m-3">
            <div class="col-6"></div>
            <div class="col-6">
              <button
                type="button"
                id="btnRegister"
                class="btn btn-info text-white px-4 py-2 fs-5"
              >
                Register
              </button>
            </div>
          </div>
        </form>
      </div>
    </section>

    <?php include './includes/footer.php'; ?>

    <!-- jQuery + axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>

    <!-- NotifyJS -->
    <link rel="stylesheet" href="./assets/css/NotifyJS/notify.css" />
    <script src="./assets/js/NotifyJS/notify.js"></script>

    <script src="./assets/js/controllers/register.controller.js" type="module"></script>
  </body>
</html>
