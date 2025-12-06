// register.controller.js

const btnRegister = document.getElementById("btnRegister");

btnRegister.addEventListener("click", async () => {
  const full_name = document.getElementById("full_name").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();
  const password_confirm = document
    .getElementById("password_confirm")
    .value.trim();
  const phone = document.getElementById("phone").value.trim();
  const address = document.getElementById("address").value.trim();

  // ==== Frontend validation ====
  if (!full_name || !email || !password || !password_confirm || !phone) {
    return new Notify(
      "Validation Error",
      "Bắt buộc điền đủ các field (*)",
      "error",
    );
  }

  if (password !== password_confirm) {
    return new Notify("Error", "Mật khẩu không khớp", "error");
  }

  if (!/^\d{9,11}$/.test(phone)) {
    return new Notify("Error", "Phone number must be 9–11 digits", "error");
  }

  // ==== Payload gửi lên API ====
  const payload = {
    full_name,
    email,
    password,
    phone,
    address,
    avatar: "", // có thể bỏ nếu bạn muốn
  };

  try {
    const response = await axios.post(
      "../api/Authentication/register.php",
      payload,
      {
        headers: { "Content-Type": "application/json" },
      },
    );

    if (response.data.success) {
      new Notify("Success", response.data.message, "success");
      document.getElementById("registerForm").reset();
    } else {
      new Notify("Failed", response.data.message, "error");
    }
  } catch (error) {
    new Notify(
      "Registration Failed",
      error.response?.data?.message || "Server error",
      "error",
    );
    console.error(error);
  }
});
