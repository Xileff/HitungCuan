<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-expand-xl fixed-top p-3 shadow-sm">
    <!-- Navbar intinya : Brand, button, konten -->
    <!-- Brand -->
    <a href="?page=news&action=none" class="navbar-brand" id="navbar-title">Administrator</a>

    <!-- Tombol dropdown baru keliatan kalo layar kecil -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggleMobileMenu" aria-controls="toggleMobileMenu" aria-expanded="false">
        <!-- data-bs kepanjangannya data-bootstrap -->
        <span><i class="fas fa-list"></i></span>
    </button>

    <!-- Konten navbar -->
    <div class="collapse navbar-collapse" id="toggleMobileMenu">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item px-2 pt-1">
                <a href="?page=feedback" class="nav-link">Feedback</a>
            </li>
            <li class="nav-item px-2 pt-1">
                <a href="?page=lessons" class="nav-link">Lessons</a>
            </li>
            <li class="nav-item px-2 pt-1">
                <a href="?page=questions" class="nav-link">Questions</a>
            </li>
            <li class="nav-item px-2 pt-1">
                <a href="?page=news" class="nav-link">News</a>
            </li>
            <li class="nav-item px-2 pt-1">
                <a href="?page=revenue" class="nav-link">Revenue</a>
            </li>
            <?php if (isset($_SESSION["admin"])) : ?>
                <li class="nav-item px-2 pb-1 pt-1 mx-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../images/users-profile/childe.png" alt="" class="img-fluid article-img rounded-circle" style="height: 2.1rem;">
                        <span class="montserrat text-center mx-1">Admin : <?php echo $_SESSION["admin_username"] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownDarkMenuLink">
                        <li><a class="dropdown-item navbar-dropdown-menu montserrat" href="?page=logout">Log Out</a></li>
                    </ul>
                </li>
                </li>
            <?php endif ?>
        </ul>
    </div>
</nav>