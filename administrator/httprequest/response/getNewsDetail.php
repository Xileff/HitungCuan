<?php
require '../../../logic/dbconn.php';
$id = $_GET['id'];
echo json_encode($conn->query("SELECT * FROM tbl_news WHERE id = $id")->fetch_assoc());
