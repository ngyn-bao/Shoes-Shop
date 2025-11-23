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

              <button class="btn btn-dark mt-3">Add to Cart</button>
              <button class="btn btn-outline-dark mt-3 ms-2">Buy Now</button>
            </div>
          `;
  } catch (err) {
    detailEl.innerHTML = `<p class="text-danger text-center">Load failed</p>`;
  }
}

async function loadRelated() {
  try {
    const res = await axios.get("../api/Product/getAllProducts.php");
    const products = res.data.data.slice(0, 4);

    relatedEl.innerHTML = products
      .map(
        (p) => `
            <div class="col-3">
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

loadProduct();
loadRelated();
