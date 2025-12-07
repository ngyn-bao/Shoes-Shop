const searchInput = document.getElementById("searchInput");

let currentSearch = searchInput.value.trim() || "";

// --- Load sản phẩm từ API ---
async function loadProducts(page = 1, limit = 6, category_id = null) {
  try {
    const res = await axios.get(
      `../api/Product/getAllProducts.php?page=${page}&limit=${limit}&category_id=${category_id}&search=${currentSearch}`,
    );

    const result = res.data?.data;
    const products = result?.data || res.data?.data || []; // fallback cho API không phân trang
    const pagination = res.data?.pagination || null;
    console.log(pagination);
    // --- Render banner (3 sản phẩm random, chỉ lần đầu) ---
    if (page === 1 && products.length > 0) {
      renderBanner(products);
    }

    // --- Render danh sách sản phẩm ---
    renderProducts(products);

    // --- Render phân trang (nếu có từ API) ---
    if (pagination) {
      renderPagination(
        pagination.page,
        pagination.limit,
        pagination.total,
        "pagination-container",
      );
    }
  } catch (err) {
    console.error("Lỗi loadProducts:", err);
    document.getElementById("product-list").innerHTML =
      "<p class='text-center text-danger'>Không thể tải dữ liệu</p>";
  }
}

// --- Banner ---
function renderBanner(allProducts) {
  const bannerItems = [...allProducts]
    .sort(() => 0.5 - Math.random())
    .slice(0, 3);
  console.log(bannerItems);
  const banner = document.getElementById("banner-content");
  banner.innerHTML = bannerItems
    .map(
      (p) => `
        <div class="banner-item row align-items-center">
          <div class="banner-img col-8">
            <img src=${p.image_url} alt="" style="width: 80%;">
          </div>
          <div class="banner-text col-4">
            <h2 class="fs-1 fw-normal text-uppercase">${p.product_name}</h2>
            <p class="fw-light">${(p.description || "").substring(
              0,
              100,
            )}...</p>
            <button onclick="location.href='product_detail.php?id=${
              p.product_id
            }'" 
                    class="btn btn-dark py-3 px-5 text-white">
              Buy Now
            </button>
          </div>
        </div>
      `,
    )
    .join("");

  $("#banner-content").trigger("destroy.owl.carousel");
  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    navText: [
      "<img src='./img/Polygon2.png'>",
      "<img src='./img/Polygon1.png'>",
    ],
    dots: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1,
      },
      1000: {
        items: 1,
      },
    },
  });
}

// --- Render danh sách sản phẩm ---
function renderProducts(products) {
  const list = document.getElementById("product-list");
  list.innerHTML = products
    .map(
      (p) => `
        <div class="col-md-4">
          <div class="card shadow-sm">
            <img src=${p.image_url} class="card-img-top" alt="${
        p.product_name
      }">
            <div class="card-body text-center">
              <h5>${p.product_name}</h5>
              <p class="text-muted">${(p.description || "").substring(
                0,
                80,
              )}...</p>
              <p class="fw-bold text-danger">${Number(
                p.price,
              ).toLocaleString()} VND</p>
              <a href="product_detail.php?id=${
                p.product_id
              }" class="btn btn-dark text-white">
                View Detail
              </a>
            </div>
          </div>
        </div>
      `,
    )
    .join("");
  console.log(products);
}

// --- Render phân trang (theo server data) ---
function renderPagination(currentPage, limit, total, containerId) {
  const totalPages = Math.ceil(total / limit);
  const container = document.getElementById(containerId);

  container.innerHTML = `
    <button class="btn btn-light" ${currentPage === 1 ? "disabled" : ""}
      onclick="loadProducts(${currentPage - 1}, ${limit})">&laquo;</button>

    ${Array.from(
      { length: totalPages },
      (_, i) => `
      <button class="btn ${
        i + 1 === currentPage ? "btn-warning text-white" : "btn-light"
      }"
        onclick="loadProducts(${i + 1}, ${limit})">${i + 1}</button>
    `,
    ).join("")}

    <button class="btn btn-light" ${
      currentPage === totalPages ? "disabled" : ""
    }
      onclick="loadProducts(${currentPage + 1}, ${limit})">&raquo;</button>
  `;
}

document.addEventListener("DOMContentLoaded", () => {
  const urlParams = new URLSearchParams(window.location.search);
  const category_id = urlParams.get("category_id");

  loadProducts(1, 6, category_id);
});

searchInput.addEventListener("input", function () {
  currentSearch = this.value.trim();
  currentPage = 1; // reset lại page
  loadProducts(1, 6);
});
