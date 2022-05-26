<?php 
global $conn;

$news = $conn->query("SELECT * FROM news WHERE id =" . $_GET['id'])->fetch_assoc();

if(isset($_POST['submit'])){
    // data lama
    $id = $news['id'];
    $judul = $news['judul_berita'];
    $gambar = $news['gambar'];
    $gambarLama = $news['gambar'];
    $idAuthor = $news['id_author'];
    $tanggalRilis = $news['tanggal_rilis'];
    $teks = $news['teks'];

    // data baru
    $new_judul = htmlspecialchars($_POST['judul']);
    $new_tanggal_rilis = htmlspecialchars($_POST['releaseDate']);
    $new_teks = htmlspecialchars($_POST['text']);

    // jika author ada yg baru, maka buat dulu author itu, baru bisa update. klo authornya udh ada, gabisa buat author baru tsb.
    if(isset($_POST['newAuthor'])){
        $firstName = ucfirst(strtolower(htmlspecialchars($_POST['firstName'])));
        $lastName = ucfirst(strtolower(htmlspecialchars($_POST['lastName'])));

        if(strlen($firstName) < 1 || strlen($lastName) < 1){
            alertRedirect('Nama penulis kosong', 'Nama penulis tidak boleh kosong','','Ok');
            return;
        }

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
    }

    else {
        $idAuthor = htmlspecialchars($_POST['idAuthor']);
    }
    
    // cek ada input gambar atau tidak
    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== 4){
        $gambar = uploadImage($_FILES['gambar'], 'images/news/');
        if(!$gambar){
            if(isset($newIdAuthor)) $conn->query("DELETE FROM author WHERE id = $idAuthor");
            alertRedirect('Error', 'Gagal memasukkan gambar', '', 'Coba lagi');
            return;
        }

        else {
            $gambarTerupload = true;
        }
    } 
    
    else {
        $gambar = $gambarLama;
    }

    // query
    $conn->query("UPDATE news SET 
    judul_berita = '$new_judul',
    gambar = '$gambar',
    id_author = '$idAuthor',
    tanggal_rilis = '$new_tanggal_rilis',
    teks = '$new_teks'

    WHERE id = $id");

    if($conn->affected_rows === 1){
        if($gambarLama !== 'cryptocurrency1.jpg' && $gambarTerupload){
            unlink('images/news/' . $gambarLama);
        }
        alertRedirect('Berhasil', 'Berita sudah terupdate','?page=news&action=none','Ok');
    }

    else {
        if($gambarTerupload){
            unlink('images/news/' . $gambar);
        }
        alertRedirect('Kesalahan server', 'Silakan coba lagi setelah beberapa saat', '' ,'Ok');
    }
}
?>

<div class="container pt-5 mt-5 montserrat">
    <h1>Edit news</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="px-2 d-flex flex-column" enctype="multipart/form-data">
        <div class="form-group mb-4">
            <div id="containerInputImage" class="position-relative" data-toggle="tooltip" data-placement="top" title="Reccomended Ratio 3:1, max size 1MB">
                <div class="position-absolute w-100 h-100 bg-secondary d-flex flex-column justify-content-center align-items-center half-intangible" id="imgInputOverlay">
                    <i class="fas fa-camera fs-1"></i>
                    <p>Reccomended ratio 3:1, max size 1MB</p>
                </div>
                <img src="images/news/<?=$news['gambar']?>" alt="newsimage" id="imgPreview" class="imgPreview">
            </div>
            <label class="fw-bold" for="gambar">Foto</label>
            <input type="file" accept="image/*" name="gambar" id="inputImg" class="form-control d-none">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="judul">Judul Berita</label>
            <input type="text" id="judul" name="judul" class="form-control" value="<?=$news['judul_berita']?>">
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
                        <?php if($author['id'] === $news['id_author']):?>
                            <option value="<?=$author['id']?>" selected><?=$author['nama']?></option>
                        <?php else:?>
                            <option value="<?=$author['id']?>"><?=$author['nama']?></option>
                        <?php endif?>
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
            <input type="date" name="releaseDate" id="date" class="form-control" value="<?=$news['tanggal_rilis']?>">
            <!-- masih gabisa -->
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="text">Teks</label>
            <textarea type="text"  id="text" name="text" class="form-control" rows="10" cols="50"><?=$news['teks']?></textarea>
        </div>
        <button class="btn btn-success rounded-5 align-self-end" name="submit" type="submit" id="btnSave">Save</button>
    </form>
</div>
<script>
    const chkNewAuthor = document.getElementById('chkNewAuthor');
    const authorInputField = [document.getElementById('selectAuthor'), document.getElementById('newAuthor')];
    chkNewAuthor.addEventListener('click', () => authorInputField.forEach(e => e.classList.toggle('intangible')));

    // cek input
    document.getElementById('btnSave').addEventListener('click', e => {
        const judul = document.getElementById('judul');
        const text = document.getElementById('text');

        if(judul.value.length < 1 || text.value.length < 1){
            alertError('Data Tidak Lengkap', 'Tidak boleh ada data yang kosong', 'Ok');
            e.preventDefault();
            return;
        }
    });
</script>
<script src="js/previewImage.js"></script>