<body>
    <?php include 'pages/components/html-navbar.php'?>
    <div class="container mt-5 pt-5">
        <h1 class="poppins text-center mb-5">Dev Profile</h1>
        <div class="row mb-5">
            <div class="col-sm-6 col-md-6 col-lg-6 p-4 d-flex justify-content-center">
                <img src="images/aboutus/dark_strange.jpg" alt="dev_picture" style="max-width: 100%; max-height: 350px; border-radius: 5%;">
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 pt-4 montserrat developer-text">
                <p>
                    Perkenalkan nama saya Felix Savero, saya merupakan mahasiswa Informatika dari Universitas Kristen Krida Wacana dengan NIM 412020015. Saya membuat website ini untuk membantu teman saya mengatur arus kasnya.
                </p>
                <p>
                    Pada kesempatan ini juga, saya belajar banyak hal dalam pengembangan website terutama cara mengimplementasi library javascript pada website yang telah saya buat.
                </p>
                <p>
                    Contohnya bisa dilihat pada bagian home page, saya menggunakan lib Javascript AOS (Animate On Scroll) untuk menganimasikan konten.
                </p>
            </div>
        </div>

        <h2 class="text-center mb-0">Tools</h2>
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 px-2 mb-5">
            <div class="col px-5 pt-4 mx-auto d-flex justify-content-center">
                <img src="images/aboutus/256px/html5.png" alt="HTML5" class="img-fluid">
            </div>
            <div class="col px-5 pt-4 mx-auto d-flex justify-content-center">
                <img src="images/aboutus/256px/css3.png" alt="CSS3" class="img-fluid">
            </div>
            <div class="col px-5 pt-4 mx-auto d-flex justify-content-center">
                <img src="images/aboutus/256px/javascript.png" alt="JavaScript" class="img-fluid">
            </div>
            <div class="col px-5 pt-4 mx-auto d-flex justify-content-center">
                <img src="images/aboutus/256px/php (2).png" alt="PHP" class="img-fluid">
            </div>
            <div class="col px-5 pt-4 mx-auto d-flex justify-content-center">
                <img src="images/aboutus/256px/sql.png" alt="XAMPP" class="img-fluid">
            </div>
        </div>

        <h2 class="text-center">Feedback</h2>
        <form action="" method="POST">
            <div class="form-group p-3 montserrat d-flex flex-column justify-content-center">

                <textarea 
                class="form-control" 
                id="txtFeedback" 
                name="teksFeedback"
                cols="30" 
                rows="4"></textarea>

                <button 
                type="submit"
                name="submit"
                class="w-100 mx-auto mt-4 p-2" 
                id="btnFeedback">Submit</button>
            </div>
        </form>
    </div>
</body>