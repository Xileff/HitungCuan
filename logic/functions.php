<?php

global $conn;

function uploadImage($image, $dir)
{
    $nameWithExtension = $image['name'];
    $size = $image['size'];
    $tmpName = $image['tmp_name'];
    $result['success'] = false;

    if ($image['error'] === 4) {
        // Gada gambar
        $result['error'] = 4;
        return $result;
    }

    if ($size > 1048576) {
        // Melebihi 1 MB
        $result['error'] = 3;
        return $result;
    }


    $nameWithExtension = explode(".", $nameWithExtension);
    $nameWithExtension = end($nameWithExtension);
    $extension = strtolower($nameWithExtension);
    $imageExtensions = ['jpg', 'png', 'jpeg'];

    if (!in_array($extension, $imageExtensions)) {
        // Format bukan gambar yang valid
        $result['error'] = 2;
        return $result;
    }

    $name = uniqid() . "." . $extension;
    if (move_uploaded_file($tmpName, $dir . $name)) {
        $result['success'] = true;
        $result['fileName'] = $name;
    }

    return $result;
}

function remember($username)
{
    global $conn;
    $user = $conn->query("SELECT id, username FROM tbl_users WHERE username = '$username'")->fetch_assoc();
    setcookie('id', $user['id'], time() + 3600);
    setcookie('key', hash('sha256', $user['username']), time() + 3600);
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function register($name, $username, $email, $password)
{
    global $conn;

    // Bersihkan tag html dan slash
    $name = htmlspecialchars(stripslashes($name));
    $username = htmlspecialchars(stripslashes($username));
    $email = htmlspecialchars(stripslashes($email));
    $password = htmlspecialchars(stripslashes($password));

    // Pastikan string dianggap sebagai string biasa dan bukan perintah sql
    $name = mysqli_real_escape_string($conn, $name);
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $dateJoined = date('Y-m-d');

    $stmtRegister = $conn->prepare("INSERT INTO tbl_users VALUES ('', ?, ?, ?, ?, '', '', 'nophoto.jpg', '$dateJoined')");
    $stmtRegister->bind_param('ssss', $name, $username, $email, $password);
    $stmtRegister->execute();
    $affectedRows = $conn->affected_rows;
    $stmtRegister->close();

    return $affectedRows;
}

function login($table, $username, $password)
{
    global $conn;
    $output = false;

    $username = htmlspecialchars(stripslashes($username));
    $password = htmlspecialchars(stripslashes($password));
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $hash = $conn->query("SELECT password FROM $table WHERE username = '$username'");
    if ($hash->num_rows == 1) {
        $output = password_verify($password, $hash->fetch_assoc()['password']);
    }

    return $output;
}

function tgl_indo($date)
{
    $months = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $dateParts = explode('-', $date);

    return $dateParts[2] . ' ' . $months[(int)$dateParts[1]] . ' ' . $dateParts[0];
}

function isPremiumUser($userId)
{
    global $conn;
    $subscriptionData = $conn->query("SELECT * FROM tbl_subscription WHERE id_user = $userId");
    $result = ['premium' => false];
    if ($subscriptionData->num_rows === 1) {
        $result['premium'] = true;
    }
    return $result;
}

function getLoggedUserData()
{
    global $conn;
    if (isset($_SESSION['username'])) {
        $user = $conn->query("SELECT email, foto, id, jenis_kelamin, nama, tgl_gabung, tgl_lahir, username FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc();
        $premium = isPremiumUser($user['id']);
        $user = array_merge($user, $premium);
        $va = $conn->query("SELECT id_packet, payment FROM tbl_virtual_account WHERE id_user = '" . $user['id'] . "'");

        return $va->num_rows === 1 ? array_merge($user, $va->fetch_assoc()) : $user;
    }
}

function hideError()
{
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
}
