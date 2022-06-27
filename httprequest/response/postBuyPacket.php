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

$userId = $conn->query("SELECT id FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];

// Error 1
if ($va = $conn->query("SELECT * FROM tbl_virtual_account WHERE id_user = $userId")->fetch_assoc()) {
    $vaPacketId = $va['id_packet'];
    $vaPayment = $va['payment'];
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
$result['redirect'] = [
    'packetId' => $packetId,
    'payment' => $paymentMethod
];

echo json_encode($result);
