<?php
require '../../../logic/dbconn.php';
require '../../../logic/functions.php';

$res = [];
$feedback = $conn->query("SELECT * FROM tbl_feedback");
while ($f = $feedback->fetch_assoc()) {
    $f['tanggal'] = tgl_indo($f['tanggal']);
    $res[] = $f;
}

echo json_encode($res);
