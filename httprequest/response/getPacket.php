<?php 
global $conn;
$packetId = $_GET['packetId'];

if (!in_array($_GET['packetId'], [1, 2, 3])) {
    alertRedirect('Not found', 'Data tidak ditemukan', './', 'Ok');
    return;
}

$idUser = $conn->query("SELECT id FROM users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];
if (isPremiumUser($idUser)['premium'] == true) {
    alertRedirect('Error', 'Anda sudah menjadi premium member', './', 'Ok');
    return;
}

$rawData = json_encode($conn->query("SELECT * FROM packet WHERE id = $packetId")->fetch_assoc());
$packet = json_decode($rawData);

// user pencet beli
if (isset($_POST['submit'])) {
    $idUser = $conn->query("SELECT id FROM users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];
    if (!isset($_SESSION['user'])) {
        alertRedirect('Anda belum login', 'Login terlebih dahulu untuk melakukan pembayaran', './?page=login', 'Ok');
        return;
    }

    if ($va = $conn->query("SELECT * FROM virtual_account WHERE id_user = $idUser")->fetch_assoc()) {
        $vaPacketId = $va['id_packet'];
        $vaPayment = $va['payment'];
        alertRedirect('Anda memiliki transaksi yang belum selesai', 'Memindahkan anda ke halaman pembayaran', "./?page=virtualaccount&idpacket=$vaPacketId&payment=$vaPayment", 'Ok');
        return;
    }

    $paymentMethod = $_POST['paymentMethod'];

    header("Location:?page=virtualaccount&idpacket=$packetId&payment=$paymentMethod");
}
