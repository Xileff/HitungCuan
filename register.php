<script src="httprequest/request/postRegister.js" type="module"></script>

<body id="login-body">
    <div id="overlay"></div>
    <?php include 'components/html-simplenavbar.php' ?>

    <div id="login-container" class="container-fluid mb-5 mt-5 pt-5">
        <div class="row h-100">
            <div class="col-sm-6 col-md-6 col-lg-6 d-flex flex-column justify-content-center mx-auto" style="z-index: 3;">
                <div class="login-box mx-auto pt-4 pb-4 px-2 mt-5" style="width: 100%; max-width: 500px;">
                    <h1 style="color: black;" class="montserrat fw-bold text-center">Hello there.</h1>
                    <hr style="color: black;">
                    <form class="pt-1 pb-3 d-flex flex-column justify-content-center" style="color: black;" action="" method="POST" id="formRegister">
                        <h3 class="montserrat text-center">Pendaftaran Akun Baru</h3>
                        <input class="form-control montserrat w-75 mt-3 mb-2 mx-auto" id="loginTxtNama" placeholder="Nama Lengkap" name="nama" autocomplete="off" />
                        <p id="txtUsedUsername" class="smoothTransition invisible faderight noheight mt-3 mb-0 mx-auto w-75 text-danger"></p>
                        <input class="form-control montserrat w-75 mt-0 mb-2 mx-auto" id="loginTxtUser" placeholder="Username(min: 8)" name="username" pattern="[a-z]{1,51}[0-9]{0,51}" title="Username hanya boleh mengandung huruf nonkapital, tidak boleh mengandung spasi, dan boleh memiliki angka" autocomplete="off" />

                        <p id="txtUsedEmail" class="smoothTransition invisible faderight noheight mt-3 mb-0 mx-auto w-75 text-danger"></p>
                        <input class="form-control montserrat w-75 mb-2 mx-auto" id="loginTxtEmail" placeholder="Email" name="email" type="email" pattern="[a-zA-Z0-9_\-\.]+[\.]{0,2}[a-zA-Z0-9_\-\.]{0,100}[@][a-z]+[\.][a-z]{2,}[\.]{0,2}[a-z]{0,100}[\.]{0,2}[a-z]{0,100}[\.]{0,2}[a-z]{0,100}[\.]{0,2}" title="Masukkan format email yang benar.\nContoh : felix12@gmail.com" autocomplete="off" />
                        <input type="password" class="form-control montserrat w-75 mx-auto mt-3 mb-2" id="loginTxtPassword" placeholder="Password 8 hingga 16 karakter" name="password" pattern="[A-Za-z\d\!\?\.\^\&]{8,17}" title="Password boleh menggunakan huruf, angka, dan karakter seperti !?.%^&*" autocomplete="off" />
                        <input type="password" class="form-control montserrat w-75 mx-auto mt-3 mb-4" id="loginTxtConfirmPassword" placeholder="Konfirmasi Password" name="confirmPassword" pattern="[A-Za-z\d\!\?\.\^\&]{8,17}" title="Password boleh menggunakan huruf, angka, dan karakter seperti !?.%^&*" autocomplete="off" />
                        <button id="btnLogin" type="submit" name="register" class="w-75 bg-dark align-center mt-3 p-2 mx-auto montserrat">Buat Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const txtUsedUsername = document.getElementById('txtUsedUsername')
    const txtUsedEmail = document.getElementById('txtUsedEmail')
    const loginTxtUser = document.getElementById('loginTxtUser')
    const loginTxtEmail = document.getElementById('loginTxtEmail')

    loginTxtUser.addEventListener('keyup', function() {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                const classes = ['invisible', 'noheight', 'faderight'];
                classes.forEach(c => {
                    if (xhr.responseText.length !== 2) {
                        if (txtUsedUsername.classList.contains(c)) txtUsedUsername.classList.remove(c)
                    } else {
                        if (!txtUsedUsername.classList.contains(c)) txtUsedUsername.classList.add(c)
                    }
                });
                txtUsedUsername.innerHTML = xhr.responseText;
            }
        }

        xhr.open("GET", `logic/ajax/registerusername.php?username=${loginTxtUser.value}`, true);
        xhr.send();
    })

    loginTxtEmail.addEventListener('keyup', function() {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                const classes = ['invisible', 'noheight', 'faderight'];
                classes.forEach(c => {
                    if (xhr.responseText.length !== 2) {
                        if (txtUsedEmail.classList.contains(c)) txtUsedEmail.classList.remove(c)
                    } else {
                        if (!txtUsedEmail.classList.contains(c)) txtUsedEmail.classList.add(c)
                    }
                });
                txtUsedEmail.innerHTML = xhr.responseText;
            }
        }

        xhr.open("GET", `./logic/ajax/registeremail.php?email=${loginTxtEmail.value}`, true);
        xhr.send();
    })
</script>