import {
  renderDuLieuGiay,
  chuyenDoiTienTe,
  capitalizeFirstLetter,
} from "../common/util.js";

function getDetailGiay(id = 7) {
  let promise = axios({
    url: `https://shop.cyberlearn.vn/api/Product/getbyid?id=${id}`,
    method: "GET",
  });
  promise
    .then((res) => {
      renderDetailGiay(res.data.content);
      //   console.log(res.data.content);
    })
    .catch((err) => {
      console.log(err);
    });
}

getDetailGiay(8);

function renderDetailGiay(giay, idTheCha = "baiTap3") {
  let { name, description, size, price, image, relatedProducts } = giay;
  let content = `    
    <div class="col-5">
          <!-- hình ảnh chi tiết -->
          <img
            src=${image}
            alt=""
          />
        </div>
        <div class="col-7">
          <!-- tên giày -->
          <h3 class="text-uppercase">${name}</h3>

          <!-- description -->
          <p>${capitalizeFirstLetter(description)}</p>

          <!-- size -->
          <h4 class="text-success">Available Size</h4>
          <div class="d-flex align-items-center g-3">
            ${renderSizeGiay(size)}
          </div>

          <!-- quantity -->
          <div class="d-flex my-4">
            <span class="input-group-btn">
              <button class="btn btn-success btn-subtract py-2 px-3" type="button">-</button>
            </span>
            <input type="text" class="form-control w-25 text-center py-2 item-quantity" value="0">
            <span class="input-group-btn">
              <button class="btn btn-success btn-add py-2 px-3" type="button">+</button>
            </span>
          </div>

          <!-- giá -->
          <h4 class="mt-2 text-danger">${chuyenDoiTienTe(price)}</h4>

          <!-- add to cart -->
          <button class="btn btn-outline-dark py-2 px-3">Add to cart</button>
        </div>`;

  document.getElementById(idTheCha).innerHTML = content;

  renderDuLieuGiay(relatedProducts, "baiTap4");
  quantityButton();
}

function quantityButton() {
  let minus = document.querySelector(".btn-subtract");
  let add = document.querySelector(".btn-add");
  let quantityNumber = document.querySelector(".item-quantity");
  let currentValue = 1;

  minus.addEventListener("click", function () {
    currentValue -= 1;
    if (currentValue <= 0) {
      minus.classList.add("disabled");
    }
    quantityNumber.value = currentValue > 0 ? currentValue : 0;
    // console.log(currentValue);
  });

  add.addEventListener("click", function () {
    currentValue += 1;
    quantityNumber.value = currentValue;
    if (currentValue > 0) {
      minus.classList.remove("disabled");
    }
    quantityNumber.value = currentValue > 0 ? currentValue : 0;
    // console.log(currentValue);
  });
}

function renderSizeGiay(arrSize) {
  let content = "";
  for (let size of arrSize) {
    content += `<button class="btn btn-warning me-3">${size}</button>`;
  }

  return content;
}

window.onload = function () {
  const urlParams = new URLSearchParams(window.location.search);
  const myParam = urlParams.get("productid");

  const productId = Number(myParam);
  if (isNaN(productId) || productId <= 0) {
    console.error("Invalid product ID:", myParam);
    document.getElementById("product-detail").innerHTML =
      "<p>Product not found.</p>";
    return;
  }

  getDetailGiay(productId);
  console.log("params", myParam);
};
