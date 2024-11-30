export function renderDuLieuGiay(arr, idTheCha = "baiTap2") {
  let content = "";
  for (let giay of arr) {
    let { name, image, price, shortDescription, id } = giay;
    content += `
           <div class="col-4 rounded">
                <!-- Hình ảnh -->
                <img src="${image}" class="w-100 bg-light px-3" alt="" />
      
                <div class="shoes-info bg-light px-3 pb-3">
                <!-- Shoes' name -->
                <h3 class="text-uppercase">${name}</h3>
      
                <!-- Shop description -->
                <p class="mb-0">${capitalizeFirstLetter(
                  shortDescription
                )}</p></div>
      
                <div class="d-flex align-items-center text-center">
                  <!-- Button -->
                  <div class="w-50" style="background-color:#ffc107;cursor:pointer;"  onclick="location.href='./detail.html?productid=${id}'"><button class="btn btn-warning text-dark">Buy Now</button></div>
                  <!-- Price -->
                  <div class="w-50" style="background-color:#E7E9EB;padding: 6px"><h5 class="m-0">${chuyenDoiTienTe(
                    price
                  )}</h5></div>
                  
                </div>
          </div>
          `;
  }
  document.getElementById(idTheCha).innerHTML = content;
}

// export default renderDuLieuGiay;

export function chuyenDoiTienTe(price) {
  price = price * 25000;
  return price.toLocaleString("vn-VN", { style: "currency", currency: "VND" });
}

export function capitalizeFirstLetter(val) {
  return String(val).charAt(0).toUpperCase() + String(val).slice(1);
}

export function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

export function shortenText(text) {
  return text.length > 50 ? text.slice(0, 50) + "&hellip;" : text;
}
