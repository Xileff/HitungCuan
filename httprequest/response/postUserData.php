<?php
session_start();

require '../../logic/dbconn.php';
require '../../logic/functions.php';
echo json_encode(getLoggedUserData());
