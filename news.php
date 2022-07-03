<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<body>
    <div>
        <div class="container container-news pt-5 mt-5 d-flex flex-column align-items-center" data-aos="fade-up">
            <h2 class="text-center mb-4">Berita Cuan</h2>
            <!-- Search Bar -->
            <div class="row px-3 w-100 justify-content-center">
                <div class="col-2">
                    <select id="sortNews" class="form-select rounded-pill h-100 montserrat">
                        <option value="1">Terbaru</option>
                        <option value="2">Terlama</option>
                    </select>
                </div>
                <div class="col-10">
                    <section class="input-group montserrat form-control rounded-pill bg-light d-flex align-items-center p-2">
                        <input type="text" class="search-bar montserrat bg-light px-2 fs-7" style="width: 94%;" placeholder="Cari berdasarkan judul" id="inputNews">
                        <span style="width: 6%;" class="d-flex justify-content-center">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                    </section>
                </div>
            </div>
            <!-- Search Bar -->

            <section id="newsList" class="w-100 mb-5 pb-5 mt-2">

            </section>
        </div>
    </div>
</body>
<script src="httprequest/request/getNews.js"></script>

</html>