$(this).ready(function() {
    document.getElementById('dateEnd').valueAsDate = new Date()
    loadRevenue(10, '2022-01-01', '2099-12-12', 'asc')

    $('#dateStart, #dateEnd, #limit, #selectOrder').on("change", function() {
        let begin = $('#dateStart').val()
        let end = $('#dateEnd').val()
        let limit = $('#limit').val()
        let order = $('#selectOrder').val()

        loadRevenue(limit, begin, end, order)
    })

    function loadRevenue(paramDataAmount, paramBegin, paramEnd, paramOrder) {
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getRevenue.php',
            data: {
                begin: paramBegin,
                end: paramEnd,
                limit: paramDataAmount,
                order: paramOrder
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let data = response.data
                    let rows = ""
                    $.each(data, (i, d) => {
                        rows += `
                        <tr>
                            <td>${d.id}</td>
                            <td>${d.id_paket}</td>
                            <td>${d.nama}</td>
                            <td>${d.tanggal}</td>
                            <td>${d.nominal}</td>
                        </tr>
                        `
                    })

                    let total = response.total.toLocaleString("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    })
                    $('#totalRevenue').html(total)

                    $('tbody').html(rows)
                } else {
                    alertError('Error', response.msg, 'Ok')
                }
            }
        })
    }
})