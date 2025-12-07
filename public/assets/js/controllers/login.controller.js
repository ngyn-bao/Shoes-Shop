// login.controller.js

const btnLogin = document.getElementById("btnLogin");

btnLogin.addEventListener("click", async () => {
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  // ===== Frontend validation =====
  if (!email || !password) {
    return new Notify(
      "Validation Error",
      "Vui lòng nhập đầy đủ Email & Password",
      "error",
    );
  }

  // ===== Payload =====
  const payload = {
    email,
    password,
  };

  try {
    const response = await axios.post(
      "../api/Authentication/login.php",
      payload,
      {
        headers: { "Content-Type": "application/json" },
      },
    );

    if (response.data.success) {
      new Notify("Success", response.data.message, "success");

      // Lưu user vào localStorage
      localStorage.setItem("user", JSON.stringify(response.data.user));

      if (response.data.user.role === "admin") {
        setTimeout(() => {
          window.location.href = "../Admin/index.php";
        }, 800);
      } else {
        setTimeout(() => {
          window.location.href = "index.php";
        }, 800);
      }
      // Redirect sau 0.8s
    } else {
      new Notify("Failed", response.data.message, "error");
    }
  } catch (error) {
    console.error(error);
    new Notify(
      "Login Failed",
      error.response?.data?.message || "Server error",
      "error",
    );
  }
});
