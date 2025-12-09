<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us | Shoes Shop</title>
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <!-- Font Awesome -->
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />

    <!-- Bootstrap -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    />

    <link rel="stylesheet" href="./assets/css/style.css" />
</head>
<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <div class="container my-5">
        <div id="aboutContent" class="row align-items-center"></div>
    </div>

    <script>
    fetch("/api/SiteContent/getPageContent.php?page=about")
    .then(res => res.json())
    .then(res => {
        const data = res.data;

        document.getElementById("aboutContent").innerHTML = `
            <h1 class="mb-4">${data.title}</h1>

            <div class="content-area fs-5">
                ${data.content_html}
            </div>

            <div class="text-center my-4">
                <img src="${data.image_url}" class="img-fluid rounded" style="max-height:350px; object-fit:cover;">
            </div>
        `;
    });
    </script>

    <?php include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>