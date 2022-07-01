<?php
require '../../logic/dbconn.php';
session_start();

$result = [
    'success' => false,
    'msg' => 'Gagal mengupload feedback anda'
];
//0. belum login, 1. gagal, 2. berhasil
if (!isset($_SESSION['username'])) {
    $result['msg'] = 'Login terlebih dahulu sebelum memberikan feedback';
    return;
}

$teksFeedback = $_POST['teksFeedback'];
$user = $conn->query("SELECT id, username FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc();

// Prepared stmt
$userId = $user['id'];
$username = $user['username'];
$date = date('Y-m-d');
$teksFeedback = mysqli_real_escape_string($conn, $teksFeedback);

$stmtFeedback = $conn->prepare("INSERT INTO tbl_feedback VALUES('', $userId, '$username', '$date', ?)");
$stmtFeedback->bind_param('s', $teksFeedback);
$stmtFeedback->execute();

if ($conn->affected_rows == 1) {
    $result['success'] = true;
}

echo json_encode($result);
