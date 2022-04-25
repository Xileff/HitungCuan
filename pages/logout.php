<?php 

session_start();
$_SESSION = [];
session_unset();
session_destroy();
setcookie('id', 'id', time() - 3600);
setcookie('key', 'key', time() - 3600);
header("Location: index.php");

?>