<?php
session_start();
require '../../logic/dbconn.php';

$res['success'] = 0;

$idUser = $conn->query("SELECT id FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];
$idSubject = stripslashes(htmlspecialchars($_POST['subject']));
$text = stripslashes(htmlspecialchars($_POST['text']));

if (!in_array($idSubject, [1, 2, 3])) {
    $res['msg'] = 'Subject harus termasuk di antara Income Management, Expense Management, atau Investment';
    echo json_encode($res);
    return;
}

if (strlen($text) > 255) {
    $res['msg'] = 'Request maksimal 255 karakter';
    echo json_encode($res);
    return;
}

$stmtRequest = $conn->prepare("INSERT INTO tbl_lessons_request VALUES ('', ?, ?, ?, ?)");
$idSubject = mysqli_real_escape_string($conn, $idSubject);
$text = mysqli_real_escape_string($conn, $text);
$date = date('Y-m-d');

$stmtRequest->bind_param('iiss', $idUser, $idSubject, $date, $text);
$stmtRequest->execute();
$res['success'] = $conn->affected_rows;
$stmtRequest->close();
echo json_encode($res);
