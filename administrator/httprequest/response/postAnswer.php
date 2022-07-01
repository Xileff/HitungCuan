<?php
session_start();
require '../../../logic/dbconn.php';

// Cek validitas pertanyaan
$questionId = stripslashes(htmlspecialchars($_POST['questionId']));
$question = $conn->query("SELECT id, answered FROM tbl_lessons_question WHERE id = $questionId");
if ($question->num_rows != 1) {
    $res['msg'] = "Tidak ditemukan pertanyaan dengan id $questionId";
    echo json_encode($res);
    return;
}

if ($question->fetch_assoc()['answered']) {
    $res['msg'] = "Pertanyaan $questionId sudah dijawab";
    echo json_encode($res);
    return;
}

// Siapin sql statmnt buat answer
$res['success'] = false;
$answer = stripslashes(htmlspecialchars($_POST['answer']));
$stmtInsertAnswer = $conn->prepare("INSERT INTO tbl_lessons_question_answer VALUES('', ?, ?, ?, ?)");

$idAdmin = $conn->query("SELECT id FROM tbl_admin WHERE username = '" . $_SESSION['admin_username'] . "'")->fetch_assoc()['id'];
$date = date('Y-m-d');

// insert answer
$questionId = mysqli_real_escape_string($conn, $questionId);
$idAdmin = mysqli_real_escape_string($conn, $idAdmin);
$date = mysqli_real_escape_string($conn, $date);
$answer = mysqli_real_escape_string($conn, $answer);
$stmtInsertAnswer->bind_param('iiss', $questionId, $idAdmin, $date, $answer);
$stmtInsertAnswer->execute();

// klo berhasil uplaod jawaban, update status pertanyaan mjd answered = true
if ($conn->affected_rows !== 1) {
    $res['msg'] = 'Kesalahan server';
    echo json_encode($res);
    return;
}

$conn->query("UPDATE tbl_lessons_question SET answered = 1 WHERE id = $questionId");
$res['success'] = true;
$res['msg'] = 'Pertanyaan sudah dijawab';
echo json_encode($res);
