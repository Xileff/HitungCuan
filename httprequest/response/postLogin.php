<?php

use LDAP\Result;

require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result = [];

if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
    // header("Location: ./");
}

if (isset($_POST["login"])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (login('admin', $username, $password)) {
        $_SESSION['admin'] = true;
        $_SESSION['username'] = $username;

        $result['success'] = true;
        $result['url'] = './?page=news&action=none';
    } else if (login('users', $username, $password)) {
        $_SESSION['user'] = true;
        $_SESSION['username'] = $username;
        if (isset($_POST['rememberme'])) {
            $_SESSION['remember'] = true;
        }

        $result['success'] = true;
        $result['url'] = './?page=homepage';
    } else {
        $result['success'] = false;
    }

    echo json_encode($result);
}
