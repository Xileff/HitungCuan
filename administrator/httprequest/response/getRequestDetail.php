<?php

require '../../../logic/dbconn.php';
require '../../../logic/functions.php';

$res = ['success' => false];


$id = htmlspecialchars(stripslashes($_GET['id']));
$id = mysqli_real_escape_string($conn, $id);
$req = $conn->query(
    "SELECT r.id, s.nama_subject, s.id AS id_subject, r.teks 
    FROM tbl_subject s 
    JOIN tbl_lessons_request r 
    ON s.id = r.id_subject
    WHERE r.id = $id
    "
);

if ($req->num_rows == 1) {
    $res['success'] = true;
    $res['data'] = $req->fetch_assoc();
} else {
    $res['msg'] = 'Subject tidak ditemukan';
}

echo json_encode($res);
