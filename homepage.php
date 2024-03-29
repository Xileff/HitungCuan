<script src="httprequest/request/getHomepageNews.js" type="module"></script>

<body>
    <div id="index-container" data-aos="fade-up">
        <div class="container mb-5">
            <div class="row" id="index-headline">
                <div class="col-sm-6 col-md-6 col-lg-6 col1">
                    <img src="assets/images/index/index-1-square.jpg" alt="index-headline" class="img-fluid">
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col2">
                    <h1>HitungCuan.</h1>
                    <div class="d-flex flex-column">
                        <h3 class="text-center">Belajar Cara Mengatur Uang dengan Efektif dan Efisien</h3>
                        <button class="w-75 mx-auto p-3 mt-4 mb-3 index-headline-button fs-6" id="btnMembership" onclick="window.location.href='#h2Membership'">Membership</button>
                        <button class="w-75 mx-auto p-3 index-headline-button fs-6" id="btnFinancialCheckUp" onclick="window.location.href='?page=simulasinabung'">Cek Kondisi Keuangan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Berita Cuan -->
    <div class="container container-news pt-5 mb-5 d-flex flex-column align-items-center">
        <h2 class="text-center mb-4">Berita Terbaru</h2>
        <section id="homepageNewsContainer" class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-news">
            <!-- Ajax -->
        </section>
        <a href="?page=news" style="text-decoration: none; color: white;">
            <p class="text-center general-link fs-6 hvr-underline-from-left">See more</p>
        </a>
    </div>

    <!-- Target Belajar Ngatur Duit -->
    <div class="container pt-5 pb-5 mb-5">
        <h2 class="text-center">Belajar Ngatur Duit</h2>
        <div class="row mt-5">
            <div class="col-sm-6 col-md-6 col-lg-6 d-flex flex-column">
                <img src="assets/images/index/dart-target.jpg" alt="target" class="img-fluid w-75 mx-auto" style="border-radius: 100%;">
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 d-flex flex-column justify-content-center">
                <ul id="index-ul" class="list-unstyled">
                    <li>
                        <h5 class="montserrat"><i class="fas fa-check-circle index-check-circle mx-2"></i> Delay of Gratification</h5>
                    </li>
                    <li>
                        <h5 class="montserrat"><i class="fas fa-check-circle index-check-circle mx-2"></i> Atur income dan expense</h5>
                    </li>
                    <li>
                        <h5 class="montserrat"><i class="fas fa-check-circle index-check-circle mx-2"></i> Investasi</h5>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Membership -->
    <div class="container pt-5 mb-5">
        <h2 id="h2Membership" class="text-center mb-3">Membership</h2>

        <div class="row d-flex flex-row justify-content-around row-cols-1 row-cols-sm-1 row-cols-md-3">
            <a class="col p-2 mx-auto hvr-float text-decoration-none" href="?page=subscribe&packetId=1">
                <div class="card p-0 card-packets" id="packet1">
                    <h3 class="text-center fs-2 italic">PALING CUAN!</h3>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="card-title pt-3 pb-3">
                            <h5 class="text-center fs-4 fw-bold" style="color: rgb(117, 249, 145);">12 Bulan</h5>
                        </div>
                        <div class="card-text">
                            <p class="fs-5 poppins text-center">Rp100.000 / bulan</p>
                            <p class="text-center fw-bold pt-2 mb-0">Hemat hingga</p>
                            <p class="text-center fw-bold fs-2" style="color: rgb(117, 249, 145);">Rp600.000</p>
                            <p class="montserrat text-center p-0 mt-0 " style="font-size: 0.75rem;">*Pembayaran langsung 12 bulan</p>
                        </div>
                        <button class="btnPaket p-2 montserrat fw-bold hvr-skew">Beli Membership</button>
                    </div>
                </div>
            </a>
            <a class="col p-2 mx-auto hvr-float text-decoration-none" href="?page=subscribe&packetId=2">
                <div class="card card-packets p-0">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="card-title pt-3 pb-3">
                            <h5 class="text-center fs-4 fw-bold" style="color: rgb(117, 249, 145);">6 Bulan</h5>
                        </div>
                        <div class="card-text">
                            <p class="fs-5 poppins text-center">Rp120.000 / bulan</p>
                            <p class="text-center fw-bold pt-2 mb-0">Hemat hingga</p>
                            <p class="text-center fw-bold fs-3" style="color: rgb(117, 249, 145);">Rp180.000</p>
                            <p class="montserrat text-center p-0 mt-0 " style="font-size: 0.75rem;">*Pembayaran langsung 6 bulan</p>
                        </div>
                        <button class="btnPaket p-2 montserrat fw-bold hvr-skew">Beli Membership</button>
                    </div>
                </div>
            </a>
            <a class="col p-2 mx-auto hvr-float text-decoration-none" href="?page=subscribe&packetId=3">
                <div class="card card-packets p-0">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="card-title pt-3 pb-3">
                            <h5 class="text-center fs-4 fw-bold" style="color: rgb(117, 249, 145);">3 Bulan</h5>
                        </div>
                        <div class="card-text">
                            <p class="fs-5 poppins text-center">Rp150.000 / bulan</p>
                            <p class="montserrat text-center p-0 mt-0 " style="font-size: 0.75rem;">*Pembayaran langsung 3 bulan</p>
                        </div>
                        <button class="btnPaket p-2 montserrat fw-bold hvr-skew">Beli Membership</button>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Quotes -->
    <div class="container-fluid mb-5" style="background-color: rgb(41, 43, 46);margin-top: 5rem;">
        <div class="container">
            <div class="row d-flex flex-row align-items-center">
                <div class="col-sm-6 col-md-auto col-lg-6 pt-3" style="padding-right: 3rem;">
                    <p class="montserrat fs-3">"If you don't learn how to make money while you sleep, you will work forever."</p>
                    <p class="montserrat fs-2 fw-bold" style="color: rgb(117, 249, 145);">- Warren Buffet</p>
                </div>
                <div class="col-sm-6 col-md-auto col-lg-6">
                    <img src="assets/images/index/warrenbuffet.png" alt="warrenbuffet" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews -->
    <div class="container pt-5" style="margin-top: 5rem;">
        <h2 class="text-center">Kata Mereka</h2>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3">
            <div class="col p-4">
                <div class="card card-review h-100" style="border-radius: 0.8rem;">
                    <img src="assets/images/index/review1.jpg" alt="person" class="card-img-top img-fluid" style="border-top-left-radius: 0.8rem; border-top-right-radius: 0.8rem;">
                    <div class="card-body">
                        <h5 class="card-title">Kevin</h5>
                        <p class="card-text index-review">Materinya sangat bagus dan terstruktur dengan rapi, sehingga mudah dimengerti oleh pemula</p>
                    </div>
                </div>
            </div>
            <div class="col p-4">
                <div class="card card-review h-100" style="border-radius: 0.8rem;">
                    <img src="assets/images/index/review2.jpg" alt="person" class="card-img-top img-fluid" style="border-top-left-radius: 0.8rem; border-top-right-radius: 0.8rem;">
                    <div class="card-body">
                        <h5 class="card-title">Cindy</h5>
                        <p class="card-text index-review">Terima kasih untuk bimbingan dan materinya, saya jadi bisa lebih efisien dalam pengelolaan uang.</p>
                    </div>
                </div>
            </div>
            <div class="col p-4">
                <div class="card card-review h-100" style="border-radius: 0.8rem;">
                    <img src="assets/images/index/review3.jpg" alt="person" class="card-img-top img-fluid" style="border-top-left-radius: 0.8rem; border-top-right-radius: 0.8rem;">
                    <div class="card-body">
                        <h5 class="card-title">Renard</h5>
                        <p class="card-text index-review">Saya belajar banyak dari sini. Semoga website ini bisa terus maju dan memberikan fitur-fitur baru bagi usersnya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>