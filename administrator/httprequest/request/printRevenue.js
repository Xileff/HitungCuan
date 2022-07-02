$(this).ready(function(){
    $('#btnDownload').on("click", function(){
        window.location.href = $('#btnDownload').attr('href')
        alertSuccess('Berhasil', 'Laporan telah terdownload', 'Ok');
        // $.ajax({
        //     type: 'GET',
        //     url: $('#btnDonwload').attr('href'),
        //     success: function(){
        //         window.location.href = $('#btnDownload').attr('href')
        //         $.ajax({
        //             type: 'GET',
        //             url: 'administrator/httprequest/response/printRevenue.php',
        //             data: {
        //                 action: 'delete',
        //                 fileName: $('#btnDownload').data('fileName')                
        //             }
        //         })
        //     }
        // })
    })
    $('#btnPrint').click(function(){
        let begin = $('#dateStart').val()
        let end = $('#dateEnd').val()
        let limit = $('#limit').val()
        let order = $('#selectOrder').val()

        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/printRevenue.php',
            data: {
                action: 'download',
                dateStart: begin,
                dateEnd: end,
                limit: limit,
                order: order
            },
            dataType: 'json',
            success: response => {
                $('#btnDownload').attr('href', `administrator/httprequest/response/revenueReport/${response.fileName}`)
                $('#btnDownload').data('fileName', response.fileName)
                $('#btnDownload').click()
            }
        })
    })
})