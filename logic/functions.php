<?php

global $conn;

function uploadImage($image, $dir)
{
    $nameWithExtension = $image['name'];
    $size = $image['size'];
    $tmpName = $image['tmp_name'];
    $result = false;

    if ($image['error'] === 4) {
        alertRedirect('Error', 'Tidak ada gambar yang diupload', '', 'Ok');
        return $result;
    }

    if ($size > 1048576) {
        alertRedirect('Error', 'Ukuran melebihi 1MB!', '', 'Ok');
        return $result;
    }

    $extension = strtolower(end(explode(".", $nameWithExtension)));
    $imageExtensions = ['jpg', 'png', 'jpeg'];

    if (!in_array($extension, $imageExtensions)) {
        alertRedirect('Error', 'File bukan gambar!', '', 'Ok');
        return $result;
    }

    $name = uniqid() . "." . $extension;
    if (move_uploaded_file($tmpName, $dir . $name)) {
        $result = $name;
    }

    return $result;
}

function remember($username)
{
    global $conn;
    $user = $conn->query("SELECT id, username FROM users WHERE username = '$username'")->fetch_assoc();
    setcookie('id', $user['id'], time() + 3600);
    setcookie('key', hash('sha256', $user['username']), time() + 3600);
}

function alertError($heading, $message, $button)
{
    echo "
    <script>
        alertError('$heading', '$message', '$button');
    </script>";
    return false;
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function alertErrorRefresh($heading, $message, $button)
{
    echo "
    <script>
        alertErrorRefresh('$heading', '$message', '$button');
    </script>";
    return false;
}

function alertSuccess($heading, $message, $button)
{
    echo "
    <script>
        alertSuccess('$heading', '$message', '$button');
    </script>";
    return false;
}

function alertRedirect($title, $text, $link, $confirmButtonText)
{
    echo "
    <script>
        alertRedirect('$title', '$text', '$link', '$confirmButtonText');
    </script>
    ";
}

function register($name, $username, $email, $password)
{
    global $conn;

    $name = htmlspecialchars($name);
    $username = htmlspecialchars($username);
    $email = htmlspecialchars($email);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users VALUES ('','$name','$username','$email','$password','','','nophoto.jpg','" . date('Y-m-d') . "')");

    return $conn->affected_rows;
}

function login($table, $username, $password)
{
    global $conn;
    $hash = $conn->query("SELECT password FROM $table WHERE username = '$username'");
    return ($hash->num_rows === 1) ? password_verify($password, $hash->fetch_assoc()['password']) : false;
}

function refresh($delay = 0)
{
    header("refresh:$delay; url=" . $_SERVER['REQUEST_URI']);
}

function delayedRedirect($url, $delay = 0)
{
    header("refresh:$delay; url=$url");
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
    $subscriptionData = $conn->query("SELECT * FROM subscription WHERE id_user = $userId")->num_rows;

    return $subscriptionData === 1 ? true : false;
}

function getLoggedUserData()
{
    global $conn;
    if (isset($_SESSION['username'])) {
        $user = $conn->query("SELECT email, foto, id, jenis_kelamin, nama, tgl_gabung, tgl_lahir, username FROM users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc();
        $va = $conn->query("SELECT id_packet, payment FROM virtual_account WHERE id_user = '" . $user['id'] . "'");

        $result = $va->num_rows === 1 ? array_merge($user, $va->fetch_assoc()) : $user;
        return $result;
    }
}

function getVa()
{
    global $conn;
    if (isset($_SESSION['username'])) {
        return $conn->query("SELECT * FROM virtual_account WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc();
    } else return false;
}

function hideError()
{
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
}
