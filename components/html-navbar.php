<script src="httprequest/request/getNavbarData.js"></script>
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
            <section id="ajaxNavbar" class="m-0 p-0">

            </section>
        </ul>
    </div>
</nav>