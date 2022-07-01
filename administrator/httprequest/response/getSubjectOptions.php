<?php
require '../../../logic/dbconn.php';
$list = $conn->query("SELECT * FROM tbl_subject");
$response = [];
while ($l = $list->fetch_assoc()) {
    $response[] = $l;
}
echo json_encode($response);
