<?php

require '../../logic/dbconn.php';

$kw = $_GET['kw'];
$lessons = $conn->query("SELECT id, id_subject, judul FROM lessons WHERE judul LIKE '%$kw%'");
$result = [];
while ($lesson = $lessons->fetch_assoc()) {
    $result[] = $lesson;
}

echo json_encode($result);
