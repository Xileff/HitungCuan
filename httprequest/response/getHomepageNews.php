<?php

require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result = [];

$newsList = $conn->query("SELECT id, judul_berita, gambar, id_author, tanggal_rilis FROM news ORDER BY tanggal_rilis DESC LIMIT 4");

while ($news = $newsList->fetch_assoc()) {
    $author = $conn->query("SELECT nama FROM author WHERE id = " . $news['id_author'])->fetch_assoc()['nama'];
    $news['author'] = $author;
    $news['tanggal_rilis'] = tgl_indo($news['tanggal_rilis']);
    $result[] = $news;
}

echo json_encode($result);
