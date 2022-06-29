<?php
require '../../logic/dbconn.php';
global $conn;

$requestedUsername = $_GET['username'];
$username = $conn->query("SELECT username FROM tbl_users WHERE username = '$requestedUsername'");
$adminUsername = $conn->query("SELECT username FROM tbl_admin WHERE username = '$requestedUsername'");
?>

<?php if ((mysqli_num_rows($username) !== 0) || (mysqli_num_rows($adminUsername) !== 0)) : ?>Username sudah digunakan<?php endif ?>