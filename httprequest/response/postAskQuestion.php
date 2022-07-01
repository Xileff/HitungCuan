<?php

session_start();
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result = [
    "success" => false,
    "msg" => "Gagal mengupload pertanyaan, silakan coba lagi"
];
$idlesson = $_POST['idlesson'];
$inputQuestion = stripslashes(htmlspecialchars($_POST['question']));
$userId = $conn->query("SELECT id FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];
$date = date('Y-m-d');

// Prepared stmt
$inputQuestion = mysqli_real_escape_string($conn, $inputQuestion);
$stmtQuestion = $conn->prepare("INSERT INTO tbl_lessons_question VALUES('', $userId, ?, '$date', ?, 0)");
$stmtQuestion->bind_param('is', $idlesson, $inputQuestion);
$stmtQuestion->execute();

if ($conn->affected_rows === 1) {
    $result['success'] = true;
}

echo json_encode($result);
