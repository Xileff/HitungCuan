<?php 
global $conn;

$news = $conn->query("SELECT * FROM news WHERE id =" . $_GET['id'])->fetch_assoc();

if(isset($_POST['submit'])){
    // 
    // jika gambar ada yg baru, maka hapus yg lama & upload yg baru. lalu update jg nilai kolom gambar di database. tapi kalo gmbrnya yg default, ya jgn dihapus
    // jika author ada yg baru, maka buat dulu author itu, baru bisa update. klo authornya udh ada, gabisa buat author baru tsb.
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
            <input type="text" name="judul" class="form-control" value="<?=$news['judul_berita']?>">
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
            <textarea type="text" name="text" class="form-control" rows="10" cols="50"><?=$news['teks']?></textarea>
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