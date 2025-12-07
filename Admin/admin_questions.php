<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions Manager | Shoes Shop</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

    <link rel="stylesheet" href="../public/assets/css/style.css" />
</head>

<body class="bg-light">
    <?php include 'sidebar.php'; ?>

    <div class="container my-5">
        <h1 class="my-4">Câu hỏi từ khách hàng</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Danh mục</th>
                    <th>Câu hỏi</th>
                    <th style="width: 1%; white-space: nowrap; text-align: center;">Thao tác</th>
                </tr>
            </thead>
            <tbody id="questionTable"></tbody>
        </table>
    </div>

    <script>
        const user = JSON.parse(localStorage.getItem("user"));
        if (user["role"] !== "admin") {
            alert("Bạn phải là admin để truy cập trang này!");
            window.location.href = "../public/index.php";
        }
        function loadQuestions() {
            fetch("../api/FAQ/getAllQuestions.php")
                .then(res => res.json())
                .then(res => {
                    const table = document.getElementById("questionTable");
                    table.innerHTML = "";
                    res.data.forEach(q => {
                        table.innerHTML += `
                    <tr>
                        <td>${q.user_name}</td>
                        <td>${q.user_email}</td>
                        <td>${q.category_name}</td>
                        <td>${q.question}</td>
                        <td class="text-center">
                            <button onclick="del(${q.question_id})" class="btn btn-danger btn-sm">Xoá</button>
                        </td>
                    </tr>
                `;
                    });
                });
        }
        loadQuestions();

        function del(id) {
            const fd = new FormData();
            fd.append("question_id", id);

            fetch("../api/FAQ/deleteQuestion.php", {
                method: "POST",
                body: fd
            }).then(() => loadQuestions());
        }
    </script>



</body>

</html>