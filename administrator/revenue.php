<script src="administrator/httprequest/request/revenue.js" type="module"></script>
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
            <h3 id="totalRevenue" class="text-success montserrat fw-bold">Rp 1.000.000</h3>
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