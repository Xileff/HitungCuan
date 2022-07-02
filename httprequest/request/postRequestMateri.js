$(this).ready(function(){
    $('#btnSubmitRequest').click(function(){
        if($('textarea#text').val().length < 1){
            alertError('Gagal', 'Request tidak boleh kosong', 'Ok')
            return
        }
        const requestData = $('#form').serialize()
        $.ajax({
            type: 'POST',
            url: 'httprequest/response/postRequestMateri.php',
            data: requestData,
            dataType: 'json',
            success: response => {
                if(response.success){
                    alertSuccess('Berhasil', 'Request anda telah diteruskan kepada tim kami. Terima kasih!', 'Ok')
                }
                else {
                    alertError('Gagal', response.msg, 'Ok')
                }

                $('#form select').val($('#form select option:first').val())
                $('#form textarea').val('')
                $('.btn-close').click()      
            }
        })
    })
})