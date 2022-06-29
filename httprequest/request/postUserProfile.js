import { checkLoginStatus, getUserData } from './mixins.js'

$(document).ready(function(){
    checkLoginStatus().then(response => {
        // jika belum login, lempar ke halaman login
        if(response.code == 0){
            $('body').html('')
            errorRedirect('Error', 'Anda belum login', 'Ok', '?page=login')
        }

        // data yg sudah ada
        loadData()

        // hanya panggil script php jika ada perubahan di input 
        let changed = false
        $('input').on("change", () => {
            changed = true
        })
        $('button[type=submit]').click(function(e){
            e.preventDefault()
            if(!changed){
                alertError('No changes', 'Tidak ada perubahan yang disimpan', 'Ok')
                return
            }

            // Validasi input
            if($('input#nama').val().length < 1 ){
                alertError('Error', 'Nama tidak boleh kosong', 'Ok')
                return
            }

            if(!$('input#nama').val().match(/^[a-z ]+$/i)){
                alertError('Error', 'Format nama tidak benar', 'Ok')
                return
            }

            // Ajax
            const formUpdateProfile = new FormData(document.getElementById('formUpdateProfile'))
            const formImage = $('img#imgInput')[0].files
            if(formImage !== undefined){
                formImage.append('foto', formImage)
            }

            $.ajax({
                type: 'POST',
                url: 'httprequest/response/postUpdateUserProfile.php',
                data: formUpdateProfile,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response){
                    console.log(response)
                    if(response.success){
                        alertSuccess('Berhasil', 'Data anda telah terupdate', 'Ok')
                        loadData()
                    }
                    else {
                        alertError('Kesalahan server', 'Silakan coba lagi setelah beberapa saat', 'Ok')
                    }
                }
            })
        })

        function loadData(){
            getUserData().then(response => {
                $('img#imgInput').attr('src', `assets/images/users-profile/${response.foto}`)
                $('input#nama').val(response.nama)
                $('input#email').val(response.email)
                $('input#username').val(response.username)
                $('input#email').val(response.email)
                $('input#tanggalLahir').val(response.tgl_lahir)
                switch(response.jenis_kelamin){
                    case "Laki-laki":
                        rbLaki.click()
                        break
                    case "Perempuan":
                        rbPerempuan.click()
                        break
                }
            })
        }
    })
})