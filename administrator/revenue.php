<script>
    $(this).ready(function() {
        document.getElementById('dateEnd').valueAsDate = new Date()

        const begin = $('#dateBegin').val()
        const end = $('#dateEnd').val()

        function loadRevenue(dataAmount = 10, dateBegin = begin, dateEnd = end) {

        }
    })
</script>

<div class="container mt-5 pt-5 montserrat">
    <h1>Revenue</h1>
    <div class="row mb-3">
        <div class="col">
            <input type="number" min="0" name="" id="limit" class="form-control" placeholder="Jumlah data">
        </div>
        <div class="col">
            <input type="date" value="2022-01-01" name="" id="dateStart" class="form-control">
        </div>
        <div class="col">
            <input type="date" value="" name="" id="dateEnd" class="form-control">
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