<?php
require '../../../logic/dbconn.php';
$id = $_GET['id'];
$lesson = $conn->query("SELECT judul, id_subject, tanggal, gambar, teks FROM tbl_lessons WHERE id = $id")->fetch_assoc();
echo json_encode($lesson);
