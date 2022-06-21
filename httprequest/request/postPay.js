import { getUrlParameter } from './mixins.js'
$(document).ready(function(){
    const packetId = getUrlParameter('packetId');
    if(!packetId in [1,2,3]){
        errorRedirect('Oops', 'Invalid packet', 'Ok', 'Homepage')
        return
    }

    $('#inputPacketId').val(getUrlParameter('packetId'))
    $('#btnPay').click(function(e){
        e.preventDefault()
        $('#inputOperation').val('pay')
        payment($('#formVirtualAccount').serialize())
    })
    $('#btnCancel').click(function(e){
        e.preventDefault()
        $('#inputOperation').val('cancel')
        payment($('#formVirtualAccount').serialize())
    })

    function payment(paymentParam){
        $.ajax({
            type: 'POST',
            url: 'httprequest/response/postPay.php',
            data: paymentParam,
            dataType: 'JSON',
            success: function(response){
                console.log(response)
                if(response.success){
                    switch(response.code){
                        case 2:
                            errorRedirect('Batal', 'Transaksi berhasil dibatalkan', 'Ok', '?page=homepage')
                            break
                        case 3:
                            successRedirect('Berhasil', 'Transaksi berhasil dibayar, anda sudah menjadi premium member', 'Ok', '?page=homepage')
                            break
                    }
                }
                else {
                    errorRedirect('Error', 'Kesalahan server', 'Silakan coba lagi', '?page=homepage')
                }
            }
        })
    }
})