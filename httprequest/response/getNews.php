<?php
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$val = $_GET['val'];
$news = [];
$result = [];

if ($val === '*') {
    $news = $conn->query("SELECT * FROM news");
} else {
    $keyword = $val;
    $news = $conn->query("SELECT * FROM news WHERE judul_berita LIKE '%$keyword%'");
}

while ($n = $news->fetch_assoc()) {
    $result[] = $n;
}

echo json_encode($result);
?>