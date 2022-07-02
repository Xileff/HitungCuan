<?php
session_start();

require '../../logic/dbconn.php';
require '../../logic/functions.php';

// echo json_encode($_POST);

// 1. Kesalahan server
// 2. Batal
// 3. Berhasil langganan
$result = [
    'success' => false
];
$userId = $conn->query("SELECT id FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];

$packetId = $_POST['packetId'];

if ($_POST['operation'] === 'pay') {
    // insert ke tabel subscription
    $today = date('Y-m-d');
    $expireDate;
    switch ($packetId) {
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

    $vaNo = $conn->query("SELECT id FROM tbl_virtual_account WHERE id_user = $userId")->fetch_assoc()['id'];
    $conn->query("DELETE FROM tbl_virtual_account WHERE id_user = $userId");
    if ($conn->affected_rows !== 1) {
        $result['code'] = 1;
        echo json_encode($result);
        return;
    }

    $conn->query("INSERT INTO tbl_subscription VALUES('', $packetId, $userId, '$vaNo','$expireDate')");
    if ($conn->affected_rows !== 1) {
        $result['success'] = false;
        $result['code'] = 1;
        echo json_encode($result);
        return;
    }

    $packet = $conn->query("SELECT harga FROM tbl_packet WHERE id = $packetId")->fetch_assoc();
    $conn->query("INSERT INTO tbl_revenue VALUES('', $packetId, '$today', " . $packet['harga'] . ")");
    if ($conn->affected_rows !== 1) {
        $conn->query("DELETE FROM tbl_subscription WHERE id_user = $userId");
        $result['code'] = 1;
        echo json_encode($result);
        return;
    }

    // Jika sudah berhasil insert ke subscription dan revenue, baru berhasil
    else if ($conn->affected_rows === 1) {
        $result['success'] = true;
        $result['code'] = 3;
        echo json_encode($result);
    }
}

// Operasi cancel
else if ($_POST['operation'] === 'cancel') {
    $conn->query("DELETE FROM tbl_virtual_account WHERE id_user = $userId");
    if ($conn->affected_rows === 1) {
        $result['success'] = true;
        $result['code'] = 2;
    } else {
        $result['code'] = 1;
    }

    echo json_encode($result);
}
