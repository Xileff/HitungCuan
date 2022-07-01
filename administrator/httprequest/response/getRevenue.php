<?php

require '../../../logic/dbconn.php';
require '../../../logic/functions.php';

$res = ['success' => false];

// id, id paket,  ama paket, nominal
$dateBegin = htmlspecialchars(stripslashes($_GET['begin']));
$dateEnd = htmlspecialchars(stripslashes($_GET['end']));
$limit = htmlspecialchars(stripslashes($_GET['limit']));
$selectOrder = htmlspecialchars(stripslashes($_GET['order']));

$dateBegin = mysqli_real_escape_string($conn, $dateBegin);
$dateEnd = mysqli_real_escape_string($conn, $dateEnd);
$limit = mysqli_real_escape_string($conn, $limit);
$selectOrder = mysqli_real_escape_string($conn, $selectOrder);

$regexDate = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
if (!preg_match($regexDate, $dateBegin) || !preg_match($regexDate, $dateEnd)) {
    $res['msg'] = 'Format tanggal tidak benar';
    echo json_encode($res);
    return;
}

if (!in_array($selectOrder, ['asc', 'desc'])) {
    $res['msg'] = 'Input tidak valid';
    echo json_encode($res);
    return;
}

$strSql = "SELECT r.id, p.id AS id_paket, p.nama, r.tanggal, r.nominal 
FROM tbl_revenue r 
JOIN tbl_packet p 
ON r.id_packet = p.id 
WHERE r.tanggal >= '$dateBegin' AND r.tanggal <= '$dateEnd'  
ORDER BY r.tanggal $selectOrder
LIMIT $limit;";

$res['success'] = true;
$res['data'] = [];
$revenue = $conn->query($strSql);
$res['total'] = 0;
while ($rev = $revenue->fetch_assoc()) {
    $rev['tanggal'] = tgl_indo($rev['tanggal']);
    $res['total'] += $rev['nominal'];
    $rev['nominal'] = rupiah($rev['nominal']);
    $res['data'][] = $rev;
}

echo json_encode($res);
