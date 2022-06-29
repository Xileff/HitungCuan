<?php
require '../../logic/dbconn.php';
global $conn;

$requestedemail = $_GET['email'];
$email = $conn->query("SELECT email FROM tbl_admin WHERE email = '$requestedemail'");
$adminemail = $conn->query("SELECT email FROM tbl_admin WHERE email = '$requestedemail'");
?>

<?php if ((mysqli_num_rows($email) !== 0) || (mysqli_num_rows($adminemail) !== 0)) : ?>Email sudah digunakan<?php endif ?>