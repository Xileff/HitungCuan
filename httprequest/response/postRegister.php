<?php

require '../../logic/dbconn.php';
require '../../logic/functions.php';

$fullName = stripslashes(htmlspecialchars($_POST['nama']));
$username = stripslashes(htmlspecialchars($_POST['username']));
$email = stripslashes(htmlspecialchars($_POST['email']));
$password = stripslashes(htmlspecialchars($_POST['password']));
$confirmPassword = stripslashes(htmlspecialchars($_POST['confirmPassword']));

$res = ['success' => false];

$regexName = '/^[A-Za-z\s]+$/i';
$regexUsername = '/^[a-z0-9_]+$/i';

// validasi input
if (!preg_match($regexName, $fullName)) {
    $res['msg'] = 'Nama tidak valid';
    echo json_encode($res);
    return;
}

if (!preg_match($regexUsername, $username)) {
    $res['msg'] = 'Username tidak valid';
    echo json_encode($res);
    return;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $res['msg'] = 'Email tidak valid';
    echo json_encode($res);
    return;
}

if (strlen($password) < 8 || strlen($password) > 16) {
    $res['msg'] = 'Password harus sepanjang 8-16 karakter';
    echo json_encode($res);
    return;
}

if ($password !== $confirmPassword) {
    $res['msg'] = 'Password tidak sama dengan konfirmasi password';
    echo json_encode($res);
    return;
}

$fullName = mysqli_real_escape_string($conn, $fullName);
$username = mysqli_real_escape_string($conn, $username);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

// Cek apakah sudah ada akun user/admin dengan username ini
$existingUser = $conn->query("SELECT * FROM tbl_users WHERE username = '$username' OR email = '$email';");
$existingAdmin = $conn->query("SELECT * FROM tbl_admin WHERE username = '$username' OR email = '$email'");

if ($existingUser->num_rows !== 0 || $existingAdmin->num_rows !== 0) {
    $res['msg'] = 'Username sudah digunakan oleh akun lain';
    echo json_encode($res);
    return;
}

// Jika sudah aman, maka daftarkan akun dan cek apakah berhasil
if (register($fullName, $username, $email, $password) == 1) {
    $res['success'] = true;
} else {
    $res['msg'] = 'Kesalahan server, akun gagal didaftarkan. Silakan coba lagi nanti';
}

echo json_encode($res);
