<?php

require '../../logic/dbconn.php';
require '../../logic/functions.php';

$id = $_GET['id'];
$news = $conn->query("SELECT * FROM news WHERE id=$id");
$result = ['success' => false];
if ($news->num_rows === 1) {
    $news = $news->fetch_assoc();
    $news['tanggal_rilis'] = tgl_indo($news['tanggal_rilis']);
    $author = $conn->query("SELECT nama FROM author WHERE id=" . $news['id_author'])->fetch_assoc();
    $result['success'] = true;
    $result['newsdata'] = array_merge($news, $author);
}

echo json_encode($result);
