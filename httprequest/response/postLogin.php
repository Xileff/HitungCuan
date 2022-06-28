<?php
session_start();
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result = ["success" => false];
$username = stripslashes(htmlspecialchars($_POST['username']));
$password = stripslashes(htmlspecialchars($_POST['password']));

if (login('tbl_admin', $username, $password)) {
    $_SESSION['admin'] = true;
    $_SESSION['admin_username'] = $username;
    $result["success"] = true;
    $result["url"] = "?page=news";
} else if (login('tbl_users', $username, $password)) {
    $_SESSION['user'] = true;
    $_SESSION['user_username'] = $username;
    if (isset($_POST['rememberme'])) {
        $_SESSION['remember'] = true;
    }
    $result["success"] = true;
    $result["url"] = "?page=homepage";
}

echo json_encode($result);
