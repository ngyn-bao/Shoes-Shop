function loadHeader() {
  const user = JSON.parse(localStorage.getItem("user"));
  const btnLogin = document.getElementById("btnLogin");
  const btnRegister = document.getElementById("btnRegister");
  const userAvatar = document.getElementById("userAvatar");

  if (user) {
    // Đã đăng nhập
    btnLogin.style.display = "none";
    btnRegister.style.display = "none";
    userAvatar.style.display = "block";
  } else {
    // Chưa đăng nhập
    btnLogin.style.display = "inline-block";
    btnRegister.style.display = "inline-block";
    userAvatar.style.display = "none";
  }
}

// --- HANDLE LOGOUT ---
document.addEventListener("click", async (e) => {
  if (e.target.id === "btnLogout") {
    try {
      const res = await axios.post("../api/Authentication/logout.php");

      if (res.data.success) {
        // Xoá dữ liệu localStorage
        localStorage.removeItem("user");
        localStorage.removeItem("cart");

        alert("Đăng xuất thành công!");

        window.location.href = "./login.php";
      } else {
        alert("Logout failed!");
      }
    } catch (err) {
      console.error(err);
      alert("Server error!");
    }
  }
});

loadHeader();
