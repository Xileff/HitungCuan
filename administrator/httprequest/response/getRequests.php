<?php

require '../../../logic/dbconn.php';
require '../../../logic/functions.php';

$subjectId = stripslashes(htmlspecialchars($_GET['subjectId']));
$sort = stripslashes(htmlspecialchars($_GET['sort']));

$validSubjectId = [0, 1, 2, 3];
$validSort = ['asc', 'desc'];

$res = [
    'success' => false
];

if (!in_array($subjectId, $validSubjectId)) {
    $res['msg'] = 'Subject tidak valid';
    echo json_encode($res);
}

if (!in_array($sort, $validSort)) {
    $res['msg'] = 'Sort tidak valid';
    echo json_encode($res);
}

$subjectId = mysqli_real_escape_string($conn, $subjectId);
$sort = mysqli_real_escape_string($conn, $sort);

$requests = $conn->query(
    "SELECT r.id, u.username, s.nama_subject, r.tanggal 
    FROM tbl_lessons_request r
    JOIN tbl_users u
    ON r.id_user = u.id
    JOIN tbl_subject s
    ON r.id_subject = s.id 
    " . ($subjectId == 0 ? '' : " WHERE id_subject = $subjectId") . "
    ORDER BY tanggal $sort"
);

while ($req = $requests->fetch_assoc()) {
    $req['tanggal'] = tgl_indo($req['tanggal']);
    $res['requests'][] = $req;
}

$res['success'] = true;
echo json_encode($res);
