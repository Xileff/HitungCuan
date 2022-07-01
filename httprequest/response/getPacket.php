<?php
require '../../logic/dbconn.php';
require '../../logic/functions.php';
session_start();

// 0. Belum login
// 1. Paket tidak valid
// 2. Sudah jadi premium member
// 3. Memiliki transaksi yang belum selesai
$result = [
    'failureCodes' => [0, 1, 2, 3]
];

$packetId = $_GET['packetId'];

// Belum login
if (!isset($_SESSION['username'])) {
    $result['code'] = 0;
    echo json_encode($result);
    return;
}

// Paket tidak valid
if (!in_array($packetId, [1, 2, 3])) {
    $result['code'] = 1;
    echo json_encode($result);
    return;
}

// Sudah jadi premium member
$idUser = $conn->query("SELECT id FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];
if (isPremiumUser($idUser)['premium'] == true) {
    $result['code'] = 2;
    echo json_encode($result);
    return;
}

$packet = $conn->query("SELECT * FROM tbl_packet WHERE id = $packetId")->fetch_assoc();
$packet['harga'] = rupiah($packet['harga']);
$packet['expire'] = tgl_indo(date('Y-m-d', strtotime('+' . $packet['durasi'] . 'days')));

$result['packet'] = $packet;
echo json_encode($result);
