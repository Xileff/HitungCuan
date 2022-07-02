$(this).ready(function(){
    $(this).on("click", "#btnBuktiTransaksi", function(){
        $.ajax({
            type: 'GET',
            url: 'httprequest/response/getTransactionPdf.php',
            data: { action: 'download' },
            dataType: 'json',
            success: response => {
                // download di sini
            }
        })
    })
})