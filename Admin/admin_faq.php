<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Manager | Shoes Shop</title>
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

<body class="bg-light">

<?php include 'sidebar.php'; ?>

    <div class="container my-5">
        <h1>Quản lý FAQ</h1>

        <hr class="my-4">

        <h4>Tạo FAQ mới</h4>

        <form id="faqForm" class="my-4">
            <input type="hidden" name="faq_id">

            <select class="form-control mb-2" name="category_id" id="adminCategory">
                <option value="" disabled selected hidden>Chọn một danh mục liên quan</option>
            </select>
            <input class="form-control mb-2" name="question" placeholder="Nhập câu hỏi...">
            <textarea class="form-control mb-2" name="answer" placeholder="Nhập câu trả lời..."></textarea>

            <div class="col text-end">
                <button class="btn btn-success">Thêm FAQ</button>
            </div>
        </form>

        <hr class="my-4">

        <h4>Danh sách FAQs hiện tại</h4>

        <table class="table table-bordered my-4">
            <thead>
                <tr>
                    <th>Danh mục</th>
                    <th>Câu hỏi</th>
                    <th style="width: 1%; white-space: nowrap; text-align: center;">Thao tác</th>
                </tr>
            </thead>
            <tbody id="faqTable"></tbody>
        </table>
    </div>

    <!-- Modal Edit FAQ -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Sửa FAQ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="faq_id" id="edit_faq_id">
                        <select class="form-control mb-2" name="category_id" id="edit_category"></select>
                        <input class="form-control mb-2" name="question" id="edit_question" placeholder="Câu hỏi">
                        <textarea class="form-control" name="answer" id="edit_answer" placeholder="Câu trả lời"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-dark">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <script>
        const faqTable = document.getElementById("faqTable");
        const adminCategory = document.getElementById("adminCategory");
        const editCategory = document.getElementById("edit_category");

        // Load categories
        fetch("../api/FAQ/getAllCategories.php")
            .then(res => res.json())
            .then(res => {
                res.data.forEach(cat => {
                    adminCategory.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
                });
                editCategory.innerHTML = adminCategory.innerHTML;
            });

        // Load FAQs
        function loadFAQ() {
            fetch("../api/FAQ/getAllFAQ.php")
                .then(res => res.json())
                .then(res => {
                    faqTable.innerHTML = "";
                    res.data.forEach(f => {
                        faqTable.innerHTML += `
                    <tr>
                        <td>${f.category_name}</td>
                        <td>${f.question}</td>
                        <td style="white-space: nowrap;">
                            <button onclick="edit(${f.faq_id})" class="btn btn-warning btn-sm">Sửa</button>
                            <button onclick="del(${f.faq_id})" class="btn btn-danger btn-sm">Xoá</button>
                        </td>
                    </tr>
                `;
                    });
                });
        }
        loadFAQ();

        // Create / Update
        document.getElementById("faqForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            const api = formData.get("faq_id") ? "../api/FAQ/updateFAQ.php" : "../api/FAQ/createFAQ.php";

            fetch(api, {
                method: "POST",
                body: formData
            }).then(() => {
                this.reset();
                loadFAQ();
            });
        });

        // Delete
        function del(id) {
            const fd = new FormData();
            fd.append("faq_id", id);

            fetch("../api/FAQ/deleteFAQ.php", {
                method: "POST",
                body: fd
            }).then(() => loadFAQ());
        }

        // Edit
        function edit(id) {
            fetch(`../api/FAQ/getFAQById.php?faq_id=${id}`)
                .then(res => res.json())
                .then(res => {
                    const f = res.data;

                    document.getElementById("edit_faq_id").value = f.faq_id;
                    document.getElementById("edit_category").value = f.category_id;
                    document.getElementById("edit_question").value = f.question;
                    document.getElementById("edit_answer").value = f.answer;

                    const modal = new bootstrap.Modal(document.getElementById("editModal"));
                    modal.show();
                });
        }

        // Submit update
        document.getElementById("editForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const fd = new FormData(this);

            fetch("../api/FAQ/updateFAQ.php", {
                    method: "POST",
                    body: fd
                })
                .then(() => {
                    bootstrap.Modal.getInstance(document.getElementById("editModal")).hide();
                    loadFAQ();
                });
        });
    </script>



</body>

</html>