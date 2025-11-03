import {
  capitalizeFirstLetter,
  chuyenDoiTienTe,
  getRandomInt,
  renderDuLieuGiay,
  renderDuLieuGiay2,
  shortenText,
} from "../common/util.js";

// const arrMonAn = [
//   {
//     tenMon: "Mì Ý",
//     giaMon: 30000,
//     moTa: "được làm từ mì",
//     trangThai: true,
//   },
//   {
//     tenMon: "Mì cay",
//     giaMon: 50000,
//     moTa: "được làm từ mì",
//     trangThai: true,
//   },
//   {
//     tenMon: "Lẩu Tứ Xuyên",
//     giaMon: 300000,
//     moTa: "được làm từ mì",
//     trangThai: false,
//   },
//   {
//     tenMon: "Lẩu chay",
//     giaMon: 35000,
//     moTa: "được làm từ mì",
//     trangThai: true,
//   },
// ];

// function renderArrMonAn(arr = arrMonAn) {
//   let content = "";
//   for (let monAn of arr) {
//     let { tenMon, giaMon, moTa, trangThai } = monAn;
//     if (trangThai) {
//       content += `<div class="col-4">
//     <!-- Tên món -->
//         <h3>${tenMon}</h3>

//     <!-- Giá món -->
//         <p>${giaMon}</p>

//     <!-- Mô tả -->
//         <p>${moTa}</p>
//     </div>`;
//     }
//   }
//   document.getElementById("baiTap1").innerHTML = content;
// }

// renderArrMonAn();

// Home Shoes Shop
function getDuLieuGiay(pageIndex = 1, pageSize = 6) {
  let promise = axios({
    url: "https://shop.cyberlearn.vn/api/Product",
    method: "GET",
  });
  promise
    .then((resolve) => {
      // let arr = resolve.data.content;
      // console.log(arr);
      renderBanner(resolve.data.content);
      // renderDuLieuGiay(resolve.data.content);
    })
    .catch((err) => {
      console.log(err);
      document.getElementById("banner").innerHTML =
        "<p>Failed to load products.</p>";
    });

  promise = axios({
    url: `https://shop.cyberlearn.vn/api/Product/getpaging?pageIndex=${pageIndex}&pageSize=${pageSize}`,
    method: "GET",
  });
  promise
    .then((resolve) => {
      const data = resolve.data.content;
      console.log(data);

      renderDuLieuGiay2(data.items);
      renderPagination(data.pageIndex, data.pageSize, data.totalRow);
    })
    .catch((err) => {
      console.log(err);
      document.getElementById("baiTap2").innerHTML =
        "<p>Failed to load products.</p>";
    });
}

// renderBanner();
// renderDuLieuGiay();

// function renderDuLieuGiay(arr, idTheCha = "baiTap2") {
//   let content = "";
//   for (let giay of arr) {
//     let { name, image, price, shortDescription, id } = giay;
//     content += `
//            <div class="col-4">
//                 <!-- Hình ảnh -->
//                 <img src="${image}" class="w-100" alt="" />

//                 <!-- Shoes' name -->
//                 <h3>${capitalizeFirstLetter(name)}</h3>

//                 <!-- Shop description -->
//                 <p>${capitalizeFirstLetter(shortDescription)}</p>

//                 <div class="d-flex justify-content-between align-items-center">
//                   <!-- Button -->
//                   <button onclick="location.href='./detail.html?productid=${id}'" class="btn btn-warning text-dark">Buy Now</button>
//                   <!-- Price -->
//                   <h5>${chuyenDoiTienTe(price)}</h5>
//                 </div>
//           </div>
//           `;
//   }
//   document.getElementById(idTheCha).innerHTML = content;
// }

function renderBanner(arr, id = "banner-content") {
  let content = "";
  for (let index = 0; index < 3; index++) {
    let item = arr[getRandomInt(0, 17)];
    content += renderBannerItem(item);
  }
  document.getElementById(id).innerHTML = content;

  $("#banner-content").trigger("destroy.owl.carousel");
  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    navText: [
      "<img src='./img/Polygon 2.png'>",
      "<img src='./img/Polygon 1.png'>",
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

function renderBannerItem(item) {
  let content = "";
  let { name, image, shortDescription, id } = item;
  content = `<div
          class="banner-item d-flex justify-content-between align-items-center"
        >
          <div class="banner-img">
            <img src=${image} alt="" />
          </div>
          <div class="banner-text ">
            <h2 class="fs-1 fw-normal text-uppercase">${name}</h2>
            <p class="fw-light">${shortenText(
              capitalizeFirstLetter(shortDescription)
            )}</p>
            <button onclick="location.href='./detail.html?productid=${id}'" class="btn btn-warning py-3 px-5 text-white">
              Buy Now
            </button>
          </div>
        </div>`;

  return content;
}

// function goToPage(id) {
//   return (window.location.href = `./detail.html?productid=${id}`);
// }

function renderPagination(
  currentPage,
  pageSize,
  totalRow,
  id = "pagination-container"
) {
  let totalPages = Math.ceil(totalRow / pageSize);
  let content = "";

  content += `<button class="page-btn" id="prev-btn">&laquo;</button>`;

  if (currentPage <= 1) currentPage = 1;

  for (let page = 1; page <= totalPages; page++) {
    content += `
      <button class="page-btn ${
        page === currentPage ? "active" : ""
      }" id="page-btn-${page}">${page}</button>
    `;
  }

  content += `<button class="page-btn" id="next-btn">&raquo;</button>`;

  if (currentPage > totalPages) currentPage = totalPages;

  document.getElementById(id).innerHTML = content;

  attachPaginationEvents(currentPage, totalPages);
}

function attachPaginationEvents(currentPage, totalPages) {
  if (currentPage >= 1) {
    const prevButton = document.getElementById("prev-btn");
    if (prevButton) {
      if (currentPage === 1) prevButton.disabled = true;
      else {
        prevButton.addEventListener("click", () => {
          getDuLieuGiay(currentPage - 1);
        });
      }
    }
  }

  for (let page = 1; page <= totalPages; page++) {
    let pageButton = document.getElementById(`page-btn-${page}`);
    if (pageButton) {
      pageButton.addEventListener("click", () => {
        getDuLieuGiay(page);
      });
    }
  }

  if (currentPage <= totalPages) {
    const nextButton = document.getElementById("next-btn");
    if (nextButton) {
      if (currentPage === totalPages) nextButton.disabled = true;
      else {
        nextButton.addEventListener("click", () => {
          getDuLieuGiay(currentPage + 1);
        });
      }
    }
  }
}

window.onload = function () {
  const urlParams = new URLSearchParams(window.location.search);
  const myParam = urlParams.get("productid");
  console.log("param", myParam);
  getDuLieuGiay();
};
