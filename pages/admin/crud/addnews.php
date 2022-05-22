<?php 
global $conn;
if(isset($_POST['submit'])){
    // Validasi input
    if($_POST['judul'] === ''){
        alertRedirect('Error', 'Judul berita kosong', '', 'Ok');
        return;
    }

    if($_POST['text'] === ''){
        alertRedirect('Error', 'Isi berita kosong', '', 'Ok');
        return;
    }

    // ambil nilai
    $judul = htmlspecialchars($_POST['judul']);
    $idAuthor;
    $releaseDate = htmlspecialchars($_POST['releaseDate']);
    $text = htmlspecialchars($_POST['text']);
    $image = 'default.png';

    // set nilai id penulis
    if(isset($_POST['newAuthor'])){
        $firstName = ucfirst(strtolower(htmlspecialchars($_POST['firstName'])));
        $lastName = ucfirst(strtolower(htmlspecialchars($_POST['lastName'])));

        if($conn->query("SELECT * FROM author WHERE nama = '$firstName $lastName'")->num_rows > 0){
            alertRedirect('Error', 'Penulis sudah ada di sistem', '', 'Ok');
            return;
        }

        $conn->query("INSERT INTO author VALUES ('', '$firstName $lastName')");

        if($conn->affected_rows !== 1){
            alertRedirect('Error', 'Gagal menginput penulis baru', '', 'Coba lagi');
            return;
        }

        $newIdAuthor = $conn->query("SELECT * FROM author WHERE nama = '$firstName $lastName'")->fetch_assoc()['id'];
        $idAuthor = $newIdAuthor;
    } else $idAuthor = htmlspecialchars($_POST['idAuthor']);

    // cek gambar
    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== 4){
        $image = uploadImage($_FILES['gambar'], 'images/news/');
        if(!$image){
            if(isset($newIdAuthor)) $conn->query("DELETE FROM author WHERE id = $idAuthor");
            alertRedirect('Error', 'Gagal memasukkan gambar', '', 'Coba lagi');
            return;
        }
    }

    // Insert data ke tabel news
    $conn->query("INSERT INTO news VALUES('', '$judul', '$image', '$idAuthor', '$releaseDate', '$text')");

    if($conn->affected_rows === 1) {
        alertSuccess('Berhasil', 'Berita sudah terinput ke sistem', 'Ok');
    } else {
        if(isset($newIdAuthor)) $conn->query("DELETE FROM author WHERE id = $idAuthor");
        alertError('Error', 'Gagal menginput data','Coba lagi');
    }
}

?>

<div class="container pt-5 mt-5 montserrat">
    <h1>Add news</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="px-2 d-flex flex-column" enctype="multipart/form-data">
        <div class="form-group mb-4">
            <div id="containerInputImage" class="position-relative" data-toggle="tooltip" data-placement="top" title="Reccomended Ratio 3:1, max size 1MB">
                <div class="position-absolute w-100 h-100 bg-secondary d-flex flex-column justify-content-center align-items-center half-intangible" id="imgInputOverlay">
                    <i class="fas fa-camera fs-1"></i>
                    <p>Reccomended ratio 3:1, max size 1MB</p>
                </div>
                <img src="images/news/cryptocurrency1.jpg" alt="newsimage" id="imgPreview" class="imgPreview">
            </div>
            <label class="fw-bold" for="gambar">Foto</label>
            <input type="file" name="gambar" id="inputImg" class="form-control d-none">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="judul">Judul Berita</label>
            <input type="text" name="judul" class="form-control">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="idAuthor">Author</label>
            <div class="d-block">
                <input type="checkbox" class="form-check-input" name="newAuthor" id="chkNewAuthor">
                <label for="chkNewAuthor">New Author</label>
            </div>
            <div id="selectAuthor" class="">
                <?php $listAuthor = $conn->query("SELECT id, nama FROM author")?>
                <select name="idAuthor" class="form-control">
                    <?php while($author = $listAuthor->fetch_assoc()):?>
                        <option value="<?=$author['id']?>"><?=$author['nama']?></option>
                    <?php endwhile;?>
                </select>
            </div>
            <div id="newAuthor" class="intangible">
                <div class="row">
                    <div class="col">
                        <label for="firstName">Nama depan</label>
                        <input type="text" class="form-control" name="firstName">
                    </div>
                    <div class="col">
                        <label for="lastName">Nama belakang</label>
                        <input type="text" class="form-control" name="lastName">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="releaseDate">Release Date</label>
            <input type="date" name="releaseDate" id="date" class="form-control">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="text">Teks</label>
            <input type="text" name="text" class="form-control">
        </div>
        <button class="btn btn-success rounded-5 align-self-end" name="submit" type="submit">Save</button>
    </form>
</div>
<script>
    const chkNewAuthor = document.getElementById('chkNewAuthor');
    const authorInputField = [document.getElementById('selectAuthor'), document.getElementById('newAuthor')];
    chkNewAuthor.addEventListener('click', () => authorInputField.forEach(e => e.classList.toggle('intangible')));

    // // cek value tanggal
    const tanggal = document.getElementById('date');
    tanggal.valueAsDate = new Date();
</script>
<script src="js/previewImage.js"></script>