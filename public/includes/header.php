   <!-- Header start -->
   <header>
     <nav class="bg-black main-nav text-white">
       <div class="container">
         <div
           class="navbar-content d-flex justify-content-between align-items-center">
           <div class="nav-left">
             <a href="./index.php"><img
                 class=""
                 src="./img/c255c800e61e47ec7698ffdc99e50a95.png"
                 alt="" /></a>
           </div>
           <div class="nav-right d-flex gap-3 align-items-center" id="navRight">
             <a href="./cart.php">
               <i class="fa-solid fa-cart-shopping text-white"></i>
             </a>

             <!-- Login / Register (JS sẽ ẩn nếu đã login) -->
             <span id="login"><a href="./login.php" class="text-white">Login</a></span>
             <span id="register"><a href="./register.php" class="text-white">Register</a></span>

             <!-- Avatar khi đã login (ban đầu ẩn) -->
             <div id="userAvatar" class="dropdown" style="display:none;">
               <img
                 src="./img/default-avatar-icon.jpg"
                 class="rounded-circle"
                 width="32"
                 height="32"
                 data-bs-toggle="dropdown"
                 style="cursor:pointer;" />

               <ul class="dropdown-menu">
                 <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                 <li><a class="dropdown-item text-danger" id="btnLogout" style="cursor:pointer;">Logout</a></li>
               </ul>
             </div>
           </div>

         </div>
       </div>
     </nav>
   </header>

   <script src="./assets/js/helpers/handleLogin.js"></script>
   <!-- Header end -->