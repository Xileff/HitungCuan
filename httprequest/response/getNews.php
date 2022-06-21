<?php
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$val = $_GET['val'];
$newsList = [];
$result = [];

if ($val === '*') {
    $newsList = $conn->query("SELECT * FROM news");
} else {
    $keyword = $val;
    $newsList = $conn->query("SELECT * FROM news WHERE judul_berita LIKE '%$keyword%'");
}
while ($news = $newsList->fetch_assoc()) {
    $author = $conn->query("SELECT nama FROM author WHERE id = " . $news['id_author'])->fetch_assoc()['nama'];
    $news['author'] = $author;
    $news['tanggal_rilis'] = tgl_indo($news['tanggal_rilis']);
    $result[] = $news;
}

echo json_encode($result);
