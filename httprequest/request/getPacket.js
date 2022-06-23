import { getUrlParameter } from './mixins.js'

$(document).ready(function() {
    let url_packetId = getUrlParameter('packetId')
    $('#containerPacket').hide()
    $.ajax({
        type: 'GET',
        url: 'httprequest/response/getPacket.php',
        data: { packetId : url_packetId },
        dataType: 'JSON',
        success: function(response) {
            if(response.code in response.failureCodes){
                // $('#containerPacket').hide()
                $('#footer').hide()
                switch(response.code){
                    case 0:
                        errorRedirect('Oops', 'Anda harus login sebelum membeli paket', 'Ok', '?page=login')
                        break
                    case 1:
                        errorRedirect('Oops', 'Paket tidak valid', 'Ok', '?page=homepage')
                        break
                    case 2:
                        errorRedirect('Oops', 'Anda sudah menjadi premium member','Ok', '?page=homepage')
                        break
                    case 3:
                        errorRedirect('Oops', 'Anda memiliki transaksi yang belum selesai','Ok', '?page=homepage')
                        break
                }
            }

            else {
                const packet = response.packet
                $('#containerPacket').show()
                $('#txtNamaPacket').html(packet.nama)
                $('#txtTotalHarga').html(packet.harga)
                $('#txtExpire').html(packet.expire)
            }
        }
    })
})