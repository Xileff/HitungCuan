import { getUrlParameter, checkLoginStatus } from './mixins.js'

$(document).ready(function(){
    // console.log(getUrlParameter('idpacket'))
    // 0. belum login, 1. bukan premium, 2. premium
    $('#formVirtualAccount').hide()
    let status = 0
    checkLoginStatus().then(response => {
        status = response.code
        switch(status){
            case 0:
                errorRedirect('Oops', 'Anda perlu login terlebih dahulu', 'Ok', '?page=login')
                break
            case 1:
                // generate VA di php, terus redirect ke halaman pembayaran
                const url_payment = getUrlParameter('payment')
                const url_packetId = getUrlParameter('packetId')
                $.ajax({
                    type: 'GET',
                    url: 'httprequest/response/getGenerateVA.php',
                    data: {
                        payment: url_payment,
                        packetId: url_packetId
                    },
                    dataType: 'JSON',
                    success: function(response){
                        if(response.success){
                            const va = response.va
                            console.log(va)
                            $('#formVirtualAccount').show()
                            $('#txtVaId').html(va.id)
                            $('#imgPayment').attr('src', `assets/images/subscription/${va.payment}.jpg`)
                            $('#txtVaExpire').html(va.expire)
                        }
                        else {
                            errorRedirect('Error', 'Kesalahan server, silakan coba lagi', 'Ok', `?page=virtualaccount&packetId=${url_packetId}&paymentId=${url_payment}`)
                        }
                    }
                })
                break
            case 2:
                errorRedirect('Oops', 'Anda sudah menjadi user premium', 'Ok', '?page=homepage')
                break
        }
    })

    // bisa kasih gambar loading di sini
})