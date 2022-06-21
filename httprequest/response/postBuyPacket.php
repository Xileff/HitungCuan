<?php
session_start();
require '../../logic/dbconn.php';

// 0. Belum login
// 1. Sudah ada virtual account

// Error 0
if (!isset($_SESSION['username'])) {
    $result['error'] = 0;
    echo json_encode($result);
    return;
}

$userId = $conn->query("SELECT id FROM users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];

// Error 1
if ($va = $conn->query("SELECT * FROM virtual_account WHERE id_user = $userId")->fetch_assoc()) {
    $vaPacketId = $va['id_packet'];
    $vaPayment = $va['payment'];
    // alertRedirect('Anda memiliki transaksi yang belum selesai', 'Memindahkan anda ke halaman pembayaran', "./?page=virtualaccount&idpacket=$vaPacketId&payment=$vaPayment", 'Ok');
    $result['error'] = 1;
    $result['existing_va'] = [
        'id' => $vaPacketId,
        'paymentMethod' => $vaPayment
    ];

    echo json_encode($result);
    return;
}

// Ke halaman generate va
$packetId = htmlspecialchars(stripslashes($_POST['packetId']));
$paymentMethod = htmlspecialchars(stripslashes($_POST['paymentMethod']));
$result['redirect'] = "?page=virtualaccount&idpacket=$packetId&payment=$paymentMethod";

// $result['error'] = 0;
echo json_encode($result);
// header("Location:?page=virtualaccount&idpacket=$packetId&payment=$paymentMethod");