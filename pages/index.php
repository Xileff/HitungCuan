<?php 

session_start();

if(!isset($_SESSION["login"])){
    header("Location: homepage.php");
    exit;
}

if(isset($_SESSION["admin"])){
    header("Location: admin.php");
}

else if(isset($_SESSION["user"])){
    header("Location: homepage.php");
}

?>