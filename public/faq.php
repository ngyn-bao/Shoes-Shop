<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ | Shoes Shop</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <!-- Bootstrap -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

    <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <div class="container my-5">
        <h1 class="mb-4">Câu hỏi thường gặp (FAQs)</h1>

        <div id="faq-container"></div>

        <hr class="my-5">

        <h4>Bạn còn câu hỏi khác? Hãy cho chúng tôi biết</h4>

        <form id="questionForm" class="my-4">
            <div class="mb-3">
                <select class="form-control" name="category_id" id="categorySelect" required>
                    <option value="" disabled selected hidden>Chọn một danh mục liên quan</option>
                </select>
            </div>

            <div class="mb-3">
                <textarea class="form-control" name="question" placeholder="Nhập câu hỏi..." required></textarea>
            </div>
            <div class="col text-end">
                <button class="btn btn-dark">Gửi câu hỏi</button>
            </div>
        </form>

        <div id="msg" class="mt-3" style="color: red; text-align: center"></div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <script>
        const faqContainer = document.getElementById("faq-container");
        const categorySelect = document.getElementById("categorySelect");

        // Load categories
        fetch("../api/FAQ/getAllCategories.php")
            .then(res => res.json())
            .then(res => {
                res.data.forEach(cat => {
                    categorySelect.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
                });
            });

        // Load FAQs
        fetch("../api/FAQ/getAllFAQ.php")
            .then(res => res.json())
            .then(res => {
                const data = res.data;
                const grouped = {};

                data.forEach(item => {
                    if (!grouped[item.category_id]) {
                        grouped[item.category_id] = {
                            name: item.category_name,
                            faqs: []
                        };
                    }
                    grouped[item.category_id].faqs.push(item);
                });

                for (const key in grouped) {
                    const category = grouped[key];

                    let html = `
            <div class="card mb-3">
                <div class="card-header fw-bold d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#cat-${key}">
                    <span style="font-size: 18px">${category.name}</span>
                    <i class="fas fa-chevron-down" style="color: gray"></i>
                </div>
                <div class="collapse" id="cat-${key}">
                    <div class="card-body">`;

                    category.faqs.forEach(f => {
                        html += `
                    <p style="color: gray"><b>${f.question}</b></p>
                    <p style="color: gray">${f.answer}</p>
                    <hr>
                `;
                    });

                    html += `</div></div></div>`;
                    faqContainer.innerHTML += html;
                }
            });

        // Submit Question
        document.getElementById("questionForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch("../api/FAQ/createQuestion.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    document.getElementById("msg").innerHTML = res.message;
                    this.reset();
                });
        });
    </script>

    <?php include __DIR__ . '/includes/footer.php'; ?>

</body>

</html>