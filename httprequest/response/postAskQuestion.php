<?php

session_start();
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result = ["status" => false];
$idlesson = $_POST['idlesson'];

$userId = $conn->query("SELECT id FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];
$inputQuestion = stripslashes(htmlspecialchars($_POST['question']));
$date = date('Y-m-d');

$conn->query("INSERT INTO tbl_lessons_question VALUES('', $userId, $idlesson, '$date', '$inputQuestion', 0)");

if ($conn->affected_rows === 1) {
    $result['status'] = true;
}

echo json_encode($result);
