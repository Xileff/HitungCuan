<?php
session_start();
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result['code'] = 0;
// 0. belum login, 1. bukan premium, 2. premium
if (isset($_SESSION['username'])) {
    $user = getLoggedUserData();
    if (isPremiumUser($user['id'])['premium']) {
        $result['code'] = 2;
    } else {
        $result['code'] = 1;
    }
}

echo json_encode($result);
