<?php

require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result['success'] = false;

$kw = $_GET['kw'];
$idSubject = $_GET['idSubject'];
$lessons;
if ($kw == '*') {
    $lessons = $conn->query("SELECT id, id_subject, judul FROM tbl_lessons WHERE id_subject = $idSubject");
} else {
    $lessons = $conn->query(
        "SELECT id, id_subject, judul FROM tbl_lessons WHERE id_subject = $idSubject AND judul LIKE '%$kw%'"
    );
}

if ($lessons->num_rows > 0) {
    $result['success'] = true;
    $subjectName = $conn->query("SELECT nama_subject FROM tbl_subject WHERE id = $idSubject")->fetch_assoc()['nama_subject'];

    $result['lessonName'] = $subjectName;
    while ($lesson = $lessons->fetch_assoc()) {
        $result['lessons'][] = $lesson;
    }
}

echo json_encode($result);
