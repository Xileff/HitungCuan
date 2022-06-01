<?php 
global $conn;

$validPmtMethod = ['bca', 'bri', 'gopay'];
if(!in_array($_GET['payment'], $validPmtMethod)){
    alertRedirect('Error', 'Tidak ada metode pembayaran tersebut', './', 'Ok');
    return;
}

$validPacket = [1,2,3];
if(!in_array($_GET['idpacket'], $validPacket)){
    alertRedirect('Error', 'Paket tidak ditemukan', './', 'Ok');
    return;
}




?>

<div class="container mt-5 pt-5 mb-5">
    <section class="border-hitungcuan border-radius-10 p-5 mb-5">
        <form action="post">
            <p class="text-center fs-3">Virtual Account</p>
            <p class="text-center fs-2 fw-bold font-green">800800008080808</p>
            <div class="d-flex justify-content-center mb-3">
                <img src="assets/images/subscription/<?=$_GET['payment']?>.jpg" alt="gopay" class="img-fluid w-50 border-radius-10 mx-auto">
            </div>
            <p class="text-center fs-4 fw-bold">Bayar sebelum <?=date('Y-m-d', strtotime('+1 days'))?></p>
            <p class="text-center fs-4">Sisa waktu pembayaran <span class="text-warning" id="spanCountdown"></span></p>
            <div class="d-flex flex-column justify-content-center">
                <button type="submit" id="btnSubmit" name="submit" class="index-headline-button mx-auto pt-2 pb-2 px-5 w-50" style="background-color: rgb(117, 249, 145)">Saya Sudah Bayar</button>
            </div>
        </form>
    </section>
</div>
<div class="mb-5"></div>
<script>
    const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"];
    const tomorrow = new Date(`${monthNames[new Date().getMonth()]} ${new Date().getDay()}, ${new Date().getFullYear()} 00:00:00`).getTime();
    const spanCountdown = document.getElementById('spanCountdown');

    let x = setInterval(()=>{
        let now = new Date().getTime();
        let distance = tomorrow - now;

        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        spanCountdown.innerHTML = (hours < 10 ? "0" + hours : hours) + " : " + minutes + " : " + seconds;

        if(distance < 0){
            clearInterval(x);
            spanCountdown.innerHTML = "EXPIRED";
        }
    }, 1000);
</script>