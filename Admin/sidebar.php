<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<style>
  body {
    min-height: 100vh;
    display: flex;
    background-color: #f8f9fa;
    margin: 0;
    font-family: system-ui, -apple-system, sans-serif;
    overflow-x: hidden;
  }

  .sidebar {
    width: 260px;
    background-color: #343a40;
    color: #fff;
    flex-shrink: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    transition: width 0.3s ease;
    white-space: nowrap;
    overflow: hidden;
  }

  body.sidebar-collapsed .sidebar {
    width: 80px;
  }

  body.sidebar-collapsed .sidebar .link-text,
  body.sidebar-collapsed .sidebar .brand-text {
    opacity: 0;
    pointer-events: none;
    display: none;
  }

  body.sidebar-collapsed .sidebar a {
    justify-content: center;
    padding-left: 0;
    padding-right: 0;
  }

  body.sidebar-collapsed .sidebar a i {
    margin-right: 0;
    font-size: 1.5rem;
  }

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
    text-decoration: none;
    color: #fff;
  }

  .sidebar-header .brand-text:hover {
    color: #fff !important;
    background-color: transparent !important;
    opacity: 1;
  }

  #sidebarToggle {
    background: none;
    border: none;
    color: #fff;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 5px;
    transition: 0.2s;
  }

  #sidebarToggle:hover {
    color: #0d6efd;
  }

  .sidebar a {
    display: flex;
    align-items: center;
    padding: 15px 25px;
    color: #adb5bd;
    text-decoration: none;
    border-bottom: 1px solid #495057;
    transition: all 0.2s;
    height: 55px;
  }

  .sidebar a i {
    font-size: 1.25rem;
    min-width: 30px;
    margin-right: 10px;
    text-align: center;
    transition: margin 0.3s;
  }

  .sidebar a:hover {
    background-color: #495057;
    color: #fff;
  }

  .sidebar a.active {
    background-color: #0d6efd;
    color: white;
  }

  .sidebar .logout-link {
    margin-top: auto;
    border-top: 1px solid #495057;
    background-color: #212529;
  }

  .main-content {
    flex-grow: 1;
    padding: 30px;
    background-color: #f8f9fa;
    transition: margin-left 0.3s ease;
    width: 100%;
  }
</style>

<div class="sidebar">
  <div class="sidebar-header">
    <a href="index.php" class="fw-bold fs-4 brand-text">
      Shoes Admin
    </a>
    <button id="sidebarToggle">
      <i class="bi bi-list"></i>
    </button>
  </div>

  <a href="admin_user.php" class="<?= ($current_page == 'admin_user.php') ? 'active' : '' ?>" title="Người dùng">
    <i class="bi bi-person"></i>
    <span class="link-text">Quản lý người dùng</span>
  </a>

  <a href="products.php" class="<?= ($current_page == 'products.php') ? 'active' : '' ?>" title="Sản phẩm">
    <i class="bi bi-box-seam"></i>
    <span class="link-text">Quản lý sản phẩm</span>
  </a>

  <a href="orders.php" class="<?= ($current_page == 'orders.php') ? 'active' : '' ?>" title="Đơn hàng">
    <i class="bi bi-bag"></i>
    <span class="link-text">Quản lý đơn hàng</span>
  </a>

  <a href="contacts.php" class="<?= ($current_page == 'contacts.php') ? 'active' : '' ?>" title="Liên hệ">
    <i class="bi bi-envelope"></i>
    <span class="link-text">Quản lý liên hệ</span>
  </a>

  <a href="ArticleIndex.php" class="<?= ($current_page == 'ArticleIndex.php') ? 'active' : '' ?>" title="Bài viết">
    <i class="bi bi-newspaper"></i>
    <span class="link-text">Quản lý bài báo</span>
  </a>

  <a href="admin_faq.php" class="<?= ($current_page == 'admin_faq.php') ? 'active' : '' ?>" title="FAQ">
    <i class="bi bi-question-lg"></i>
    <span class="link-text">Quản lý FAQ</span>
  </a>

  <a href="admin_questions.php" class="<?= ($current_page == 'admin_questions.php') ? 'active' : '' ?>" title="Câu hỏi">
    <i class="bi bi-chat-dots"></i>
    <span class="link-text">Quản lý câu hỏi</span>
  </a>

  <a href="#" id="btnLogout" class="logout-link" title="Đăng xuất">
    <i class="bi bi-door-closed"></i>
    <span class="link-text">Logout</span>
  </a>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById('sidebarToggle');
    const body = document.body;

    if (localStorage.getItem('sidebar-collapsed') === 'true') {
      body.classList.add('sidebar-collapsed');
    }

    toggleBtn.addEventListener('click', () => {
      body.classList.toggle('sidebar-collapsed');

      const isCollapsed = body.classList.contains('sidebar-collapsed');
      localStorage.setItem('sidebar-collapsed', isCollapsed);
    });

    document.body.addEventListener("click", async (e) => {
      const target = e.target.closest("#btnLogout");
      if (target) {
        e.preventDefault();
        if (!confirm("Bạn có chắc chắn muốn đăng xuất?")) return;
        try {
          const res = await axios.post("../api/Authentication/logout.php");
          if (res.data.success) {
            localStorage.removeItem("user");
            localStorage.removeItem("cart");
            window.location.href = "../public/login.php";
          } else {
            alert("Đăng xuất thất bại!");
          }
        } catch (err) {
          window.location.href = "../public/login.php";
        }
      }
    });
  });
</script>