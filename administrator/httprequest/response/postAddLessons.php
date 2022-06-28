<?php
require '../../../logic/dbconn.php';
require '../../../logic/functions.php';

$res['success'] = false;

$judul = htmlspecialchars($_POST['judul']);
$idSubject = htmlspecialchars($_POST['idSubject']);
$tanggal = htmlspecialchars($_POST['tanggal']);
$teks = htmlspecialchars($_POST['text']);
$gambar = 'cryptocurrency1.jpg';

// cek teks
if (strlen($judul) < 1 || strlen($teks) < 1) {
    $res['error'] = 1;
    echo json_encode($res);
    return;
}

$regexAlphaNum = '/^[a-zA-Z0-9!@#$%&*()-=+,.?\/<>\'\"; ]+$/i';
if (!preg_match($regexAlphaNum, $judul) || !preg_match($regexAlphaNum, $teks)) {
    $res['error'] = 2;
    echo json_encode($res);
    return;
}

// cek gambar
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== 4) {
    $gambar = uploadImage($_FILES['gambar'], '../../../assets/images/CuanCademy/lessons/');
    if (!$gambar['success']) {
        $res['error'] = 3;
        echo json_encode($res);
        return;
    }
    $gambar = $gambar['fileName'];
}

$judul = mysqli_real_escape_string($conn, $judul);
$idSubject = mysqli_real_escape_string($conn, $idSubject);
$tanggal = mysqli_real_escape_string($conn, $tanggal);
$teks = mysqli_real_escape_string($conn, $teks);
$gambar = mysqli_real_escape_string($conn, $gambar);

$stmtInsert = $conn->prepare("INSERT INTO tbl_lessons VALUES ('', ?, ?, ?, ?, ?)");
$stmtInsert->bind_param('issss', $idSubject, $judul, $tanggal, $gambar, $teks);
$stmtInsert->execute();

// cek apakah insert berhasil, jika gagal maka hapus gambar yang baru saja terupload
if ($conn->affected_rows === 1) {
    $res['success'] = true;
} else {
    if ($gambar !== 'cryptocurrency1.jpg') {
        unlink('assets/images/CuanCademy/lessons/' . $gambar);
    }
}

echo json_encode($res);
