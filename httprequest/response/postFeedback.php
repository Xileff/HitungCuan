<?php
require '../../logic/dbconn.php';
session_start();

$result = [];
//0. belum login, 1. gagal, 2. berhasil
if (!isset($_SESSION['username'])) {
    $result['code'] = 0;
} else {
    $teksFeedback = $_POST['teksFeedback'];
    $user = $conn->query("SELECT id, username FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc();
    $conn->query("INSERT INTO tbl_feedback VALUES('', '" . $user['id'] . "', '" . $user['username'] . "', '" . date('Y-m-d') . "', '" . $_POST['teksFeedback'] . "')");

    $result['code'] = ($conn->affected_rows === 1) ? 2 : 1;
}

echo json_encode($result);
