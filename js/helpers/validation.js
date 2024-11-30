export function checkEmpty(value, span) {
  if (value) {
    span.style.display = "none";
    span.innerHTML = "";
    return true;
  } else {
    span.style.display = "block";
    span.innerHTML = "Không được bỏ trống!";
    return false;
  }
}

export function checkLength(value, span, min, max) {
  let length = value.length;
  if (length >= min && length <= max) {
    span.style.display = "none";
    span.innerHTML = "";
    return true;
  } else {
    span.style.display = "block";
    span.innerHTML = `Độ dài phải từ ${min} đến ${max}`;
    return false;
  }
}

export function checkExist(value, span, arr) {
  for (let item of arr) {
    if (item.tknv == value) {
      span.style.display = "block";
      span.innerHTML = "Tài khoản đã tồn tại!";
      return false;
    }
  }
  span.style.display = "none";
  span.innerHTML = "";
  return true;
}

export function checkValue(value, span, min, max) {
  let numVal = value * 1;
  if (numVal >= min && numVal <= max) {
    span.style.display = "none";
    span.innerHTML = "";
    return true;
  } else {
    span.style.display = "block";
    span.innerHTML = `Độ lớn phải từ ${min} đến ${max}`;
    return false;
  }
}

export function checkNameValid(value, span) {
  const regexName = /^[a-zA-Z\s]+$/;
  let valid = regexName.test(value);

  if (valid) {
    span.style.display = "none";
    span.innerHTML = "";
    return true;
  } else {
    span.style.display = "block";
    span.innerHTML = "Tên nhân viên phải là chữ!";
    return false;
  }
}

export function checkEmailValid(value, span) {
  const regexEmail =
    /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
  let valid = regexEmail.test(value);

  if (valid) {
    span.style.display = "none";
    span.innerHTML = "";
    return true;
  } else {
    span.style.display = "block";
    span.innerHTML = "Email không đúng định dạng!";
    return false;
  }
}

export function checkPasswordValid(value, span) {
  const regexPassword =
    /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
  let valid = regexPassword.test(value);

  if (valid) {
    span.style.display = "none";
    span.innerHTML = "";
    return true;
  } else {
    span.style.display = "block";
    span.innerHTML =
      "Mật khẩu phải chứa ít nhất 1 ký tự số, 1 ký tự in hoa, 1 ký tự đặc biệt!";
    return false;
  }
}

export function convertToMMDDYYYY(value) {
  const regexDate = /^\d{4}-\d{2}-\d{2}$/;

  if (regexDate.test(value)) {
    const parts = value.split("-");
    return `${parts[1]}/${parts[2]}/${parts[0]}`;
  }

  const regexMMDDYYYY = /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}$/;
  if (regexMMDDYYYY.test(value)) return value;
}

export function checkGender(span) {
  let gioiTinhNam = document.getElementById("gender-male");

  let gioiTinhNu = document.getElementById("gender-female");

  if (gioiTinhNam.checked || gioiTinhNu.checked) {
    span.style.display = "none";
    span.innerHTML = "";
    return true;
  } else {
    span.style.display = "block";
    span.innerHTML = "Vui lòng chọn giới tính!";
    return false;
  }
}

export function confirmPassword(value, confirmValue, span) {
  if (value === confirmValue && value !== "") {
    span.style.display = "none";
    span.innerHTML = "";
    return true;
  } else {
    span.style.display = "block";
    span.innerHTML = "Mật khẩu không khớp!";
    return false;
  }
}

export function checkPhoneValid(value, span) {
  const regexPhone = /^[0-9\-\+]{9,15}$/;
  let valid = regexPhone.test(value);
  if (valid) {
    span.style.display = "none";
    span.innerHTML = "";
    return true;
  } else {
    span.style.display = "block";
    span.innerHTML = "Số điện thoại không hợp lệ!";
    return false;
  }
}
