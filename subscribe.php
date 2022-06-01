<style>
    .selected-payment {
        border: 0.5rem solid rgb(117, 249, 145);
    }
</style>
<div class="container mt-5 pt-5">
    <section class="border-hitungcuan border-radius-10 p-3">
        <p class="fs-3 fw-bold text-center poppins">Rincian pembayaran</p>
        <table class="table fw-bold fs-4 montserrat">
            <tbody>
                <tr class="border-none">
                    <td class="text-start text-light">Nama paket :</td>
                    <td class="text-end font-green">12 Bulan</td>
                </tr>
                <tr class="border-none">
                    <td class="text-start text-light">Total harga :</td>
                    <td class="text-end font-green">Rp 600.000</td>
                </tr>
            </tbody>
        </table>
        <section>
            <p class="fs-4">Metode Pembayaran</p>
            <form class="p-3" method="post">
                <div class="row" id="rowPayment">
                    <div class="col form-check border-radius-10 col-payment hvr-float">
                        <input class="form-check-input d-none" type="radio" name="paymentMethod" id="bca" value="bca">
                        <label class="form-check-label p-1 h-100" for="bca">
                            <img src="assets/images/subscription/bca.jpg" alt="bca" class="img-fluid  border-radius-10 h-100">
                        </label>
                    </div>
                    <div class="col form-check border-radius-10 col-payment hvr-float">
                        <input class="form-check-input d-none" type="radio"  name="paymentMethod" id="bri" value="bri">
                        <label class="form-check-label p-1 h-100" for="bri">
                            <img src="assets/images/subscription/bri.jpg" alt="bri" class="img-fluid  border-radius-10 h-100">
                        </label>
                    </div>
                    <div class="col form-check border-radius-10 col-payment hvr-float">
                        <input class="form-check-input d-none" type="radio"  name="paymentMethod" id="gopay" value="gopay">
                        <label class="form-check-label p-1 h-100" for="gopay">
                            <img src="assets/images/subscription/gopay.jpg" alt="gopay" class="img-fluid  border-radius-10 h-100">
                        </label>
                    </div>
                </div>
                <button type="submit" id="btnSubmit" class="index-headline-button">Bayar</button>
            </form>
        </section>
    </section>
</div>
<script>
    const colPayments = document.getElementsByClassName('col-payment');
    const radioValue = document.getElementsByName('paymentMethod');
    for (const colPayment of colPayments) {
        colPayment.addEventListener('click', e => {
            if(e.target.tagName === 'IMG') {
                e.target.parentNode.click();
                showSelectedPayment();
            }
        })
    }

    const btnSubmit = document.getElementById('btnSubmit');
    btnSubmit.addEventListener('click', e => {
        radioValue.forEach(r => {
            if(r.checked) alert(r.value);
        })
        e.preventDefault();
    })

    function showSelectedPayment(){
        const radioValue = document.getElementsByName('paymentMethod');
        for (const radioBtn of radioValue) {
            if(radioBtn.checked){
                radioBtn.nextElementSibling.firstElementChild.classList.add('selected-payment');
            }
            else {
                radioBtn.nextElementSibling.firstElementChild.classList.remove('selected-payment');
            }
        }
    }
</script>

<!-- 
Mysql time format 
DATETIME - format: YYYY-MM-DD HH:MI:SS.
php : date("Y-m-d H:i:s")
 -->