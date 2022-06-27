<?php

require '../../../logic/dbconn.php';
$res = [];
$authors = $conn->query("SELECT id, nama FROM tbl_author");
while ($a = $authors->fetch_assoc()) {
    $res[] = $a;
}
echo json_encode($res);
