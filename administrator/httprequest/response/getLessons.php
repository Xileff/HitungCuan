<?php
require '../../../logic/dbconn.php';
require '../../../logic/functions.php';
$lessons = [];
$kw = $_GET['kw'];
if ($kw == "*") {
    $lessons = $conn->query(
        "SELECT l.id, l.judul, s.nama_subject AS subject, l.tanggal
        FROM tbl_lessons l LEFT JOIN tbl_subject s
        ON l.id_subject = s.id
        "
    );
} else {
    $lessons = $conn->query(
        "SELECT l.id, l.judul, s.nama_subject AS subject, l.tanggal
        FROM tbl_lessons l LEFT JOIN tbl_subject s
        ON l.id_subject = s.id
        WHERE l.judul LIKE '%$kw%'
        "
    );
}

$res = [];
while ($l = $lessons->fetch_assoc()) {
    $l['tanggal'] = tgl_indo($l['tanggal']);
    $res[] = $l;
}
echo json_encode($res);
