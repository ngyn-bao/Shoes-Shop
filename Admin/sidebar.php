<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<style>
    :root {
        --sidebar-width: 260px;
        --sidebar-collapsed-width: 80px;
        --sidebar-bg: #182433;       
        --sidebar-hover: #232e3c;    
        --sidebar-active: #0054a6;   
        --text-color: #dce1e7;       
    }

    body, .page {
        display: flex !important;
        flex-direction: row !important;
        min-height: 100vh;
        margin: 0;
        background-color: #f4f6fa;
        overflow-x: hidden; 
        
    }

    /* =========================================
       2. STYLE SIDEBAR (DESKTOP)
       ========================================= */
    .sidebar {
        width: var(--sidebar-width);
        background-color: var(--sidebar-bg);
        color: var(--text-color);
        flex-shrink: 0 !important; /* KHÔNG bao giờ được co lại */
        display: flex;
        flex-direction: column;
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1050;
        border-right: 1px solid rgba(255,255,255,0.1);
        position: sticky; /* Dính chặt khi cuộn */
        top: 0;
        height: 100vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .sidebar-header {
        height: 64px;
        display: flex;
        align-items: center;
        padding: 0 24px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        background-color: rgba(0,0,0,0.1);
        justify-content: space-between;
        white-space: nowrap;
    }

    .brand-text {
        font-size: 1.1rem;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    #sidebarToggle {
        background: transparent;
        border: none;
        color: rgba(255,255,255,0.7);
        font-size: 1.4rem;
        cursor: pointer;
        padding: 4px;
        transition: 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #sidebarToggle:hover { color: #fff; }

    /* Menu Links */
    .nav-link {
        display: flex;
        align-items: center;
        padding: 14px 24px;
        color: #aebac6;
        text-decoration: none;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
        white-space: nowrap;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .nav-link i {
        font-size: 1.2rem;
        width: 24px;
        margin-right: 12px;
        text-align: center;
        display: inline-block;
    }

    .nav-link:hover {
        background-color: var(--sidebar-hover);
        color: #fff;
    }

    /* Active State */
    .nav-link.active {
        background-color: rgba(32, 107, 196, 0.1);
        color: #4299e1;
        border-left-color: #4299e1;
    }

    /* Logout Button */
    .logout-link {
        margin-top: auto;
        border-top: 1px solid rgba(255,255,255,0.1);
        color: #ff6b6b;
    }
    .logout-link:hover {
        background-color: rgba(255, 107, 107, 0.1);
        color: #ff8787;
    }

    /* =========================================
       3. TRẠNG THÁI THU NHỎ (DESKTOP)
       ========================================= */
    @media (min-width: 992px) {
        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed-width);
        }

        body.sidebar-collapsed .brand-text,
        body.sidebar-collapsed .link-text {
            display: none !important;
            opacity: 0;
        }

        body.sidebar-collapsed .sidebar-header {
            justify-content: center;
            padding: 0;
        }

        body.sidebar-collapsed .nav-link {
            justify-content: center;
            padding: 14px 0;
            border-left: none;
            border-right: 3px solid transparent; /* Đổi viền sang phải */
        }

        body.sidebar-collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.4rem;
        }
        
        body.sidebar-collapsed .nav-link.active {
            border-right-color: #4299e1;
        }
    }

    /* =========================================
       4. TRẠNG THÁI MOBILE (< 992px)
       ========================================= */
    @media (max-width: 991.98px) {
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            transform: translateX(-100%); /* Ẩn sidebar */
            width: var(--sidebar-width);
            box-shadow: none;
        }

        /* Khi mở menu trên mobile */
        body.sidebar-collapsed .sidebar {
            transform: translateX(0);
            box-shadow: 0 0 50px rgba(0,0,0,0.5);
        }

        /* Overlay làm tối nền */
        body.sidebar-collapsed::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
            backdrop-filter: blur(2px);
        }
    }
</style>

<div class="sidebar">
    <div class="sidebar-header">
        <a href="index.php" class="brand-text">Shoes Admin</a>
        <button id="sidebarToggle"><i class="bi bi-list"></i></button>
    </div>

    <div style="flex: 1; display: flex; flex-direction: column; overflow-y: auto;">
        <a href="admin_user.php" class="nav-link <?= ($current_page == 'admin_user.php') ? 'active' : '' ?>" title="Người dùng">
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

        <a href="ArticleIndex.php" class="nav-link <?= ($current_page == 'ArticleIndex.php') ? 'active' : '' ?>" title="Bài viết">
            <i class="bi bi-newspaper"></i> <span class="link-text">Quản lý bài báo</span>
        </a>

        <a href="admin_faq.php" class="nav-link <?= ($current_page == 'admin_faq.php') ? 'active' : '' ?>" title="FAQ">
            <i class="bi bi-question-lg"></i> <span class="link-text">Quản lý FAQ</span>
        </a>

        <a href="admin_questions.php" class="nav-link <?= ($current_page == 'admin_questions.php') ? 'active' : '' ?>" title="Câu hỏi">
            <i class="bi bi-chat-dots"></i> <span class="link-text">Quản lý câu hỏi</span>
        </a>
    </div>

    <a href="#" id="btnLogout" class="nav-link logout-link" title="Đăng xuất">
        <i class="bi bi-door-closed"></i> <span class="link-text">Logout</span>
    </a>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggleBtn = document.getElementById('sidebarToggle');
        const body = document.body;

        // 1. Toggle Button
        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            body.classList.toggle('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', body.classList.contains('sidebar-collapsed'));
        });

        // 2. Click outside to close (Mobile)
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 992 &&
                body.classList.contains('sidebar-collapsed') &&
                !e.target.closest('.sidebar') &&
                !e.target.closest('#sidebarToggle')) {
                body.classList.remove('sidebar-collapsed');
            }
        });

        // 3. Restore State (Desktop)
        if (window.innerWidth >= 992) {
            const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
            if (isCollapsed) body.classList.add('sidebar-collapsed');
        }

        // 4. Swipe Logic
        let startX = 0;
        let endX = 0;

        function handleGesture() {
            if (window.innerWidth >= 992) return;
            const swipeDistance = endX - startX;
            const threshold = 150;

            // Swipe Right (Open)
            if (swipeDistance > threshold) {
                if (!body.classList.contains('sidebar-collapsed')) {
                    body.classList.add('sidebar-collapsed');
                }
            }
            // Swipe Left (Close)
            if (swipeDistance < -threshold) {
                if (body.classList.contains('sidebar-collapsed')) {
                    body.classList.remove('sidebar-collapsed');
                }
            }
        }

        document.addEventListener('touchstart', e => { startX = e.changedTouches[0].screenX; }, { passive: true });
        document.addEventListener('touchend', e => { endX = e.changedTouches[0].screenX; handleGesture(); }, { passive: true });
        document.addEventListener('mousedown', e => { startX = e.clientX; });
        document.addEventListener('mouseup', e => { endX = e.clientX; handleGesture(); });

        // 5. Logout Logic
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