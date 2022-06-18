<?php
$id = $_GET['id'];

require '../../logic/dbconn.php';

$va = $conn->query("SELECT * FROM virtual_account WHERE id_user = $id");
echo json_encode($va->num_rows === 1 ? $va->fetch_assoc() : false);
