<script>
    $.ajax({
        type: 'POST',
        url: 'httprequest/response/checkAccount.php',
        dataType: 'JSON',
        success: function(response) {
            const code = response.code
            switch (code) {
                case 0:
                    $('#footer').hide()
                    $('#inputCalculator').html(`<h1 class="p-5">Belum login<h1>`)
                    errorRedirect('Oops', 'Anda harus login terlebih dahulu', 'Ok', '?page=login', )
                    break
                case 1:
                    $('#footer').hide()
                    $('#inputCalculator').html(`<h1 class="p-5">Hanya untuk user premium<h1>`)
                    errorRedirect('Oops', 'Fitur ini hanya tersedia untuk akun premium', 'Ok', '?page=homepage')
                    break
            }
        }
    })
</script>

<body>
    <div id="inputCalculator" class="container mt-5 pt-5 px-5" data-aos="fade-up">
        <div class="row d-flex flex-row justify-content-center">
            <form class="col-sm-4 col-md-4 col-lg-4 w-100 p-2 d-flex flex-column justify-content-center" action="" method="" style="font-weight: bold;">
                <h1 class="poppins text-center p-4">Dalam 30 hari...</h1>
                <br>

                <h3 class="pt-2 montserrat">Berapa penghasilanmu?</h3>
                <input id="inputPenghasilan" class="form-control montserrat w-100 mt-3 mb-5 mx-auto" placeholder="Isi hanya dengan angka, misalnya 3,000,000" type="text"></input>

                <h3 class="pt-2 montserrat">Berapa biaya tanggunganmu? (Kosongkan jika tidak ada)</h3>
                <input id="inputTanggungan" class="form-control montserrat w-100 mt-1 mx-auto" placeholder="Isi hanya dengan angka, misalnya 3,000,000" type="text"></input>
                <p class="fs-6 montserrat pt-2 pb-2 mb-3 text-secondary">Total biaya tanggungan adalah total uang yang kamu keluarkan untuk kebutuhan orang lain, biasanya keluarga. Misalnya, membayar uang sekolah adik, membayar uang sewa tempat tinggal keluarga, dan lain sebagainya.</p>

                <h3 class="pt-2 montserrat">Pengeluaran Kebutuhan</h3>
                <input id="inputKebutuhan" class="form-control montserrat w-100 mt-1 mx-auto" placeholder="Isi hanya dengan angka, misalnya 3,000,000" type="text"></input>
                <p class="fs-6 montserrat pt-2 pb-2 mb-3 text-secondary">Misalnya untuk makan, minum, isi bensin, dan lain sebagainya.</p>

                <h3 class="pt-2 montserrat">Pengeluaran Keinginan</h3>
                <input id="inputKeinginan" class="form-control montserrat w-100 mt-1 mx-auto" placeholder="Isi hanya dengan angka, misalnya 3,000,000" type="text"></input>
                <p class="fs-6 montserrat pt-2 pb-2 mb-3 text-secondary">Misalnya jajan di coffeeshop, makan di restoran/outlet bermerk, membeli gadget atau aksesorisnya, jalan-jalan healing, dan lain sebagainya</p>

                <h3 class="pt-2 montserrat">Cicilan Utang(Kosongkan jika tidak ada)</h3>
                <input id="inputCicilan" class="form-control montserrat w-100 mt-1 mb-5 mx-auto" placeholder="Isi hanya dengan angka, misalnya 3,000,000" type="text"></input>

                <h3 class="pt-2 montserrat">Pengeluaran rutin lainnya</h3>
                <input id="inputPengeluaranLainnya" class="form-control montserrat w-100 mt-1 mx-auto" placeholder="Isi hanya dengan angka, misalnya 3,000,000" type="text"></input>
                <p class="fs-6 montserrat pt-2 pb-2 mb-3 text-secondary">Misalnya, kamu setiap 2 bulan sekali harus pergi ke dokter gigi, maka total biaya selama 2 bulan itu kamu bagi 2 untuk dimasukkan di sini. Jika 3 bulan sekali ada perawatan diri, maka biayanya dibagi 3 lalu dimasukkan di sini.</p>

                <h3 class="pt-2 montserrat">Tabungan per bulan</h3>
                <input id="inputTabungan" class="form-control montserrat w-100 mt-1 mx-auto" placeholder="Isi hanya dengan angka, misalnya 3.000.000" type="text"></input>
                <p class="fs-6 montserrat pt-2 pb-2 mb-3 text-secondary">Uang yang kamu sisihkan</p>

                <br>
                <br>
                <button id="btnCountNabung" class="w-75 mx-auto p-3 poppins fs-5 mb-5" type="button" data-toggle="modal" data-target="#exampleModal">Hitung Tabungan</button>
            </form>

            <!-- Modal -->
            <div class="container-fluid" id="containerHasil">
                <div id="containerHasil-content" class="position-fixed p-5">
                    <span id="closeHasil" class="poppins fw-bold fs-3 position-absolute top-0 end-0 px-3 pt-2">&times;</span>
                    <h1 id="containerHasilH1" class="text-center poppins fw-bold">Hasil Kalkulasi</h1>
                    <div class="row pt-2 pb-2 px-1">
                        <div class="col-sm-6 col-md-6 col-lg-6 d-flex flex-column justify-content-center">
                            <img src="../images/nabung/sultan.png" alt="sultan" class="img-fluid w-50 mx-auto" id="imgHasil">
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 d-flex align-items-center" id="containerTxtHasil">
                            <h2 id="h2JudulHasil" class="poppins fw-bold text-center align-center mx-auto">Selamat! Kamu adalah Sultan!</h2>
                        </div>
                    </div>
                    <h3 id="judulHasil" class="text-center poppins mt-5">Dari Rp5.000.000</h3>
                    <div class="p-3 text-center fw-bold fs-4 poppins">
                        <p>Kamu Menabung <span id="spanMenabung" class="fs-2">50%</span></p>
                        <p>dan</p>
                        <p>Kamu Menghabiskan <span id="spanPengeluaran" class="fs-2">50%</span></p>
                    </div>

                    <div class="px-2">
                        <h3 class="montserrat">Insights</h3>
                        <ol id="olInsights" class="list-group-numbered montserrat p-0 fs-4">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Modal -->
        </div>
    </div>

    <?php include 'components/html-top.php' ?>

    <!-- Other scripts -->
    <script src="assets/js/autoNumeric.min.js"></script>
    <script src="assets/js/simulasinabung.js"></script>
</body>