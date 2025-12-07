const tableBody = document.querySelector("#userTable tbody");

// Load user list
async function loadUsers() {
  try {
    const res = await axios.get("../api/User/getAllUsers.php");
    const users = res.data.data;

    tableBody.innerHTML = users
      .map(
        (u) => `
      <tr>
        <td>${u.user_id}</td>
        <td>${u.email}</td>
        <td>${u.phone}</td>
        <td>
          <select class="form-select role-select" data-id="${u.user_id}">
            <option value="customer" ${
              u.role === "customer" ? "selected" : ""
            }>Customer</option>
            <option value="admin" ${
              u.role === "admin" ? "selected" : ""
            }>Admin</option>
          </select>
        </td>
        <td>${u.created_at}</td>
        <td>
          <button class="btn btn-danger btn-sm" onclick="deleteUser(${
            u.user_id
          })">
            Delete
          </button>
        </td>
      </tr>
    `,
      )
      .join("");

    bindRoleChange();
  } catch (err) {
    tableBody.innerHTML = `<tr><td colspan="7" class="text-center">Cannot load users</td></tr>`;
  }
}

// Delete user
async function deleteUser(id) {
  if (!confirm("Delete this user?")) return;

  const form = new FormData();
  form.append("user_id", id);

  await axios.post("../api/User/deleteUser.php", form);

  loadUsers();
}

// Update role
function bindRoleChange() {
  document.querySelectorAll(".role-select").forEach((select) => {
    select.addEventListener("change", async function () {
      const form = new FormData();
      form.append("user_id", this.dataset.id);
      form.append("role", this.value);

      await axios.post("../api/User/updateRole.php", form);
    });
  });
}

// Run
loadUsers();
