<?php

require '../../logic/dbconn.php';

echo json_encode([
    's1NewestLesson' => $conn->query("SELECT id FROM lessons WHERE id_subject = 1 ORDER BY tanggal DESC LIMIT 1")->fetch_assoc()['id'],
    's2NewestLesson' => $conn->query("SELECT id FROM lessons WHERE id_subject = 2 ORDER BY tanggal DESC LIMIT 1")->fetch_assoc()['id'],
    's3NewestLesson' => $conn->query("SELECT id FROM lessons WHERE id_subject = 3 ORDER BY tanggal DESC LIMIT 1")->fetch_assoc()['id']
]);
