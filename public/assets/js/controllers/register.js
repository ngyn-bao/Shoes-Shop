import {
  checkEmailValid,
  checkEmpty,
  checkGender,
  checkNameValid,
  checkPasswordValid,
  checkPhoneValid,
  confirmPassword,
} from "../helpers/validation.js";

const form = document.querySelector("form");

form.addEventListener("submit", (event) => {
  event.preventDefault();

  if (validForm()) {
    register();
  }
});

function register() {
  let formData = new FormData(form);

  // for (let [key, value] of result.entries()) {
  //   console.log(`${key}: ${value}`);
  // }

  let result = {};
  formData.forEach((value, key) => {
    result[key] = value;
  });

  let gender = document.querySelector("input[name='radio']:checked");
  result.gender = gender ? gender.value === "true" : null;

  // console.log(result);

  let promise = axios({
    url: "https://shop.cyberlearn.vn/api/Users/signup",
    method: "POST",
    data: result,
  });
  promise
    .then((resolve) => {
      // console.log(resolve);
      let notification = new Notify(
        "Registered successfully",
        `${resolve.data.message}`,
        "success",
        {
          // or 'bottom'
          vAlign: "top",
          // or 'left'
          hAlign: "right",
          // auto close after a timeout
          autoClose: true,
          // duration in ms
          autoCloseDuration: 5000,
          // click x button to close
          closeOnCrossClick: true,
          // click the notification box to close
          closeOnNotifyClick: false,
        }
      );

      form.reset();
      console.log("Đăng ký thành công!\n", resolve.data.content);
    })
    .catch((error) => {
      let notification = new Notify(
        "Registration failed",
        `${error.response.data.message}`,
        "error",
        {
          // or 'bottom'
          vAlign: "top",
          // or 'left'
          hAlign: "right",
          // auto close after a timeout
          autoClose: true,
          // duration in ms
          autoCloseDuration: 5000,
          // click x button to close
          closeOnCrossClick: true,
          // click the notification box to close
          closeOnNotifyClick: false,
        }
      );
      console.log("Đăng ký thất bại!\n");
      console.log(error.response.data.message);
    });
}

function validForm() {
  let fieldArr = document.querySelectorAll(".form-group input");

  let isValid = true;

  for (let field of fieldArr) {
    // console.log(fieldArr);
    const spanThongBao = field.nextElementSibling;
    const value = field.value.trim();

    let dataAtrribute = field.getAttribute("data-validation");

    let isntEmpty = checkEmpty(value, spanThongBao);
    if (!isntEmpty) {
      isValid = false;
      continue;
    } else isValid &= isntEmpty;

    switch (dataAtrribute) {
      case "email":
        isValid &= checkEmailValid(value, spanThongBao);
        break;

      case "name":
        isValid &= checkNameValid(value, spanThongBao);
        break;

      case "password":
        isValid &= checkPasswordValid(value, spanThongBao);
        break;

      case "password-confirm":
        {
          const confirmValue = document.querySelector("#password").value.trim();
          isValid &= confirmPassword(value, confirmValue, spanThongBao);
        }
        break;

      case "phone":
        isValid &= checkPhoneValid(value, spanThongBao);
        break;

      default:
        break;
    }
  }

  let spanThongBao = document.querySelector(".radio-button .sp-thongbao");

  isValid &= checkGender(spanThongBao);

  return isValid;
}
