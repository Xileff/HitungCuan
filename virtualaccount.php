<script src="httprequest/request/getGenerateVA.js" type="module"></script>
<script src="httprequest/request/postPay.js" type="module"></script>
<div class="container mt-5 pt-5 mb-5">
    <section class="border-hitungcuan border-radius-10 p-5 mb-5">
        <form method="post" id="formVirtualAccount">
            <p class="text-center fs-3">Virtual Account</p>
            <p class="text-center fs-2 fw-bold font-green" id="txtVaId"></p>
            <div class="d-flex justify-content-center mb-3">
                <img id="imgPayment" src="assets/images/subscription/" alt="gopay" class="img-fluid w-50 border-radius-10 mx-auto">
            </div>
            <p class="text-center fs-4 fw-bold">Bayar sebelum <span id="txtVaExpire"></span></p>
            <p class="text-center fs-4">Sisa waktu pembayaran <span class="text-warning" id="spanCountdown"></span></p>
            <div class="d-flex flex-column justify-content-center">
                <button type="submit" name="submit" class="index-headline-button mx-auto pt-2 pb-2 px-5 w-50 mb-2" style="background-color: rgb(117, 249, 145)" value="pay">Saya Sudah Bayar</button>
                <button type="submit" name="submit" class="index-headline-button mx-auto pt-2 pb-2 px-5 w-50" style="border: 1px solid rgb(255, 0, 0); background-color: black; color: red" value="cancel">Batal</button>
            </div>
        </form>
    </section>
</div>
<div class="mb-5"></div>
<script>
    let monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    const spanCountdown = document.getElementById('spanCountdown');

    let x = setInterval(() => {
        const now = new Date()
        let tomorrow = new Date()
        tomorrow.setDate(new Date().getDate())
        tomorrow.setHours(24, 0, 0, 0)

        let distance = tomorrow - now;

        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        spanCountdown.innerHTML = (hours < 10 ? 0 + hours : hours) + " : " + (minutes < 10 ? "0" + minutes : minutes) + " : " + (seconds < 10 ? "0" + seconds : seconds);

        if (distance < 0) {
            clearInterval(x);
            spanCountdown.innerHTML = "EXPIRED";
        }
    }, 1000);
</script>