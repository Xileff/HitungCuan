$(document).ready(function(){
    $.ajax({
        type: 'POST',
        url: 'httprequest/response/checkAccount.php',
        dataType: 'JSON',
        success: function(response){
            const code = response.code
            switch(code){
                case 0:
                    $('#containerCuancademy').html(`<h1 class="p-5">Belum login<h1>`)
                    alertRedirect('Belum Login', 'Anda harus login terlebih dahulu', '?page=login', 'Ok')
                    break
                case 1:
                    $('#containerCuancademy').html(`<h1 class="p-5">Hanya untuk user premium<h1>`)
                    alertRedirect('Maaf', 'Fitur ini hanya tersedia untuk akun premium', 'Ok')
                    break
            }
        }
    })
})