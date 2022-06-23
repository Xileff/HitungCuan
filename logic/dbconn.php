<?php
$servername = "localhost";
$user = "root";
$password = "";
$db = "20212_wp2_412020015";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($servername, $user, $password, $db);
$conn->set_charset('utf8mb4');
