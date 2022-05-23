<?php 
global $conn;
$id = $_GET['id'];
$news = $conn->query("SELECT * FROM news WHERE id=$id")->fetch_assoc();
$author = $conn->query("SELECT nama FROM author WHERE id=" . $news['id_author'])->fetch_assoc()['nama'];

if(isset($_POST['submit'])){
    // jika belum login, alertError(belom login)
    if(!isset($_SESSION['username'])){
        alertRedirect('Belum Login', 'Anda harus login dulu untuk komentar', '?page=login', 'Ok');
    }

    else {

    // jika sudah login, boleh komentar
    $user = $conn->query("SELECT id, username, foto FROM users WHERE username='" . $_SESSION['username'] . "'")->fetch_assoc();
    $comment = $_POST['comment'];


    $conn->query("INSERT INTO news_comment VALUES('','" . $user['id'] . "','" . $_GET['id'] . "','" . $user['username'] . "', '" . date('Y-m-d') . "', '$comment')");

    if($conn->affected_rows !== 1){
        alertError('Gagal komentar', 'Komentar anda gagal diupload, silahkan coba lagi.', 'Ok');
        refresh(2.5);
        return;
    }

    alertSuccess('Berhasil komentar', 'Komentar anda telah terupload', 'Ok');
    }
}
?>

<body>
    <?php include 'pages/components/html-navbar.php'?>
    <div class="container mt-5 pt-5">
        <p id="news-date" class="fs-6 mb-0" style="color: gray;"><?=tgl_indo($news['tanggal_rilis'])?></p>
        <p id="news-author" class="fs-6" style="color: gray;">Author: <?=$author?></p>
        <h1><?=$news['judul_berita']?></h1>
        <div class="news-image mt-3">
            <img src="images/news/<?=$news['gambar'] ?>" alt="news_image" class="img-fluid">
        </div>
        <p id="news-caption" class="fs-6" style="color: gray;">Ilustrasi: <?=$news['judul_berita']?></p>
        <div class="news-text">
            <p class="fs-6"><?=$news['teks']?></p>
        </div>
    </div>
    <hr>

    <div class="container container-comment">

        <!-- Input komentar -->
        <form action="" method="POST">
            <div class="row new-comment pt-1 pb-2">
                <div class="col-sm col-md-10 col-lg-10">
                    <input class="form-control montserrat w-100" id="txtComment" placeholder="Write Comment Here" name="comment"></input>
                </div>
                <div class="col-sm col-md-2 col-lg-2">
                    <button type="submit" name="submit" id="btnComment" class="w-100 h-100 montserrat btn-sm btn-lg">Comment</button>
                </div>
            </div>
        </form>

        <!-- List komentar -->
        <?php 
        $comments = $conn->query("SELECT * FROM news_comment WHERE id_berita = '$id'")
        ?>

        <?php while($comment = $comments->fetch_assoc()):?>
            <?php $user = $conn->query("SELECT username, foto FROM users WHERE id=" . $comment['id_user'])->fetch_assoc()?>
            <div class="row posted-comment pt-4 px-2">
                <div class="wrapper-comment">
                    <div class="user-img">
                        <img src="images/users-profile/<?=$user['foto']?>" alt="user" class="img-fluid" style="border-radius: 100%;">
                    </div>
                    <div class="px-3 pt-1 pb-1">
                        <p class="comment-author mb-0"><?=$user['username']?></p>
                        <p class="comment-date mb-2">At <?=$comment['tanggal']?></p>
                        <p class="comment-text text-wrap">
                            <?=$comment['teks']?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endwhile?>
    </div>
    <?php include 'pages/components/html-top.php'?>
</body>
<script>
    document.getElementById('btnComment').addEventListener('click', e => {
        if(document.getElementById('txtComment').value.length < 1 /** kurang dari 1 huruf, maka preventdefault */) {
            alertError('Komentar kosong', 'Ketiklah sesuatu sebelum anda mengupload komentar ini','Ok');
            e.preventDefault();
        }
    });
</script>
</html>