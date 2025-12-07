const detailEl = document.getElementById("product-detail");
const relatedEl = document.getElementById("related-products");

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get("id");

async function loadProduct() {
  try {
    const res = await axios.get(
      `../api/Product/getProductById.php?id=${productId}`,
    );
    const p = res.data.data;

    detailEl.innerHTML = `
            <div class="col-md-6">
              <img src="${
                p.images[0].image_url
              }" class="img-fluid rounded shadow" />
            </div>
            <div class="col-md-6">
              <h2>${p.product_name}</h2>
              <p class="text-muted">${(p.description || "").substring(
                0,
                100,
              )}</p>
              <h3 class="text-danger">${Number(
                p.price,
              ).toLocaleString()} VND</h3>
              
            <div class="mt-3">
              <label class="fw-bold">Size:</label>
              <select id="size" class="form-select w-25">
                ${(p.sizes || ["38", "39", "40", "41", "42"])
                  .map((s) => `<option value="${s}">${s}</option>`)
                  .join("")}
              </select>
            </div>

            <div class="mt-3">
              <label class="fw-bold">Quantity:</label>
              <input type="number" id="qty" value="1" min="1" class="form-control w-25">
            </div>

              <button class="btn btn-dark mt-3" id="btnAddCart">Add to Cart</button>
            </div>
          `;

    document.getElementById("btnAddCart").addEventListener("click", addToCart);
  } catch (err) {
    detailEl.innerHTML = `<p class="text-danger text-center">Load failed</p>`;
  }
}

async function addToCart() {
  try {
    const size = document.getElementById("size").value;
    const qty = Number(document.getElementById("qty").value);

    // Fetch lại thông tin sản phẩm để lưu localStorage
    const user = JSON.parse(localStorage.getItem("user") || "{}");
    const user_id = user.user_id;

    const resProduct = await axios.get(
      `../api/Product/getProductById.php?id=${productId}`,
    );
    const p = resProduct.data.data;

    // Lưu vào API
    const resCart = await axios.post(
      "../api/Cart/addToCart.php",
      {
        user_id: user_id,
        product_id: productId,
        size: size,
        quantity: qty,
      },
      { headers: { "Content-Type": "application/json" } },
    );

    // console.log(resCart);
    // Lưu vào localStorage
    saveToLocalCart({
      product_id: p.product_id,
      name: p.product_name,
      img: p.images[0].image_url,
      price: p.price,
      size: size,
      quantity: qty,
      cart_item_id: resCart.data.cart_item_id,
    });

    alert("Đã thêm vào giỏ hàng!");
  } catch (err) {
    console.log(err);
    alert("Thêm vào giỏ hàng thất bại");
  }
}

function slideRelated(arr, start, end) {
  return arr.slice(start, end);
}

async function loadRelated() {
  try {
    const res = await axios.get("../api/Product/getAllProducts.php");
    console.log(res);
    let start = Math.floor(Math.random() * 10);
    let end = 4;

    if (start >= end) {
      start = 0;
    }
    const products = slideRelated(res.data.data.data, start, end);

    relatedEl.innerHTML = products
      .map(
        (p) => `
            <div class="col-md-3">
              <div class="card text-center p-3">
                <img src="${p.image_url}" class="card-img-top" />
                <h5 class="mt-2">${p.product_name}</h5>
                <p class="text-danger">${Number(
                  p.price,
                ).toLocaleString()} VND</p>
                <a href="./product_detail.php?id=${
                  p.product_id
                }" class="btn btn-dark btn-sm">View</a>
              </div>
            </div>
          `,
      )
      .join("");
  } catch (err) {
    relatedEl.innerHTML = `<p class="text-center">Cannot load related products</p>`;
  }
}

function saveToLocalCart(item) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");

  const exist = cart.find(
    (x) => x.product_id == item.product_id && x.size == item.size,
  );

  if (exist) {
    exist.quantity += item.quantity;
  } else {
    cart.push(item);
  }

  localStorage.setItem("cart", JSON.stringify(cart));
}

loadProduct();
loadRelated();
