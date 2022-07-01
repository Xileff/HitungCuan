<?php

require '../../../logic/dbconn.php';
$id = $_GET['id'];
$res['success'] = false;
$gambar = $conn->query("SELECT gambar FROM tbl_news WHERE id = $id")->fetch_assoc()['gambar'];
if ($conn->query("DELETE FROM tbl_news WHERE id = $id")) {
    if ($gambar !== 'cryptocurrency1.jpg') {
        unlink('../../../assets/images/news/' . $gambar);
    }
    $res['success'] = true;
}

echo json_encode($res);
