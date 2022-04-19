<?php 
require 'dbconn.php';
require 'functions.php';

session_start();
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
    if (isset($_SESSION['username']) && isset($_SESSION['password']) && !isset($_SESSION['admin'])) {
        include 'pages/components/html-navbar.php';
        if (isset($_GET['page'])) {
            include 'pages/' . $_GET['page'] . '.php';
        } else {
            include 'pages/homepage.php';
        } 
        include 'pages/components/html-footer.php';
    } else isset($_SESSION['admin']) ? header("Location: index.php?page=logout") : include 'pages/login.php';
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
