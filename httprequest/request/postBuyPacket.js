import { getUrlParameter } from './mixins.js'

$(document).ready(function(){
    $('#btnSubmit').click(function(e){
        e.preventDefault()
        $('#inputPacketId').val(getUrlParameter('packetId'))
        const formSubscribe = $('#formSubscribe').serialize()
        
        $.ajax({
            type: 'POST',
            url: 'httprequest/response/postBuyPacket.php',
            data: formSubscribe,
            dataType: 'JSON',
            success: function(response){
                if(response.error === undefined){
                    successRedirect('Generate VA', 'Silakan lanjutkan pembayaran anda', 'Ok', `${response.redirect}`);
                }
                else {
                    error = response.error
                    switch(error){
                        case 0:
                            errorRedirect('Belum login', 'Silakan login terlebih dahulu', 'Ok', '?page=login')
                            break
                        case 1:
                            existingVa = response.existing_va
                            errorRedirect('Error', 'Anda memiliki transaksi yang belum selesai', 'Ok', `./?page=virtualaccount&idpacket=${existingVa.id}&payment=${existingVa.paymentMethod}`);
                            break
                    }
                }
            }
        })
    })
})