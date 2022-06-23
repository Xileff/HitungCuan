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
                    window.location.href = response.url;
                }
                else {
                    alertError('Gagal', 'Username atau password salah', 'Ok');
                }
            }
        })
    })
})