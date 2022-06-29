<?php
session_start();

require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result = [
    'success' => false,
    'msg' => 'Gagal komentar'
];
$idNews = htmlspecialchars(stripslashes($_GET['id_news']));
$comment = htmlspecialchars(stripslashes($_GET['comment']));
//0 belum login, 1 kesalahan server, 2 berhasil

if (!isset($_SESSION['username'])) {
    $result['msg'] = 'Belum login';
} else {
    // jika sudah login, boleh komentar
    $user = $conn->query("SELECT id, username, foto FROM tbl_users WHERE username='" . $_SESSION['username'] . "'")->fetch_assoc();

    $userId = $user['id'];
    $idNews = mysqli_real_escape_string($conn, $idNews);
    $username = $user['username'];
    $date = date('Y-m-d');
    $comment = mysqli_real_escape_string($conn, $comment);

    $stmtComment = $conn->prepare("INSERT INTO tbl_news_comment VALUES('', ?, ?, ?, ?, ?)");
    $stmtComment->bind_param('iisss', $userId, $idNews, $username, $date, $comment);
    $stmtComment->execute();

    if ($conn->affected_rows == 1) {
        $result['success'] = true;
    }
}

echo json_encode($result);
