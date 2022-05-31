<?php 
global $conn;
$username = $_SESSION['username'];
$user = $conn->query("SELECT * FROM users WHERE username = '$username'")->fetch_assoc();
?>
<body>
    <div class="container mt-5 pt-5 d-flex flex-column justify-content-center">
        <h1 class="poppins text-center mt-5 mb-5">User's Profile</h1>
        <form class="row" action="" method="POST" enctype="multipart/form-data">
            <div class="col-sm-4 col-md-4 col-lg-4 p-5 d-flex flex-column justify-items-center">
                <div class="ratio ratio-1x1 p-5">
                    <img src="assets/images/users-profile/<?=$user['foto']?>" alt="user_profile" class="w-100" style="border-radius: 50%; object-fit: cover" id="imgInput" />
                    <input type="file" name="image" id="inputFile" style="opacity: 0; height: 0; width: 0;">
                </div>
                <p style="width: fit-content; color: rgb(117, 249, 145);" class="montserrat text-center hvr-underline-from-left mx-auto">Pencet gambar untuk mengubahnya</p>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
                <div class="d-flex flex-column justify-content-center">
                    <label for="nama" class="montserrat fs-4 w-100 mb-0 mx-auto">Nama lengkap</label>
                    <input
                        class="form-control montserrat fs-4 w-100 mt-2 mb-4 mx-auto" 
                        id="nama" 
                        placeholder="Nama Lengkap" 
                        name="nama"
                        autocomplete="off"
                        value=""
                        ></input>

                    <label for="username" class="montserrat fs-4 w-100 mb-0 mx-auto">Username</label>
                    <input 
                    class="form-control montserrat fs-4 w-100 mt-2 mb-4 mx-auto" 
                    id="username" 
                    placeholder="Username" 
                    name="username"
                    pattern="[a-z]{1,51}[0-9]{0,51}"
                    title="Username dimulai dengan huruf kecil, kemudian boleh diikuti dengan angka atau tidak diikuti angka."
                    autocomplete="off"
                    value=""
                    ></input>

                    <label for="email" class="montserrat fs-4 w-100 mb-0 mx-auto">Email</label>
                    <input 
                    class="form-control montserrat fs-4 w-100 mt-2 mb-4 mx-auto" 
                    id="email" 
                    placeholder="Email" 
                    name="email" 
                    type="email"
                    pattern="[a-zA-Z0-9_\-\.]+[\.]{0,2}[a-zA-Z0-9_\-\.]{0,100}[@][a-z]+[\.][a-z]{2,}[\.]{0,2}[a-z]{0,100}[\.]{0,2}[a-z]{0,100}[\.]{0,2}[a-z]{0,100}[\.]{0,2}"
                    title="Masukkan format email yang benar.\nContoh : felix12@gmail.com"
                    autocomplete="off"
                    value=""
                    ></input>

                    <label for="rbLaki" class="montserrat fs-4 w-100 mb-2 mx-auto">Jenis Kelamin</label>
                    <div class="mb-4">
                        <div class="form-check montserrat fs-5">
                            <input class="form-check-input" type="radio" name="radioGender" id="rbLaki" value="Laki-laki" checked="true">
                            <label class="form-check-label" for="rbLaki">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check montserrat fs-5">
                            <input class="form-check-input" type="radio" name="radioGender" id="rbPerempuan" value="Perempuan">
                            <label class="form-check-label" for="rbPerempuan">
                                Perempuan
                            </label>
                        </div>
                    </div>

                    <label for="tanggalLahir" class="montserrat fs-4 w-100 mb-0 mx-auto">Tanggal Lahir</label>
                    <input type="date" id="tanggalLahir" name="tanggalLahir" class="rounded-5 mb-4" value="<?php echo $user["tgl_lahir"]?>">

                    <a href="#" class="text-center montserrat" style="text-decoration: none; "><p class="hvr-underline-from-left" style="color: rgb(117, 249, 145) !important;">Ganti Password</p></a>
                    <button 
                    type="submit" 
                    name="savechanges" 
                    style="border:none; border-radius: 30px; background-color: rgb(117, 249, 145); "
                    class="montserrat fs-3 primary-button w-100 p-2 mt-3 mb-5 mx-auto">Simpan</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        const imgInput = document.getElementById('imgInput');
        const inputFile = document.getElementById('inputFile');
        
        imgInput.addEventListener('click', () => {
            inputFile.click();
        });

        inputFile.addEventListener('change', (evt) => {
            const img = evt.target.files[0];
            if(!img) {
                alertError('Error', 'Gambar gagal diupload. silakan coba lagi', 'Ok');
                return;
            }

            const reader = new FileReader();
            reader.onload = (evt) => imgInput.setAttribute('src', evt.target.result);
            reader.readAsDataURL(img);
        });
    </script>
</body>
</html>

<!-- https://www.youtube.com/watch?v=maW4kzHrdKQ&list=PLFIM0718LjIUqXfmEIBE3-uzERZPh3vp6&index=19 -->