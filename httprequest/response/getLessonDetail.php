<?php
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$idsubject = $_GET['subject'];
$idlesson = $_GET['idlesson'];

$thisLesson = $conn->query("SELECT * FROM lessons WHERE id = $idlesson AND id_subject = $idsubject");

$result = ['success' => false];

if ($thisLesson->num_rows === 1) {
    $result['success'] = true;
    $result['data'] = $thisLesson->fetch_assoc();
    $result['data']['tanggal'] = tgl_indo($result['data']['tanggal']);
}

echo json_encode($result);
