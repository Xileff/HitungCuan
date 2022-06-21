<?php

require '../../logic/dbconn.php';
require '../../logic/functions.php';

// if(isset($_POST['submit']) && $_POST['submit'] === 'pay'){
//     // insert ke tabel subscription
//     $today = date('Y-m-d');
//     $expireDate;
//     switch($idPacket){
//         case 1:
//             $expireDate = date('Y-m-d', strtotime('+ 365 days'));
//             break;
//         case 2:
//             $expireDate = date('Y-m-d', strtotime('+ 180 days'));
//             break;
//         case 3:
//             $expireDate = date('Y-m-d', strtotime('+ 90 days'));
//             break;
//         }

//     $conn->query("DELETE FROM virtual_account WHERE id_user = $userId");
//     if($conn->affected_rows !== 1){
//         alertRedirect('Kesalahan server', 'Silakan coba lagi', $_RVER['REQUEST_URI'] ,'Ok');
//         return;
//     }

//     $conn->query("INSERT INTO subscription VALUES('', $idPacket, $userId, '$expireDate')");
//     if($conn->affected_rows !== 1){
//         alertRedirect('Kesalahan server', 'Silakan coba lagi', $_SERVER['REQUEST_URI'] ,'Ok');
//         return;
//     }

//     $conn->query("INSERT INTO revenue VALUES('', $idPacket, '$today', " . $packet['harga'] .")");
//     if($conn->affected_rows !== 1){
//         alertRedirect('Kesalahan server', 'Silakan coba lagi', $_SERVER['REQUEST_URI'] ,'Ok');
//         return;
//     }
//     alertRedirect('Berhasil', 'Anda sudah menjadi member, redirecting', './','Ok');
// }
// else if(isset($_POST['submit']) && $_POST['submit'] === 'cancel') {
//     $conn->query("DELETE FROM virtual_account WHERE id_user = $userId");
//     if($conn->affected_rows === 1){
//         alertRedirect('Transaksi dibatalkan', 'Kembali ke halaman utama', './', 'Ok');
//         return;
//     }
//     else {
//         alertRedirect('Kesalahan server', 'Silakan coba lagi', './', 'Ok');
//     }
// }
