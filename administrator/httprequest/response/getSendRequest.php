<?php
require '../../../logic/dbconn.php';
require '../../../logic/functions.php';

$res = [
    'success' => false,
    'msg' => 'Email gagal dikirim'
];

$requestId = htmlspecialchars(stripslashes($_GET['id']));
$requestId = mysqli_real_escape_string($conn, $requestId);

$regexNumber = '/^[0-9]$/';
if (!preg_match($regexNumber, $requestId)) {
    $res['msg'] = 'Invalid request';
    echo json_encode($res);
    return;
}

if ($conn->query("DELETE FROM tbl_lessons_request WHERE id = $requestId")) {
    $res['success'] = true;
    $res['msg'] = 'Tim akan segera mereview request tersebut';
}

echo json_encode($res);

// $request = $conn->query(
//     "SELECT r.id, r.tanggal, r.teks, s.nama_subject, u.email, u.username
//     FROM tbl_lessons_request r JOIN tbl_subject s
//     ON r.id_subject = s.id
//     JOIN tbl_users u 
//     ON r.id_user = u.id
//     WHERE r.id = $requestId
//     "
// )->fetch_assoc();

// $request['tanggal'] = tgl_indo($request['tanggal']);

// Email
// $receiver = $request['email'];
// $subject = "Lesson Request No." . $request['id'] . " for Subject : " . $request['nama_subject'];
// $body = "Dear team HitungCuan, berikut adalah request materi pada tanggal " . $request['tanggal'] . " dari " . $request['username'] . " : " . "\n" . $request['teks'];
// $sender = "From: hitungcuan@gmail.com";

// if (mail($receiver, $subject, $body, $sender)) {
//     $res['success'] = true;
//     $res['msg'] = 'Email berhasil dikirim';
//     echo json_encode($res);
// }

// echo json_encode($res);