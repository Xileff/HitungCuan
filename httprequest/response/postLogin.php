<?php
session_start();
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result = [
    "success" => false,
    "msg" => "Username atau password salah"
];

// Validasi input
$username = stripslashes(htmlspecialchars($_POST['username']));
$password = stripslashes(htmlspecialchars($_POST['password']));

$regexUsername = '/^[a-z0-9]+$/i';
if (!preg_match($regexUsername, $username)) {
    $res['msg'] = 'Username tidak valid';
    echo json_encode($res);
    return;
}

if (strlen($password) < 8 || strlen($password) > 16) {
    $res['msg'] = 'Password harus sepanjang 8-16 karakter';
    echo json_encode($res);
    return;
}

if (login('tbl_admin', $username, $password)) {
    $_SESSION['admin'] = true;
    $_SESSION['admin_username'] = $username;
    $result["success"] = true;
    $result["url"] = "?page=news";
} else if (login('tbl_users', $username, $password)) {
    $_SESSION['user'] = true;
    $_SESSION['username'] = $username;
    if (isset($_POST['rememberme'])) {
        $_SESSION['remember'] = true;
    }
    $result["success"] = true;
    $result["url"] = "?page=homepage";
}

echo json_encode($result);
