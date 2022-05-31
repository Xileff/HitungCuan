<?php 
require 'logic/dbconn.php';
require 'logic/functions.php';
session_start();

// remember jika ketika login pilih rememberme
if(isset($_SESSION['user']) && isset($_SESSION['remember'])){
    remember($_SESSION['username']);
}

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
    <script src="assets/js/swal.js"></script>    

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/hitungcuan.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
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
    // Admin UI
    if (isset($_SESSION['admin'])) {
        include 'components/html-adminnavbar.php';

        $page = $_GET['page'];
        $action = isset($_GET['action']) ? $_GET['action'] : 'none';
        switch ($page) {
            case 'users':
                include 'administrator/users.php';
                break;

            case 'feedback':
                include 'administrator/feedback.php';
                break;

            case 'lessons':
                switch($action){
                    case 'none':
                        include 'administrator/lessons.php';
                        break;
                    case 'addlessons':
                        include 'administrator/crud/addlessons.php';
                        break;
                    case 'editlessons':
                        include 'administrator/crud/editlessons.php';
                        break;
                    case 'deletelessons':
                        include 'administrator/crud/deletelessons.php';
                        break;
                }
                break;

            case 'news':
                switch($action){
                    case 'none':
                        include 'administrator/news.php';
                        break;
                    case 'addnews':
                        include 'administrator/crud/addnews.php';
                        break;
                    case 'editnews':
                        include 'administrator/crud/editnews.php';
                        break;
                    case 'deletenews':
                        include 'administrator/crud/deletenews.php';
                        break;
                }
                break;
                
            case 'logout':
                include 'logout.php';
                break;

            default:
                include 'administrator/news.php';
                break;
        }
    } 
    
    // User UI
    else {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
            switch($page){
                case 'login':
                    include 'login.php';
                    break;
                case 'logout':
                    include 'logout.php';
                    break;
                case 'register':
                    include 'register.php';
                    break;
                default:
                    include 'components/html-navbar.php';
                    include $page . '.php';
                    include 'components/html-footer.php';
            }
        }

        else {
            include 'components/html-navbar.php';
            include 'homepage.php';
            include 'components/html-footer.php';
        }
    }
    ?>

    <?php include 'components/html-top.php'?>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>