<?php

require '../../logic/dbconn.php';
require '../../logic/functions.php';

$id = $_GET['newsId'];
$comments = $conn->query("SELECT * FROM tbl_news_comment WHERE id_berita = '$id'");
$count = ['count' => $comments->num_rows];
$result = [];
$listComments = [];

if ($comments->num_rows > 0) {
    while ($comment = $comments->fetch_assoc()) {
        $fotoUser = $conn->query("SELECT foto FROM tbl_users WHERE id=" . $comment['id_user'])->fetch_assoc()['foto'];
        $comment['foto_user'] = $fotoUser;
        $comment['tanggal'] = tgl_indo($comment['tanggal']);
        $listComments[] = $comment;
    }
}

$result = array_merge($count, ['comments' => $listComments]);
echo json_encode($result);
