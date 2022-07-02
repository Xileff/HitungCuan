<?php
require '../../../logic/dbconn.php';
require '../../../logic/functions.php';

$news = [];
$kw = $_GET['kw'];
if ($kw == "*") {
    $news = $conn->query(
        "SELECT n.id, n.judul_berita, a.nama AS nama_author, n.tanggal_rilis
        FROM tbl_news n LEFT JOIN tbl_author a
        ON n.id_author = a.id
        "
    );
} else {
    $news = $conn->query(
        "SELECT n.id, n.judul_berita, a.nama AS nama_author, n.tanggal_rilis
        FROM tbl_news n LEFT JOIN tbl_author a
        ON n.id_author = a.id
        WHERE judul_berita LIKE '%$kw%'
        "
    );
}

$res = [];
while ($n = $news->fetch_assoc()) {
    $n['tanggal_rilis'] = tgl_indo($n['tanggal_rilis']);
    $res[] = $n;
}
echo json_encode($res);
