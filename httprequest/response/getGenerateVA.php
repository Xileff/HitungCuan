<?php
session_start();
require '../../logic/dbconn.php';
require '../../logic/functions.php';

// 0. Pembayaran tidak valid => redirect ke subscribe.php
// 1. Paket tidak valid => redirect ke subscribe.php
// 2. Kesalahan server => refresh
// 3. Invalid access

$result = ['success' => false];

$validPmtMethod = ['bca', 'bri', 'gopay'];
if (!in_array($_GET['payment'], $validPmtMethod)) {
    $result['error'] = 0;
    echo json_encode($result);
    return;
}

$validPacket = [1, 2, 3];
if (!in_array($_GET['packetId'], $validPacket)) {
    $result['error'] = 1;
    echo json_encode($result);
    return;
}

$packetId = $_GET['packetId'];
$packet = $conn->query("SELECT durasi, harga FROM packet WHERE id = $packetId")->fetch_assoc();
$payment = $_GET['payment'];

$userId = $conn->query("SELECT id FROM users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];

// cek apakah sudah ada va dgn user_id ini
$va = $conn->query("SELECT * FROM virtual_account WHERE id_user = $userId");
if ($va->num_rows === 1) {
    $va = $va->fetch_assoc();
    // cek apakah sudah expire
    if (date('Y-m-d') == $va['expire']) {
        $conn->query("DELETE FROM virtual_account WHERE id_user = $userId");
        if ($conn->affected_rows !== 1) {
            $result['error'] = 2;
            echo json_encode($result);
            return;
        }

        $va = false;
    }

    // kalo ada dan belum expire, maka data ini yang ditampilkan di halaman
    else {
        $result = ['success' => true];
        $va['expire'] = tgl_indo($va['expire']);
        $result['va'] = $va;
        echo json_encode($result);
        return;
    }
}

// jika tidak ada/sudah expire, kemudian di GET direquest new, maka generate yg baru.
else if ($va->num_rows !== 1 || !$va) {
    $new = $_GET['new'];
    if ($new !== true) {
        $result['error'] = 3;
        echo json_encode($result);
        return;
    }
    $generatedVa = "8" . strval(hexdec(uniqid()));
    $conn->query("INSERT INTO virtual_account VALUES('$generatedVa', $userId, $packetId, '$payment', " . $packet['harga'] . ", '" . date("Y-m-d", strtotime("+1 days")) . "')");

    if (mysqli_affected_rows($conn) === 1) {
        $va = $conn->query("SELECT * FROM virtual_account WHERE id_user = $userId")->fetch_assoc();
        $va['expire'] = tgl_indo($va['expire']);
        $result = ['success' => true];
        $result['va'] = $va;
    } else {
        $result['error'] = 2;
    }

    echo json_encode($result);
}
