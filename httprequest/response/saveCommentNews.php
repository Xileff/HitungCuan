<?php
session_start();

require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result = ['status' => 0];
$idNews = htmlspecialchars(stripslashes($_GET['id_news']));
$comment = htmlspecialchars(stripslashes($_GET['comment']));
//0 belum login, 1 kesalahan server, 2 berhasil

if (!isset($_SESSION['username'])) {
    $result['status'] = 0;
} else {
    // jika sudah login, boleh komentar
    $user = $conn->query("SELECT id, username, foto FROM tbl_users WHERE username='" . $_SESSION['username'] . "'")->fetch_assoc();

    $conn->query("INSERT INTO tbl_news_comment VALUES('','" . $user['id'] . "','" . $idNews . "','" . $user['username'] . "', '" . date('Y-m-d') . "', '$comment')");

    if ($conn->affected_rows !== 1) {
        $result['status'] = 1;
    } else {
        $result['status'] = 2;
    }
}

echo json_encode($result);
