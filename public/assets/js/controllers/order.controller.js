// --- Load cart from localStorage ---
let cart = JSON.parse(localStorage.getItem("cart") || "[]");

const orderListEl = document.getElementById("order-items");
const totalPriceEl = document.getElementById("total-price");

function renderOrder() {
  orderListEl.innerHTML = "";
  let total = 0;

  cart.forEach((item) => {
    total += item.price * item.quantity;

    orderListEl.innerHTML += `
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <img src="${item.img}" width="60" class="me-3 rounded" />
                <div>
                  <strong>${item.name}</strong><br/>
                  ${Number(item.price).toLocaleString()} VND x ${item.quantity}
                  <p>Size: ${item.size}</p>
                </div>
              </div>
              <strong>${Number(
                item.price * item.quantity,
              ).toLocaleString()} VND</strong>
            </li>
          `;
  });

  totalPriceEl.textContent = Number(total).toLocaleString() + " VND";
}

renderOrder();

// --- Handle Order Submit ---
document.getElementById("btnOrder").addEventListener("click", async () => {
  const data = {
    customer_name: fullName.value,
    email: email.value,
    phone: phone.value,
    address: address.value,
    note: note.value,
    payment: paymentMethod.value,
    items: cart,
  };

  try {
    const res = await axios.post("../api/Order/createOrder.php", data);

    if (res.data.success) {
      alert("Order Success!");
      localStorage.removeItem("cart");
      window.location.href = "./index.html";
    }
  } catch (err) {
    alert("Order failed!");
  }
});
