<?php 
if(!isset($_SESSION['admin'])){
    header("Location: index.php");
}
?>

<body>
    <nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-expand-xl fixed-top p-3 shadow-sm">
        <!-- Navbar intinya : Brand, button, konten -->
        <!-- Brand -->
        <a href="#" class="navbar-brand" id="navbar-title">Administrator</a>

        <!-- Tombol dropdown baru keliatan kalo layar kecil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggleMobileMenu" aria-controls="toggleMobileMenu" aria-expanded="false">
        <!-- data-bs kepanjangannya data-bootstrap -->
        <span><i class="fas fa-list"></i></span></button>

        <!-- Konten navbar -->
        <div class="collapse navbar-collapse" id="toggleMobileMenu">
            <ul class="navbar-nav ms-auto">
                <!-- Masing-masing item navbar -->
                <li class="nav-item px-2 pt-1">
                    <a href="#" class="nav-link">Users</a>
                </li>
                <li class="nav-item px-2 pt-1">
                    <a href="#" class="nav-link">Feedback</a>
                </li>
                <li class="nav-item px-2 pt-1">
                    <a href="#" class="nav-link">Materi</a>
                </li>
                <li class="nav-item px-2 pt-1">
                    <a href="#" class="nav-link">Berita</a>
                </li>
                <?php if(!isset($_SESSION["login"])):?>
                <li class="nav-item" id="nav-item-login">
                    <a href="index.php?page=login" target="_blank" class="nav-link w-100" id="nav-link-login">Masuk</a>
                </li>
                <?php endif?>
                <?php if(isset($_SESSION["login"]) && isset($_SESSION["admin"])):?>
                <li class="nav-item px-2 pb-1 pt-1 mx-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../images/users-profile/childe.png" alt="" class="img-fluid article-img rounded-circle" style="height: 2.1rem;">
                            <span class="montserrat text-center mx-1"><?php echo $_SESSION["username"]?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownDarkMenuLink">
                            <li><a class="dropdown-item navbar-dropdown-menu montserrat" href="logout.php">Log Out</a></li>
                        </ul>
                    </li>
                </li>
                <?php endif?>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
    <table class="table table-hover table-dark table-admin">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td>Larry the Bird</td>
            <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsa ad inventore itaque vero eveniet pariatur molestiae quia, sint repellendus molestias dolore voluptatum, ex, ab quisquam nam provident quibusdam obcaecati placeat?</td>
            <td>
                <a href="">Update</a>
                <a href="">Delete</a>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
</body>