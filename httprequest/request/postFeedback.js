$(document).ready(function(){
    $('#btnFeedback').click(function(e){
        e.preventDefault()
        const formFeedback = $('#formFeedback').serialize()
        $.ajax({
            type: 'POST',
            url: 'httprequest/response/postFeedback.php',
            data: formFeedback,
            dataType: 'JSON',
            success: function(response){
                const code = response.code
                switch(code){
                    case 0:
                        errorRedirect('Anda belum login', 'Login terlebih dahulu sebelum memberikan saran dan masukan', 'Login', '?page=login');
                        break;
                    case 1:
                        alertError('Gagal', 'Feedback gagal diupload, silakan coba lagi', 'Ok');
                        break;
                    case 2:
                        alertSuccess('Berhasil', 'Feedback berhasil dikirim, terima kasih!', 'Ok');
                }
            }
        })
    })
})