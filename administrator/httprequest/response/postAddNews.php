<?php
require '../../../logic/dbconn.php';
require '../../../logic/functions.php';
$res['success'] = false;
// Error list
// 1. Penulis kosong
// 2. Tidak lolos regex
// 3. Penulis sudah ada di sistem
// 4. Gagal upload gambar
// 5. Kesalahan server

// ambil nilai
$judul = htmlspecialchars($_POST['judul']);
$idAuthor;
$releaseDate = htmlspecialchars($_POST['releaseDate']);
$text = htmlspecialchars($_POST['text']);
$image = 'cryptocurrency1.jpg';

$regexAlpha = '/^[A-Za-z]+$/i';
$regexAlphaNum = '/^[a-zA-Z0-9 ]+$/i';
if (!preg_match($regexAlphaNum, $judul)) {
    $res['error'] = 2;
    echo json_encode($res);
    return;
}

// set nilai id penulis
if (isset($_POST['newAuthor'])) {
    $stmtPenulisBaru = $conn->prepare("INSERT INTO tbl_author VALUES ('', ?)");
    $firstName = ucfirst(strtolower(htmlspecialchars($_POST['firstName'])));
    $lastName = ucfirst(strtolower(htmlspecialchars($_POST['lastName'])));

    if (strlen($firstName) < 1 || strlen($lastName) < 1) {
        $res['error'] = 1;
        echo json_encode($res);
        return;
    }

    if (!preg_match($regexAlpha, $firstName) || !preg_match($regexAlpha, $lastName)) {
        $res['error'] = 2;
        echo json_encode($res);
        return;
    }

    if ($conn->query("SELECT * FROM tbl_author WHERE nama = '$firstName $lastName'")->num_rows > 0) {
        $res['error'] = 3;
        echo json_encode($res);
        return;
    }
    $fullName = $firstName . " " . $lastName;
    $stmtPenulisBaru->bind_param('s', $fullName);
    $stmtPenulisBaru->execute();

    if ($conn->affected_rows !== 1) {
        $res['error'] = 4;
        echo json_encode($res);
        return;
    }

    $newIdAuthor = $conn->query("SELECT * FROM tbl_author WHERE nama = '$firstName $lastName'")->fetch_assoc()['id'];
    $idAuthor = $newIdAuthor;
} else $idAuthor = htmlspecialchars($_POST['idAuthor']);

// Works sampe author baru

// cek gambar
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== 4) {
    $image = uploadImage($_FILES['gambar'], '../../../assets/images/news/');
    if (!$image['success']) {
        if (isset($newIdAuthor)) $conn->query("DELETE FROM author WHERE id = $idAuthor");
        $res['error'] = 4;
        $res['imageError'] = $image['error'];
        echo json_encode($res);
        return;
    }
    $image = $image['fileName'];
}

// // Insert data ke tabel news
$stmtInsertNews = $conn->prepare("INSERT INTO tbl_news VALUES('', ?, ?, ?, ?, ?)");
$text = mysqli_real_escape_string($conn, $text);
$stmtInsertNews->bind_param('ssiss', $judul, $image, $idAuthor, $releaseDate, $text);
$stmtInsertNews->execute();

if ($conn->affected_rows === 1) {
    $res['success'] = true;
} else {
    if (isset($newIdAuthor)) $conn->query("DELETE FROM author WHERE id = $idAuthor");
    $res['error'] = 5;
}

echo json_encode($res);
