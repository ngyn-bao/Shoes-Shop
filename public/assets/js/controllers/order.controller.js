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
  const user = JSON.parse(localStorage.getItem("user")); // Lấy user login

  if (!user) {
    alert("Bạn cần đăng nhập để đặt hàng!");
    return;
  }

  const data = {
    user_id: user.user_id, // >>>> FIX QUAN TRỌNG
    shipping_address: address.value,
    payment_method: paymentMethod.value,

    // FIX items: chỉ gửi đúng field API yêu cầu
    items: cart.map((x) => ({
      product_id: x.product_id,
      size: x.size,
      quantity: x.quantity,
      price: x.price,
    })),
  };

  try {
    const res = await axios.post(
      "../api/Order/createOrder.php",
      data,
      { headers: { "Content-Type": "application/json" } }, // >>> FIX JSON
    );

    if (res.data.success) {
      alert("Order Success!");
      localStorage.removeItem("cart");
      window.location.href = "./products.php";
    } else {
      alert("Order failed: " + res.data.message);
    }
  } catch (err) {
    console.log(err);
    alert("Order failed!");
  }
});
