<?php
global $conn;
?>
<script src="httprequest/request/postUserData.js"></script>
<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-expand-xl fixed-top p-3 shadow-sm">
    <!-- Navbar intinya : Brand, button, konten -->
    <!-- Brand -->
    <a href="./" class="navbar-brand" id="navbar-title">HitungCuan.</a>

    <!-- Tombol dropdown baru keliatan kalo layar kecil -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggleMobileMenu" aria-controls="toggleMobileMenu" aria-expanded="false">
        <!-- data-bs kepanjangannya data-bootstrap -->
        <span><i class="fas fa-list"></i></span>
    </button>

    <!-- Konten navbar -->
    <div class="collapse navbar-collapse" id="toggleMobileMenu">
        <ul class="navbar-nav ms-auto">
            <!-- Masing-masing item navbar -->
            <li class="nav-item px-2 pt-1">
                <a href="?page=simulasinabung" class="nav-link">Cek Kondisi Keuangan</a>
            </li>
            <li class="nav-item px-2 pt-1">
                <a href="?page=news" class="nav-link">Berita Cuan</a>
            </li>
            <li class="nav-item px-2 pt-1">
                <a href="?page=cuancademy" class="nav-link">CuanCademy</a>
            </li>
            <?php if (!isset($_SESSION["user"])) : ?>
                <li class="nav-item" id="nav-item-login">
                    <a href="?page=login" class="nav-link w-100" id="nav-link-login">Log In</a>
                </li>
            <?php endif ?>
            <?php if (isset($_SESSION["user"])) : ?>
                <?php $user = $conn->query("SELECT * FROM users WHERE username='" . $_SESSION["username"] . "'")->fetch_assoc() ?>
                <li class="nav-item px-2 pb-1 pt-1">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex flex-row align-items-center" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="ratio ratio-1x1 d-inline-block mx-2" style="width: 2.1rem;">
                            <img src="assets/images/users-profile/<?= $user['foto'] ?>" alt="navbar-profile-image" class="img-fluid article-img rounded-circle" style="height: 2.1rem; object-fit:cover">
                        </div>
                        <span class="montserrat text-center mx-1 mb-0 d-inline-block" style="<?php if (isPremiumUser($user['id'])) echo 'color: yellow' ?>"><?php echo $user["username"] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownDarkMenuLink">
                        <li><a class="dropdown-item navbar-dropdown-menu montserrat" href="?page=userprofile">Profile</a></li>
                        <li><a class="dropdown-item navbar-dropdown-menu montserrat" href="?page=logout">Log Out</a></li>
                        <!-- Transaksi -->
                        <?php $va = $conn->query("SELECT * FROM virtual_account WHERE id_user = " . $user['id']); ?>
                        <?php if ($va->num_rows === 1) : ?>
                            <?php
                            $va = $va->fetch_assoc();
                            $idPacket = $va['id_packet'];
                            $payment = $va['payment'];
                            ?>
                            <li><a href="<?= "?page=virtualaccount&idpacket=$idPacket&payment=$payment" ?>" class="dropdown-item navbar-dropdown-menu montserrat">
                                    Transaction
                                    <span class="badge rounded-pill bg-danger">Pending</span>
                                </a></li>
                        <?php endif ?>
                    </ul>
                </li>
                </li>
            <?php endif ?>
        </ul>
    </div>
</nav>