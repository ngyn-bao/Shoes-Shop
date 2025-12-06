// let cart = JSON.parse(localStorage.getItem("cart") || "[]");

let cart = [];

async function loadCart() {
  try {
    const res = await axios.get("../api/Cart/getCart.php");
    if (res.data.success) {
      cart = res.data.cart;
      localStorage.setItem("cart", JSON.stringify(cart));
    } else {
      cart = JSON.parse(localStorage.getItem("cart") || "[]");
    }
  } catch (err) {
    console.log("Lỗi gọi API, fallback localStorage");
    cart = JSON.parse(localStorage.getItem("cart") || "[]");
  }

  renderCart();
}

const cartList = document.getElementById("cart-list");
const totalEl = document.getElementById("cartTotal");

// Render Cart
function renderCart() {
  cartList.innerHTML = "";
  let total = 0;

  if (cart.length === 0) {
    cartList.innerHTML = `<p class="text-center">Your cart is empty.</p>`;
    totalEl.textContent = "$0";
    return;
  }

  cart.forEach((item, index) => {
    total += item.price * item.quantity;

    cartList.innerHTML += `
            <div class="cart-item d-flex justify-content-between align-items-center border-bottom py-3">
              <div class="d-flex align-items-center">
                <img src="${item.img}" width="70" class="rounded me-3" />
                <div>
                  <h6>${item.name}</h6>
                  <p class="mb-0">${Number(item.price).toLocaleString()} VND</p>
                  <p>Size: ${item.size}</p>
                </div>
              </div>

              <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${index}, -1)">-</button>
                <span>${item.quantity}</span>
                <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${index}, 1)">+</button>

                <button class="btn btn-sm btn-danger" onclick="removeItem(${index})">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </div>
            </div>
          `;
  });

  totalEl.textContent = Number(total).toLocaleString() + " VND";
}

// Change quantity
async function changeQty(i, amount) {
  cart[i].quantity += amount;
  if (cart[i].quantity < 1) cart[i].quantity = 1;
  console.log(cart);
  try {
    await axios.post(
      "../api/Cart/updateCartItem.php",
      {
        cart_item_id: cart[i].cart_item_id,
        quantity: cart[i].quantity,
      },
      { headers: { "Content-Type": "application/json" } },
    );
  } catch (error) {
    console.log("Lỗi update DB:", error);
  }
  save();
}

// Remove item
function removeItem(i) {
  cart.splice(i, 1);
  save();
}

// Clear Cart
document.getElementById("clearCart").onclick = () => {
  cart = [];
  save();
};

function save() {
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
}

const user = JSON.parse(localStorage.getItem("user")); // Lấy user login

if (!user) {
  alert("Bạn cần đăng nhập để đặt hàng!");
  window.location.href = "./login.php";
} else {
  loadCart();
}
