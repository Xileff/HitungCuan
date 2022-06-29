$(document).ready(function(){
    $('#btnLogin').click(function(e){
        e.preventDefault()
        const dataLogin = $('#formLogin').serialize()
        $.ajax({
            type: 'POST',
            url:'httprequest/response/postLogin.php',
            data: dataLogin,
            dataType: 'JSON',
            success: function(response){
                if(response.success === true){
                    successRedirect('Berhasil', 'Anda berhasil login ke akun anda', 'Ok', response.url)
                }
                else {
                    alertError('Gagal', response.msg, 'Ok');
                }
            }
        })
    })
})