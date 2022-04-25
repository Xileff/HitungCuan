<?php 
require 'dbconn.php';
require 'functions.php';
session_start();

// setcookie jika ketika login pilih rememberme dan belum ada cookie
isset($_SESSION['remember']) && isset($_SESSION['user']) ? remember($_SESSION['username']) : '';

// verifikasi remember setelah browser ditutup
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    global $conn;
    $id = $_COOKIE['id'];

    $remembered_user = $conn->query("SELECT id, username FROM users WHERE id = $id")->fetch_assoc();

    if(hash('sha256', $remembered_user['username']) === $_COOKIE['key']) {
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
    <script src="js/swal.js"></script>    

    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/hitungcuan.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="logo.png"/>
    <title>
        <?php
            if(isset($_GET['page'])){
                echo $_GET['page'];
            }
            else {
                echo 'HitungCuan';
            }
        ?>
    </title>
</head>
<body>
    <?php 
    if (isset($_SESSION['admin'])) {
        $_GET['page'] === 'logout' ? include 'pages/logout.php' : include 'pages/admin/admin.php';
    } 
    
    else {
        if(isset($_GET['page']) && ($_GET['page'] === 'login')) {
            include 'pages/login.php';
        }
        
        else if (isset($_GET['page']) && $_GET['page'] !== '') {
            renderPage($_GET['page'], 'user');
        }

        else {
            include 'pages/components/html-navbar.php';
            include 'pages/homepage.php';
            include 'pages/components/html-footer.php';
        }
    }

    ?>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>