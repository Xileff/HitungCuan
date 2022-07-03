<?php
require 'logic/dbconn.php';
require 'logic/functions.php';
session_start();
// clearPdfRevenue();
// clearPdfTransaction();
hideError();

// remember jika ketika login pilih rememberme
if (isset($_SESSION['user']) && isset($_SESSION['remember'])) {
    remember($_SESSION['username']);
}

// verifikasi remember setelah browser ditutup
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    global $conn;
    $id = $_COOKIE['id'];

    $remembered_user = $conn->query("SELECT id, username FROM tbl_users WHERE id = $id")->fetch_assoc();

    if (hash('sha256', $remembered_user['username']) === $_COOKIE['key']) {
        $_SESSION['user'] = true;
        $_SESSION['username'] = $remembered_user['username'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Swal -->
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui@4/material-ui.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Swal custom -->
    <script src="assets/js/swal.js"></script>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/hitungcuan.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="assets/favicon.ico" />
    <title>HitungCuan</title>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="100vh">
    <?php
    // Admin UI
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
        include 'components/html-adminnavbar.php';
        $page = $_GET['page'];
        if (in_array($page, ['feedback', 'lessons', 'logout', 'news', 'questions', 'users', 'revenue', 'lessonrequest'])) {
            include 'administrator/' . $page . '.php';
        } else {
            header("Location: ./?page=news");
        }
    }

    // User UI
    else {
        // cek subscription user, sebelum render halaman
        if (isset($_SESSION['username'])) {
            $userId = $conn->query("SELECT id FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];

            // Jika ada subscription, cek apakah masanya habis
            $subscription = $conn->query("SELECT * FROM tbl_subscription WHERE id_user = $userId");
            if ($subscription->num_rows === 1) {
                $subsExpireDate = $conn->query("SELECT expire_date FROM tbl_subscription WHERE id_user = $userId")->fetch_assoc()['expire_date'];

                if ($subsExpireDate === date('Y-m-d')) {
                    $conn->query("DELETE FROM tbl_subscription WHERE id_user = $userId");
                }
            }
        }

        // render halaman
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $accountMgmt = ['login', 'logout', 'register'];
            $regularPages = ['aboutus', 'cuancademy', 'homepage', 'lesson', 'news', 'newscontent', 'simulasinabung', 'userprofile', 'subscribe', 'virtualaccount', 'subscribe', ''];

            if (in_array($page, $accountMgmt)) {
                include $page . '.php';
            }
            // tambahin in array buat else yg ini
            else if (in_array($page, $regularPages)) {
                include 'components/html-navbar.php';
                include $page . '.php';
                include 'components/html-footer.php';
            } else {
                header("Location: ./");
            }
        } else {
            include 'components/html-navbar.php';
            include 'homepage.php';
            include 'components/html-footer.php';
        }
    }
    ?>

    <?php include 'components/html-top.php' ?>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<script src="httprequest/request/getTransactionPdf.js" type="module"></script>