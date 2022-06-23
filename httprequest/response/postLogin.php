<?php
session_start();
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result = ["success" => false];
$username = stripslashes(htmlspecialchars($_POST['username']));
$password = stripslashes(htmlspecialchars($_POST['password']));

if (login('admin', $username, $password)) {
    $_SESSION['admin'] = true;
    $_SESSION['username'] = $username;
    $result["success"] = true;
    $result["url"] = "?page=news&action=none";
} else if (login('users', $username, $password)) {
    $_SESSION['user'] = true;
    $_SESSION['username'] = $username;
    if (isset($_POST['rememberme'])) {
        $_SESSION['remember'] = true;
    }
    $result["success"] = true;
    $result["url"] = "?page=homepage";
}

echo json_encode($result);
