<?php
global $conn;

// hideError();

$validPmtMethod = ['bca', 'bri', 'gopay'];
if (!in_array($_GET['payment'], $validPmtMethod)) {
    // alertRedirect('Error', 'Tidak ada metode pembayaran tersebut', './', 'Ok');
    header("Location: ./");
    return;
}

$validPacket = [1, 2, 3];
if (!in_array($_GET['idpacket'], $validPacket)) {
    // alertRedirect('Error', 'Paket tidak ditemukan', './', 'Ok');
    header("Location: ./");
    return;
}

$idPacket = $_GET['idpacket'];
$userId = $conn->query("SELECT id FROM users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];
$packet = $conn->query("SELECT durasi, harga FROM packet WHERE id = $idPacket")->fetch_assoc();
$payment = $_GET['payment'];

// cek apakah sudah ada va dgn user_id ini
$va = $conn->query("SELECT * FROM virtual_account WHERE id_user = $userId")->fetch_assoc();

// cek apakah sudah expire
if (date('Y-m-d') == $va['expire']) {
    $conn->query("DELETE FROM virtual_account WHERE id_user = $userId");
    if ($conn->affected_rows !== 1) {
        alertRedirect('Kesalahan server', 'Silakan coba lagi', './', 'Ok');
        return;
    }
    $va = false;
}

// jika tidak ada/sudah expire, generate yg baru
if (!$va) {
    // $generatedVa = "8" . strval(mt_rand(1000000, 9999999));
    $generatedVa = "8" . strval(hexdec(uniqid()));
    $conn->query("INSERT INTO virtual_account VALUES('$generatedVa', $userId, $idPacket, '$payment', " . $packet['harga'] . ", '" . date("Y-m-d", strtotime("+1 days")) . "')");

    if (mysqli_affected_rows($conn) === 1) {
        $va = $conn->query("SELECT * FROM virtual_account WHERE id_user = $userId")->fetch_assoc();
    } else {
        alertRedirect('Error', 'Gagal menggenerate VA, silakan coba lagi', './', 'Ok');
        var_dump($conn->error);
        return;
    }
}


if (isset($_POST['submit']) && $_POST['submit'] === 'pay') {
    // insert ke tabel subscription
    $today = date('Y-m-d');
    $expireDate;
    switch ($idPacket) {
        case 1:
            $expireDate = date('Y-m-d', strtotime('+ 365 days'));
            break;
        case 2:
            $expireDate = date('Y-m-d', strtotime('+ 180 days'));
            break;
        case 3:
            $expireDate = date('Y-m-d', strtotime('+ 90 days'));
            break;
    }

    $conn->query("DELETE FROM virtual_account WHERE id_user = $userId");
    if ($conn->affected_rows !== 1) {
        alertRedirect('Kesalahan server', 'Silakan coba lagi', $_SERVER['REQUEST_URI'], 'Ok');
        return;
    }

    $conn->query("INSERT INTO subscription VALUES('', $idPacket, $userId, '$expireDate')");
    if ($conn->affected_rows !== 1) {
        alertRedirect('Kesalahan server', 'Silakan coba lagi', $_SERVER['REQUEST_URI'], 'Ok');
        return;
    }

    $conn->query("INSERT INTO revenue VALUES('', $idPacket, '$today', " . $packet['harga'] . ")");
    if ($conn->affected_rows !== 1) {
        alertRedirect('Kesalahan server', 'Silakan coba lagi', $_SERVER['REQUEST_URI'], 'Ok');
        return;
    }
    alertRedirect('Berhasil', 'Anda sudah menjadi member, redirecting', './', 'Ok');
} else if (isset($_POST['submit']) && $_POST['submit'] === 'cancel') {
    $conn->query("DELETE FROM virtual_account WHERE id_user = $userId");
    if ($conn->affected_rows === 1) {
        alertRedirect('Transaksi dibatalkan', 'Kembali ke halaman utama', './', 'Ok');
        return;
    } else {
        alertRedirect('Kesalahan server', 'Silakan coba lagi', './', 'Ok');
    }
}
?>

<div class="container mt-5 pt-5 mb-5">
    <section class="border-hitungcuan border-radius-10 p-5 mb-5">
        <form method="post">
            <p class="text-center fs-3">Virtual Account</p>
            <p class="text-center fs-2 fw-bold font-green"><?= $va['id'] ?></p>
            <div class="d-flex justify-content-center mb-3">
                <img src="assets/images/subscription/<?= $_GET['payment'] ?>.jpg" alt="gopay" class="img-fluid w-50 border-radius-10 mx-auto">
            </div>
            <p class="text-center fs-4 fw-bold">Bayar sebelum <?= tgl_indo($va['expire']) ?></p>
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
    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    const tomorrow = new Date(`${monthNames[new Date().getMonth()]} ${new Date().getDay()}, ${new Date().getFullYear()} 00:00:00`).getTime();
    const spanCountdown = document.getElementById('spanCountdown');

    let x = setInterval(() => {
        let now = new Date().getTime();
        let distance = tomorrow - now;

        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        spanCountdown.innerHTML = (hours < 10 ? "0" + hours : hours) + " : " + (minutes < 10 ? "0" + minutes : minutes) + " : " + (seconds < 10 ? "0" + seconds : seconds);

        if (distance < 0) {
            clearInterval(x);
            spanCountdown.innerHTML = "EXPIRED";
        }
    }, 1000);
</script>