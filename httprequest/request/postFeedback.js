$(document).ready(function(){
    $('#btnFeedback').click(function(e){
        e.preventDefault()

        if($('#txtFeedback').val().length < 1){
            alertError('Error', 'Feedback anda kosong', 'Ok')
            return
        }

        const formFeedback = $('#formFeedback').serialize()
        $.ajax({
            type: 'POST',
            url: 'httprequest/response/postFeedback.php',
            data: formFeedback,
            dataType: 'JSON',
            success: function(response){
                if(response.success){
                    alertSuccess('Berhasil', 'Feedback berhasil dikirim, terima kasih!', 'Ok');
                }
                else {
                    alertError('Gagal', response.msg, 'Ok')
                }
                $('#txtFeedback').val('')
                // const code = response.code
                // switch(code){
                //     case 0:
                //         errorRedirect('Anda belum login', 'Login terlebih dahulu sebelum memberikan saran dan masukan', 'Login', '?page=login');
                //         break;
                //     case 1:
                //         alertError('Gagal', 'Feedback gagal diupload, silakan coba lagi', 'Ok');
                //         break;
                //     case 2:
                //         alertSuccess('Berhasil', 'Feedback berhasil dikirim, terima kasih!', 'Ok');
                // }
            }
        })
    })
})