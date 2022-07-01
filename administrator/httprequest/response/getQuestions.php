<?php
require '../../../logic/dbconn.php';
require '../../../logic/functions.php';
$subjectId = $_GET['subjectId'];

// Mengambil pertanyaan yang belum terjawab berdasarkan id_subject
$questions = $conn->query(
    "SELECT q.id, u.username, l.judul AS lesson, q.tanggal, s.nama_subject AS subject
    FROM `tbl_lessons_question` q
    LEFT JOIN tbl_lessons l
    ON q.id_lesson = l.id
    LEFT JOIN tbl_users u
    ON q.id_user = u.id
    LEFT JOIN tbl_subject s
    ON l.id_subject = s.id
    WHERE " . ($subjectId != -1 ? " s.id = $subjectId AND " : "")  . " q.answered = 0;"
);

$res = [];
while ($q = $questions->fetch_assoc()) {
    $q['tanggal'] = tgl_indo($q['tanggal']);
    $res[] = $q;
}
echo json_encode($res);
