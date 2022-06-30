<?php
require '../../logic/dbconn.php';
global $conn;

$requestedEmail = stripslashes(htmlspecialchars($_GET['email']));
$requestedEmail = mysqli_real_escape_string($conn, $requestedEmail);
$email = $conn->query("SELECT email FROM tbl_users WHERE email = '$requestedEmail'");
$adminEmail = $conn->query("SELECT email FROM tbl_admin WHERE email = '$requestedEmail'");
?>

<?php if ((mysqli_num_rows($email) !== 0) || (mysqli_num_rows($adminEmail) !== 0)) : ?>Email sudah digunakan<?php endif ?>