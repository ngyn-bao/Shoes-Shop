<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<style>
    /* =========================================
       1. CẤU HÌNH CHUNG 
       ========================================= */
    body {
        min-height: 100vh;
        display: flex;
        background-color: #f8f9fa;
        margin: 0;
        font-family: system-ui, -apple-system, sans-serif;
        overflow-x: hidden;
    }

    .sidebar {
        background-color: #343a40;
        color: #fff;
        flex-shrink: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        z-index: 1000;
        white-space: nowrap;
        overflow: hidden;
    }

    /* Header của Sidebar */
    .sidebar-header {
        height: 70px;
        display: flex;
        align-items: center;
        padding: 0 20px;
        border-bottom: 1px solid #495057;
        background-color: #212529;
        justify-content: space-between;
    }

    .sidebar-header .brand-text {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        font-size: 1.25rem;
        transition: opacity 0.2s;
    }

    #sidebarToggle {
        background: none;
        border: none;
        color: #fff;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0;
    }

    .sidebar-header a:hover,
    .sidebar-header button:hover {
        background: none !important;
        color: inherit !important;
    }

    /* Link Menu */
    .sidebar a.nav-link {
        display: flex;
        align-items: center;
        padding: 15px 25px;
        color: #adb5bd;
        text-decoration: none;
        border-bottom: 1px solid #495057;
        height: 55px;
    }

    .sidebar a.nav-link:hover {
        background-color: #495057;
        color: #fff;
    }

    .sidebar a.nav-link.active {
        background-color: #0d6efd;
        color: white;
    }

    .sidebar a.nav-link i {
        font-size: 1.25rem;
        min-width: 30px;
        margin-right: 10px;
        text-align: center;
    }

    .sidebar .logout-link {
        margin-top: auto;
        background-color: #212529;
    }

    /* Nội dung chính */
    .main-content {
        flex-grow: 1;
        min-width: 0;
        padding: 30px;
        background-color: #f8f9fa;
        transition: margin-left 0.3s ease;
    }

    /* =========================================
       2. LOGIC CHO DESKTOP (Màn hình > 992px)
       ========================================= */
    @media (min-width: 992px) {
        .sidebar {
            width: 260px;
        }

        body.sidebar-collapsed .sidebar {
            width: 80px;
        }

        /* Ẩn chữ và Logo khi thu nhỏ */
        body.sidebar-collapsed .sidebar .link-text,
        body.sidebar-collapsed .sidebar .brand-text {
            opacity: 0;
            pointer-events: none;
            display: none;
        }

        /* Căn giữa Icon khi thu nhỏ */
        body.sidebar-collapsed .sidebar a.nav-link {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        body.sidebar-collapsed .sidebar a.nav-link i {
            margin-right: 0;
            font-size: 1.5rem;
        }

        /* Căn giữa nút 3 gạch khi thu nhỏ */
        body.sidebar-collapsed .sidebar-header {
            justify-content: center;
            padding: 0;
        }
    }

    /* =========================================
       3. LOGIC CHO MOBILE (Màn hình < 992px)
       ========================================= */
    @media (max-width: 991.98px) {
        body {
            display: block;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 260px;
            transform: translateX(-100%);
        }

        body.sidebar-collapsed .sidebar {
            transform: translateX(0);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .main-content {
            width: 100%;
            padding: 15px;
        }

        body.sidebar-collapsed .main-content {
            opacity: 0.3;
            pointer-events: none;
        }
    }
</style>

<div class="sidebar">
    <div class="sidebar-header">
        <a href="index.php" class="brand-text">Shoes Admin</a>
        <button id="sidebarToggle"><i class="bi bi-list"></i></button>
    </div>

    <a href="admin_user.php" class="nav-link <?= ($current_page == 'admin_user.php') ? 'active' : '' ?>"
        title="Người dùng">
        <i class="bi bi-person"></i> <span class="link-text">Quản lý người dùng</span>
    </a>

    <a href="products.php" class="nav-link <?= ($current_page == 'products.php') ? 'active' : '' ?>" title="Sản phẩm">
        <i class="bi bi-box-seam"></i> <span class="link-text">Quản lý sản phẩm</span>
    </a>

    <a href="orders.php" class="nav-link <?= ($current_page == 'orders.php') ? 'active' : '' ?>" title="Đơn hàng">
        <i class="bi bi-bag"></i> <span class="link-text">Quản lý đơn hàng</span>
    </a>

    <a href="contacts.php" class="nav-link <?= ($current_page == 'contacts.php') ? 'active' : '' ?>" title="Liên hệ">
        <i class="bi bi-envelope"></i> <span class="link-text">Quản lý liên hệ</span>
    </a>

    <a href="ArticleIndex.php" class="nav-link <?= ($current_page == 'ArticleIndex.php') ? 'active' : '' ?>"
        title="Bài viết">
        <i class="bi bi-newspaper"></i> <span class="link-text">Quản lý bài báo</span>
    </a>

    <a href="admin_faq.php" class="nav-link <?= ($current_page == 'admin_faq.php') ? 'active' : '' ?>" title="FAQ">
        <i class="bi bi-question-lg"></i> <span class="link-text">Quản lý FAQ</span>
    </a>

    <a href="admin_questions.php" class="nav-link <?= ($current_page == 'admin_questions.php') ? 'active' : '' ?>"
        title="Câu hỏi">
        <i class="bi bi-chat-dots"></i> <span class="link-text">Quản lý câu hỏi</span>
    </a>

    <a href="#" id="btnLogout" class="nav-link logout-link" title="Đăng xuất">
        <i class="bi bi-door-closed"></i> <span class="link-text">Logout</span>
    </a>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggleBtn = document.getElementById('sidebarToggle');
        const body = document.body;

        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            body.classList.toggle('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', body.classList.contains('sidebar-collapsed'));
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth < 992 &&
                body.classList.contains('sidebar-collapsed') &&
                !e.target.closest('.sidebar') &&
                !e.target.closest('#sidebarToggle')) {
                body.classList.remove('sidebar-collapsed');
            }
        });

        if (window.innerWidth >= 992) {
            const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
            if (isCollapsed) body.classList.add('sidebar-collapsed');
        }

        let startX = 0;
        let endX = 0;

        function handleGesture() {
            if (window.innerWidth >= 992) return;

            const swipeDistance = endX - startX;
            const threshold = 100; // Khoảng cách tối thiểu để nhận diện quẹt

            console.log(`Bắt đầu: ${startX}, Khoảng cách: ${swipeDistance}`);

            // A. QUẸT PHẢI (MỞ MENU) 
            if (swipeDistance > threshold) {
                console.log("-> MỞ MENU!");
                if (!body.classList.contains('sidebar-collapsed')) {
                    body.classList.add('sidebar-collapsed');
                }
            }

            // B. QUẸT TRÁI (ĐÓNG MENU)
            if (swipeDistance < -threshold) {
                console.log("-> ĐÓNG MENU!");
                if (body.classList.contains('sidebar-collapsed')) {
                    body.classList.remove('sidebar-collapsed');
                }
            }
        }

        // Cảm ứng
        document.addEventListener('touchstart', e => {
            startX = e.changedTouches[0].screenX;
        }, { passive: true });

        document.addEventListener('touchend', e => {
            endX = e.changedTouches[0].screenX;
            handleGesture();
        }, { passive: true });

        // Chuột
        document.addEventListener('mousedown', e => {
            startX = e.clientX;
        });

        document.addEventListener('mouseup', e => {
            endX = e.clientX;
            handleGesture();
        });

        document.body.addEventListener("click", async (e) => {
            const target = e.target.closest("#btnLogout");
            if (target) {
                e.preventDefault();
                if (!confirm("Bạn có chắc chắn muốn đăng xuất?")) return;
                try {
                    if (typeof axios !== 'undefined') {
                        await axios.post("../api/Authentication/logout.php");
                        localStorage.removeItem("user");
                        localStorage.removeItem("cart");
                    }
                    window.location.href = "../public/login.php";
                } catch (err) { window.location.href = "../public/login.php"; }
            }
        });
    });
</script>