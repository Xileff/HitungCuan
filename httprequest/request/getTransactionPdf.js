$(this).ready(function(){
    $(this).on("click", "#btnBuktiTransaksi", function(){
        $.ajax({
            type: 'GET',
            url: 'httprequest/response/getTransactionPdf.php',
            data: { action: 'download' },
            dataType: 'json',
            success: response => {
                // download di sini
                if(response.success){
                    console.log(response)
                    $('#btnDownloadBuktiTransaksi').attr('href', `httprequest/response/pdfTransaction/${response.fileName}`)
                    // data nnti buat hapus file di server kalo udh kedownload, biar tau nama filenya yg mana
                    $('#btnDownloadBuktiTransaksi').data('fileName', response.fileName)
                    $('#btnDownloadBuktiTransaksi').click()
                }
            }
        })
    })

    $(this).on("click", "#btnDownloadBuktiTransaksi", function(){
        window.location.href = $(this).attr('href')
        alertSuccess('Berhasil', 'Bukti transaksi akan didownload ke perangkat anda', 'Ok')
    })
})