document.addEventListener("DOMContentLoaded", loadProfile);

async function loadProfile() {
  try {
    const res = await axios.get("../api/User/getProfile.php");
    const user = res.data.data;

    document.getElementById("fullname").value = user.full_name || "";
    document.getElementById("email").value = user.email || "";
    document.getElementById("phone").value = user.phone || "";
    document.getElementById("address").value = user.address || "";
  } catch (err) {
    console.error(err);
    alert("Failed to load profile");
  }
}

// Update Profile
document.getElementById("btnSave").addEventListener("click", async () => {
  const data = {
    full_name: document.getElementById("fullname").value,
    phone: document.getElementById("phone").value,
    address: document.getElementById("address").value,
  };

  try {
    const res = await axios.post("../api/User/updateProfile.php", data);
    alert(res.data.message);
  } catch (err) {
    console.error(err);
  }
});

// Change Password
document
  .getElementById("btnChangePassword")
  .addEventListener("click", async () => {
    const data = {
      old_password: document.getElementById("old_password").value,
      new_password: document.getElementById("new_password").value,
    };

    try {
      const res = await axios.post("../api/User/changePassword.php", data);
      alert(res.data.message);
    } catch (err) {
      console.error(err);
    }
  });
