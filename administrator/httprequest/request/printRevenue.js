$(document).ready(function(){
    $('#btnPrint').click(function(){
        // const date1 = $('#dateStart').val()
        // const date2 = $('#dateEnd').val()
        // const total = $('#totalRevenue').html()
        // const table = document.getElementById('tableRevenue').innerHTML

        // $('input[name="dateStart"]').val(date1)
        // $('input[name="dateEnd"]').val(date2)
        // $('textarea[name="dataTable"]').val(table)
        // $('input[name="totalRevenue"]').val(total)

        // console.log($('textarea[name="dataTable"]').val())

        let begin = $('#dateStart').val()
        let end = $('#dateEnd').val()
        let limit = $('#limit').val()
        let order = $('#selectOrder').val()

        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/printRevenue.php',
            data: {
                dateStart: begin,
                dateEnd: end,
                limit: limit,
                order: order
            },
            // dataType: 'json',
            success: response => {
                console.log(response)
                // if(response.success){
                //     alertSuccess('Berhasil', 'Anda berhasil mendownload laporan penghasilan', 'Ok')
                // }
                // else {
                //     alertError('Gagal', 'Silakan coba lagi setelah beberapa saat', 'Ok')
                // }
            }
        })
    })
})