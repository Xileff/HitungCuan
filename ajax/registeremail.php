<?php 
require '../dbconn.php';
global $conn;

$requestedemail = $_GET['email'];
$email = $conn->query("SELECT email FROM admin WHERE email = '$requestedemail'");
$adminemail = $conn->query("SELECT email FROM admin WHERE email = '$requestedemail'");
?>

<?php if ((mysqli_num_rows($email) !== 0) || (mysqli_num_rows($adminemail) !== 0)):?>Email sudah digunakan<?php endif?>