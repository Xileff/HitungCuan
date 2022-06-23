<?php
if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
    header("Location: ./");
}
?>

<body id="login-body" style="z-index: 1;">
    <?php include 'components/html-simplenavbar.php' ?>
    <div id="overlay"></div>
    <div id="login-container" class="container-fluid mb-5 mt-5 pt-5">
        <div class="row h-100">
            <div class="col-sm-6 col-md-6 col-lg-6 d-flex flex-column justify-content-center mx-auto" style="z-index: 3;">
                <div class="login-box mx-auto pt-4 pb-4 px-2 mt-5" style="width: 100%; max-width: 500px;">
                    <h1 style="color: black;" class="montserrat fw-bold text-center">Welcome Back</h1>
                    <hr style="color: black;">
                    <form class="pt-1 pb-3 d-flex flex-column justify-content-center" style="color: black;" action="" method="POST" id="formLogin">
                        <h3 class="montserrat text-center">Log in to your account.</h3>
                        <input class="form-control montserrat w-75 mt-4 mb-2 mx-auto" id="loginTxtUser" placeholder="Username" name="username" pattern="[a-z]{1,51}[0-9]{0,51}" title="Username dimulai dengan huruf kecil, kemudian boleh diikuti dengan angka atau tidak diikuti angka." autocomplete="off" />
                        <input type="password" class="form-control montserrat w-75 mx-auto mt-3 mb-4" id="loginTxtPassword" placeholder="Password" name="password" pattern="[A-Za-z\d\!\?\.\^\&]{8,17}" title="Masukkan format password yang benar" autocomplete="off" />
                        <div class="w-75 mt-1 mb-3 mx-auto d-flex flex-row justify-content-around">
                            <a href="?page=register" class="align-start montserrat login-links">Register Account</a>
                        </div>
                        <div class="w-75 mt-3 mb-1 mx-auto d-flex flex-row justify-content-center">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="rememberme">
                            <p class="mx-1">Remember Me</p>
                        </div>
                        <button id="btnLogin" class="w-75 bg-dark align-center mt-0 p-2 mx-auto montserrat" type="submit" name="submit">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const loginTxtUser = document.getElementById('loginTxtUser');
    const loginTxtPassword = document.getElementById('loginTxtPassword');
    const btnLogin = document.getElementById('btnLogin');

    btnLogin.addEventListener('click', e => {
        if (loginTxtUser.value.length === 0 || loginTxtPassword.value.length === 0) {
            alertError('Error', 'Username atau password tidak boleh kosong', 'Ok');
            e.preventDefault();
        }
    });
</script>
<script src="httprequest/request/postLogin.js"></script>