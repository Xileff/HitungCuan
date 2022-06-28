<?php
require '../../../logic/dbconn.php';
require '../../../logic/functions.php';

$res['success'] = false;

$id = htmlspecialchars($_POST['id']);
$judul = htmlspecialchars($_POST['judul']);
$idSubject = htmlspecialchars($_POST['idSubject']);
$tanggal = htmlspecialchars($_POST['tanggal']);
$teks = htmlspecialchars($_POST['text']);
$oldGambar = $conn->query("SELECT gambar FROM tbl_lessons WHERE id = $id")->fetch_assoc()['gambar'];

// cek teks
if (strlen($judul) < 1 || strlen($teks) < 1) {
    $res['error'] = 1;
    echo json_encode($res);
    return;
}

$regexAlphaNum = '/^[a-zA-Z0-9!@#$%&*()-=+,.?\/<>\'\"; ]+$/i';
if (!preg_match($regexAlphaNum, $judul)) {
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
    if ($oldGambar !== 'cryptocurrency1.jpg') {
        unlink('../../../assets/images/CuanCademy/lessons/' . $oldGambar);
    }
    $gambar = $gambar['fileName'];
} else {
    $gambar = $oldGambar;
}

$id = mysqli_real_escape_string($conn, $id);
$judul = mysqli_real_escape_string($conn, $judul);
$idSubject = mysqli_real_escape_string($conn, $idSubject);
$tanggal = mysqli_real_escape_string($conn, $tanggal);
$teks = mysqli_real_escape_string($conn, $teks);
$gambar = mysqli_real_escape_string($conn, $gambar);

$stmtInsert = $conn->prepare(
    "UPDATE tbl_lessons SET 
    judul = ?, 
    id_subject = ?,
    tanggal = ?, 
    gambar = ?, 
    teks = ?

    WHERE id = ?"
);
$stmtInsert->bind_param('sisssi', $judul, $idSubject, $tanggal, $gambar, $teks, $id);
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
