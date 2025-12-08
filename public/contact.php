<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ | Shoes Shop</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <div class="container my-5">
        <h1 class="mb-4">Liên hệ với chúng tôi</h1>

        <!-- Phần thông tin liên hệ nhanh (giống như FAQ có danh mục) -->
        <div id="contact-info-container" class="mb-5"></div>

        <hr class="my-5">

        <h4>Gửi tin nhắn cho chúng tôi</h4>

        <form id="contactForm" class="my-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="full_name" class="form-control" placeholder="Họ và tên *" required>
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Email *" required>
                </div>
                <div class="col-12">
                    <input type="text" name="phone" class="form-control" placeholder="Số điện thoại (không bắt buộc)">
                </div>
                <div class="col-12">
                    <textarea name="message" class="form-control" rows="5" placeholder="Nội dung tin nhắn của bạn..." required></textarea>
                </div>
                <div class="col text-end">
                    <button type="submit" class="btn btn-dark px-4">
                        <i class="fa-solid fa-paper-plane"></i> Gửi tin nhắn
                    </button>
                </div>
            </div>
        </form>

        <div id="msg" class="mt-3 text-center fw-bold" style="color: red;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <script>
        const contactInfo = [
            { icon: "fa-phone", title: "Hotline", content: "1900 1234<br><small class='text-muted'>(8h - 21h hàng ngày)</small>" },
            { icon: "fa-envelope", title: "Email", content: "support@shoesshop.vn" },
            { icon: "fa-map-marker-alt", title: "Địa chỉ", content: "123 Đường Giày Dép, Q. Tân Bình, TP. Hồ Chí Minh" },
            { icon: "fa-clock", title: "Giờ làm việc", content: "Thứ 2 - Thứ 7: 8h30 - 21h30<br>Chủ nhật: 9h - 20h" }
        ];

        const container = document.getElementById("contact-info-container");

        contactInfo.forEach((info, index) => {
            const html = `
                <div class="card mb-3">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center" 
                         data-bs-toggle="collapse" data-bs-target="#contact-${index}">
                        <span style="font-size: 18px">
                            <i class="fas ${info.icon} me-2"></i> ${info.title}
                        </span>
                        <i class="fas fa-chevron-down" style="color: gray"></i>
                    </div>
                    <div class="collapse show" id="contact-${index}">
                        <div class="card-body">
                            <p class="mb-0" style="color: gray">${info.content}</p>
                        </div>
                    </div>
                </div>`;
            container.innerHTML += html;
        });

        // Xử lý gửi form liên hệ
        document.getElementById("contactForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const msgDiv = document.getElementById("msg");
            msgDiv.innerHTML = "Đang gửi...";
            msgDiv.style.color = "#333";

            const formData = new FormData(this);
            const data = {
                full_name: formData.get("full_name").trim(),
                email: formData.get("email").trim(),
                phone: formData.get("phone").trim(),
                message: formData.get("message").trim()
            };

            if (!data.full_name || !data.email || !data.message) {
                msgDiv.innerHTML = "Vui lòng điền đầy đủ các trường có dấu (*)";
                msgDiv.style.color = "red";
                return;
            }

            try {
                const response = await fetch("../api/Contact/sendContact.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    msgDiv.innerHTML = "Cảm ơn bạn! Tin nhắn đã được gửi thành công. Chúng tôi sẽ phản hồi sớm nhất!";
                    msgDiv.style.color = "green";
                    this.reset();
                } else {
                    msgDiv.innerHTML = result.error || "Gửi thất bại, vui lòng thử lại.";
                    msgDiv.style.color = "red";
                }
            } catch (err) {
                msgDiv.innerHTML = "Lỗi kết nối. Vui lòng kiểm tra mạng và thử lại.";
                msgDiv.style.color = "red";
            }
        });
    </script>

    <?php include __DIR__ . '/includes/footer.php'; ?>

</body>

</html>