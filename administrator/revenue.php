<script>
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

                        let total = response.total

                        $('tbody').html(rows)
                    } else {
                        alertError('Error', response.msg, 'Ok')
                    }
                }
            })
        }
    })
</script>

<div class="container mt-5 pt-5 montserrat">
    <h1>Revenue</h1>
    <div class="row mb-3">
        <div class="col">
            <input type="number" value="10" min="0" name="" id="limit" class="form-control" placeholder="Jumlah data">
        </div>
        <div class="col">
            <input type="date" value="2022-01-01" name="" id="dateStart" class="form-control">
        </div>
        <div class="col">
            <input type="date" value="" name="" id="dateEnd" class="form-control">
        </div>
        <div class="col">
            <select id="selectOrder" class="form-select">
                <option value="asc">Oldest</option>
                <option value="desc">Newest</option>
            </select>
        </div>
        <div class="col">
            <h3 class="text-success montserrat fw-bold">Rp 1.000.000</h3>
        </div>
    </div>
    <table class="table table-dark text-light table-hover text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Id Paket</th>
                <th>Nama paket</th>
                <th>Tanggal</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>