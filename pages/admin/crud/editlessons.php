<?php 
global $conn;
$lesson = $conn->query("SELECT * FROM lessons WHERE id =" . $_GET['id'])->fetch_assoc();

if(isset($_POST['submit'])){
    $gambarLama = $lesson['gambar'];
    $judul = htmlspecialchars($_POST['judul']);
    $idSubject = htmlspecialchars($_POST['idSubject']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $teks = htmlspecialchars($_POST['text']);

    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== 4){
        $gambar = uploadImage($_FILES['gambar'], 'images/CuanCademy/lessons/');
        if(!$gambar){
            refresh(2);
            return;
        }

        else {
            $gambarTerupload = true;
        }
    }

    else {
        $gambar = $gambarLama;
    }

    $conn->query("UPDATE lessons SET 
    judul = '$judul',
    id_subject = $idSubject,
    tanggal = '$tanggal',
    gambar = '$gambar',
    teks = '$teks'

    WHERE id = " . $_GET['id']);

    if($conn->affected_rows === 1){
        if($gambarLama !== 'cryptocurrency1.jpg' && $gambarTerupload) {
            unlink('images/CuanCademy/lessons/' . $gambarLama);
        }
        alertRedirect('Berhasil update', 'Materi berhasil terupdate', '?page=lessons&action=none', 'Ok');
    }

    else {
        if($gambarTerupload){
            unlink('images/CuanCademy/lessons/' . $gambar);
        }
        alertRedirect('Kesalahan server', 'Silakan coba beberapa saat lagi','','Ok');
        return;
    }
}
?>

<div class="container pt-5 mt-5 montserrat">
    <h1>Edit Lesson</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="px-2 d-flex flex-column" enctype="multipart/form-data">
        <div class="form-group mb-4">
            <div id="containerInputImage" class="position-relative" data-toggle="tooltip" data-placement="top" title="Reccomended Ratio 3:1, max size 1MB">
                <div class="position-absolute w-100 h-100 bg-secondary d-flex flex-column justify-content-center align-items-center half-intangible" id="imgInputOverlay">
                    <i class="fas fa-camera fs-1"></i>
                    <p>Reccomended ratio 3:1, max size 1MB</p>
                </div>
                <img src="images/CuanCademy/lessons/<?=$lesson['gambar']?>" alt="lessonimage" id="imgPreview" class="imgPreview">
            </div>
            <label class="fw-bold" for="gambar">Foto</label>
            <input type="file" accept="image/*" name="gambar" id="inputImg" class="form-control d-none">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="judul">Judul</label>
            <input type="text" id="judul" name="judul" class="form-control" value="<?=$lesson['judul']?>">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="idSubject">Subject</label>
            <div id="selectAuthor" class="">
                <?php $listSubject = $conn->query("SELECT id, nama_subject FROM subject")?>
                <select name="idSubject" class="form-control">
                    <?php while($subject = $listSubject->fetch_assoc()):?>
                        <?php if($subject['id'] === $lesson['id_subject']):?>
                            <option value="<?=$subject['id']?>" selected><?=$subject['nama_subject']?></option>
                        <?php else:?>
                            <option value="<?=$subject['id']?>"><?=$subject['nama_subject']?></option>
                        <?php endif?>
                    <?php endwhile;?>
                </select>
            </div>
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="releaseDate">Release Date</label>
            <input type="date" name="tanggal" id="date" class="form-control" value="<?=$lesson['tanggal']?>">
            <!-- masih gabisa -->
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="text">Teks</label>
            <textarea type="text"  id="text" name="text" class="form-control" rows="10" cols="50"><?=$lesson['teks']?></textarea>
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