<body id="login-body">
    <div id="overlay"></div>
    <?php include 'pages/components/html-simplenavbar.php'?>

    <div id="login-container" class="container-fluid mb-5 mt-5 pt-5">
        <div class="row h-100">
            <div class="col-sm-6 col-md-6 col-lg-6 d-flex flex-column justify-content-center mx-auto" style="z-index: 3;">

                <div class="login-box mx-auto pt-4 pb-4 px-2 mt-5" style="width: 100%; max-width: 500px;">

                    <h1 style="color: black;" class="montserrat fw-bold text-center">Hello there.</h1>
                    <hr style="color: black;">

                    <form class="pt-1 pb-3 d-flex flex-column justify-content-center" style="color: black;" action="" method="POST">
                        <h3 class="montserrat text-center">Pendaftaran Akun Baru</h3>

                        <input 
                        class="form-control montserrat w-75 mt-3 mb-2 mx-auto" 
                        id="loginTxtUser" 
                        placeholder="Nama Lengkap" 
                        name="nama"
                        autocomplete="off"
                        ></input>

                        <input 
                        class="form-control montserrat w-75 mt-3 mb-2 mx-auto" 
                        id="loginTxtUser" 
                        placeholder="Username" 
                        name="username"
                        pattern="[a-z]{1,51}[0-9]{0,51}"
                        title="Username dimulai dengan huruf kecil, kemudian boleh diikuti dengan angka atau tidak diikuti angka."
                        autocomplete="off"
                        ></input>

                        <input 
                        class="form-control montserrat w-75 mt-3 mb-2 mx-auto" 
                        id="loginTxtUser" 
                        placeholder="Email" 
                        name="email" 
                        type="email"
                        pattern="[a-zA-Z0-9_\-\.]+[\.]{0,2}[a-zA-Z0-9_\-\.]{0,100}[@][a-z]+[\.][a-z]{2,}[\.]{0,2}[a-z]{0,100}[\.]{0,2}[a-z]{0,100}[\.]{0,2}[a-z]{0,100}[\.]{0,2}"
                        title="Masukkan format email yang benar.\nContoh : felix12@gmail.com"
                        autocomplete="off"
                        ></input>
                        <!-- pattern="[a-zA-Z0-9_\-\.]*[@][a-z]+[\.][a-z]{2,3}" -->
                        
                        <input 
                        type="password" 
                        class="form-control montserrat w-75 mx-auto mt-3 mb-2" 
                        id="loginTxtPassword" 
                        placeholder="Password 8 hingga 16 karakter" 
                        name="password" 
                        pattern="[A-Za-z\d\!\?\.\^\&]{8,17}"
                        title="Password boleh menggunakan huruf, angka, dan karakter seperti !?.%^&*"
                        autocomplete="off"
                        ></input>
                        
                        <input 
                        type="password" 
                        class="form-control montserrat w-75 mx-auto mt-3 mb-4" 
                        id="loginTxtPassword" 
                        placeholder="Konfirmasi Password" 
                        name="konfirmasi-password" 
                        pattern="[A-Za-z\d\!\?\.\^\&]{8,17}"
                        title="Password boleh menggunakan huruf, angka, dan karakter seperti !?.%^&*"
                        autocomplete="off"
                        ></input>
                        
                        <button 
                        id="btnLogin" 
                        type="submit" 
                        name="register" 
                        class="w-75 bg-dark align-center mt-3 p-2 mx-auto montserrat">Buat Akun</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</body>