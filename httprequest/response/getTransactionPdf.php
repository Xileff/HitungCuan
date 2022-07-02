<?php
session_start();
require '../../logic/dbconn.php';
require '../../logic/functions.php';
$userId = $conn->query("SELECT id FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];

$transactionData = $conn->query(
    "SELECT "
);

    // kode transaksi
    // id paket
    // nama paket
    // id user
    // username
    // tanggal expire