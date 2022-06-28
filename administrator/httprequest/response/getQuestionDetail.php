<?php
require '../../../logic/dbconn.php';
require '../../../logic/functions.php';
$id = $_GET['id'];

$question = $conn->query(
    "SELECT q.id, u.username, l.judul, q.tanggal, q.teks FROM tbl_lessons_question q
    LEFT JOIN tbl_users u ON q.id_user = u.id 
    LEFT JOIN tbl_lessons l ON q.id_lesson = l.id 
    WHERE q.id = $id;
    "
)->fetch_assoc();
$question['tanggal'] = tgl_indo($question['tanggal']);
echo json_encode($question);
