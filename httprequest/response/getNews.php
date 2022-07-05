<?php
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$val = htmlspecialchars(stripslashes($_GET['val']));
$val = mysqli_real_escape_string($conn, $val);
$orderBy = htmlspecialchars(stripslashes($_GET['order']));
if (!in_array($orderBy, [1, 2])) {
    $orderBy = 1;
}
$order = $orderBy == 1 ? 'DESC' : 'ASC';

$newsList = [];
$result = [];

$keyword = $val;
$newsList = $conn->query(
    "SELECT b.id, b.judul_berita, b.gambar, a.nama AS 'author', b.tanggal_rilis
    FROM tbl_news b JOIN tbl_author a
    ON b.id_author = a.id
    " . ($val != "*" ? "WHERE b.judul_berita LIKE '%$val%'" : '') . "
    ORDER BY tanggal_rilis $order;"
);

while ($news = $newsList->fetch_assoc()) {
    $news['tanggal_rilis'] = tgl_indo($news['tanggal_rilis']);
    $result[] = $news;
}

echo json_encode($result);
