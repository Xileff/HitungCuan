<script src="httprequest/request/getPacket.js" type="module"></script>
<script src="httprequest/request/postBuyPacket.js" type="module"></script>
<div class="container mt-5 pt-5" id="containerPacket">
    <section class="border-hitungcuan border-radius-10 p-3">
        <p class="fs-3 fw-bold text-center poppins">Rincian pembayaran</p>
        <table class="table fs-4 montserrat">
            <tbody>
                <tr class="border-none">
                    <td class="text-start text-light">Nama paket :</td>
                    <td class="text-end font-green fw-bold" id="txtNamaPacket"></td>
                </tr>
                <tr class="border-none">
                    <td class="text-start text-light">Total harga :</td>
                    <td class="text-end font-green fw-bold" id="txtTotalHarga"></td>
                </tr>
                <tr class="border-none">
                    <td class="text-start text-light">Aktif hingga :</td>
                    <td class="text-end font-green fw-bold" id="txtExpire"></td>
                </tr>
            </tbody>
        </table>
        <section>
            <p class="fs-4 text-center">Metode Pembayaran</p>
            <form class="p-3" method="post" id="formSubscribe">
                <input type="hidden" name="packetId" id="inputPacketId">
                <div class="row mb-4">
                    <div class="col form-check border-radius-10 col-payment hvr-float">
                        <input class="form-check-input d-none" type="radio" name="paymentMethod" id="bca" value="bca">
                        <label class="form-check-label p-1 h-100" for="bca">
                            <img src="assets/images/subscription/bca.jpg" alt="bca" class="img-fluid  border-radius-10 h-100">
                        </label>
                    </div>
                    <div class="col form-check border-radius-10 col-payment hvr-float">
                        <input class="form-check-input d-none" type="radio" name="paymentMethod" id="bri" value="bri">
                        <label class="form-check-label p-1 h-100" for="bri">
                            <img src="assets/images/subscription/bri.jpg" alt="bri" class="img-fluid  border-radius-10 h-100">
                        </label>
                    </div>
                    <div class="col form-check border-radius-10 col-payment hvr-float">
                        <input class="form-check-input d-none" type="radio" name="paymentMethod" id="gopay" value="gopay">
                        <label class="form-check-label p-1 h-100" for="gopay">
                            <img src="assets/images/subscription/gopay.jpg" alt="gopay" class="img-fluid  border-radius-10 h-100">
                        </label>
                    </div>
                </div>
                <div class="d-flex justify-content-around">
                    <button type="submit" id="btnSubmit" name="submit" class="index-headline-button mx-auto pt-2 pb-2 px-5 w-50" style="background-color: rgb(117, 249, 145)">Bayar</button>
                </div>
            </form>
        </section>
    </section>
</div>
<script>
    const colPayments = document.getElementsByClassName('col-payment');
    const radioValue = document.getElementsByName('paymentMethod');
    for (const colPayment of colPayments) {
        colPayment.addEventListener('click', e => {
            if (e.target.tagName === 'IMG') {
                e.target.parentNode.click();
                showSelectedPayment();
            }
        })
    }

    const btnSubmit = document.getElementById('btnSubmit');

    btnSubmit.addEventListener('click', e => {
        let chosen = false;
        radioValue.forEach(r => {
            if (r.checked) chosen = true;
        })

        if (!chosen) {
            alertError('Error', 'Anda belum memilih pembayaran', 'Ok');
            e.preventDefault();
        }
    })

    function showSelectedPayment() {
        const radioValue = document.getElementsByName('paymentMethod');
        for (const radioBtn of radioValue) {
            if (radioBtn.checked) {
                radioBtn.nextElementSibling.firstElementChild.classList.add('selected-payment');
            } else {
                radioBtn.nextElementSibling.firstElementChild.classList.remove('selected-payment');
            }
        }
    }
</script>