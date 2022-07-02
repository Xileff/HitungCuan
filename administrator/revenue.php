<script src="administrator/httprequest/request/revenue.js" type="module"></script>
<script src="administrator/httprequest/request/printRevenue.js" type="module"></script>
<div class="container mt-5 pt-5 montserrat">
    <h1>Revenue</h1>
    <div class="row mb-3">
        <div class="col">
            <input type="number" value="10" min="0" name="" id="limit" class="form-control rounded-pill" placeholder="Jumlah data">
        </div>
        <div class="col">
            <input type="date" value="2022-01-01" name="" id="dateStart" class="form-control rounded-pill">
        </div>
        <div class="col">
            <input type="date" value="" name="" id="dateEnd" class="form-control rounded-pill">
        </div>
        <div class="col">
            <select id="selectOrder" class="form-select rounded-pill">
                <option value="asc">Oldest</option>
                <option value="desc">Newest</option>
            </select>
        </div>
        <div class="col">
            <h3 id="totalRevenue" class="text-success montserrat fw-bold">Rp 1.000.000</h3>
        </div>
    </div>
    <section id="tableRevenue">
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
    </section>
    <form action="" hidden id="formPdf">
        <input type="date" name="dateStart" id="">
        <input type="date" name="dateEnd" id="">
        <textarea name="dataTable" id="" cols="30" rows="10"></textarea>
        <input type="text" name="totalRevenue" id="">
    </form>
    <section class="w-100 d-flex">
        <button class="ms-auto montserrat btn-view btn-sm btn-lg fw-bold rounded-pill px-5" style="background-color: rgb(117, 249, 145); border: none" id="btnPrint">
            <span class="fs-6">Print Report</span>
        </button>
    </section>
    <a id="btnDownload" href="" class="fs-6 link-unstyled" download="" hidden></a>
</div>