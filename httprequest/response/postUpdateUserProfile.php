<?php
session_start();
require '../../logic/dbconn.php';
require '../../logic/functions.php';

$result['success'] = false;
$user = $conn->query("SELECT id, foto FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc();

// Prepare sql
$stmt = $conn->prepare("UPDATE tbl_users SET 
                        nama = ?,
                        tgl_lahir = ?,
                        jenis_kelamin = ?,
                        foto = ?
                        WHERE id 
                        = " . $user['id']);

$stmt->bind_param('ssss', $nama, $tanggalLahir, $gender, $gambar);

// Input
$nama = htmlspecialchars(stripslashes(trim($_POST['nama'])));
$gender = htmlspecialchars(stripslashes(trim($_POST['radioGender'])));
$tanggalLahir = htmlspecialchars(stripslashes(trim($_POST['tanggalLahir'])));
$gambar = "";
$gambarLama = $user['foto'];

if (!preg_match('/^[a-z ]+$/i', $nama)) {
    echo json_encode($result);
    return;
}

// Proses foto
if ($_FILES['gambar']['error'] == 4) {
    $gambar = $gambarLama;
} else {
    $gambar = uploadImage($_FILES['gambar'], '../../assets/images/users-profile/');
    if (!$gambar['success']) {
        $result['imageError'] = $gambar['error'];
        // 4. gada gambar
        // 3. melebihi 1 MB
        // 2. format bukan gambar
        echo json_encode($result);
        return;
    }
    $gambar = $gambar['fileName'];
    unlink('../../assets/images/users-profile/' . $gambarLama);
}

$stmt->execute();
if ($conn->affected_rows == 1) {
    $result['success'] = true;
}
echo json_encode($result);
