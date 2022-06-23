<?php 
global $conn;
$lesson = $conn->query("SELECT * FROM lessons WHERE id =" . $_GET['id'])->fetch_assoc();

if(isset($_POST['submit'])){
    $gambar = $lesson['gambar'];
    $conn->query("DELETE FROM lessons WHERE id = " . $lesson['id']);

    if($conn->affected_rows === 1){
        if($gambar !== 'cryptocurrency1.jpg'){
            unlink('assets/images/CuanCademy/lessons/' . $gambar);
        }

        alertRedirect('Materi berhasil dihapus', 'Kembali ke halaman daftar materi', '?page=lessons&action=none', 'Ok');
    }

    else {
        alertRedirect('Kesalahan server', 'Materi gagal dihapus, silakan coba lagi setelah beberapa saat.', '?page=lessons&action=none','Ok');
    }
}
?>

<div class="container pt-5 mt-5 montserrat">
    <h1>Delete Lesson</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="px-2 d-flex flex-column" enctype="multipart/form-data">
        <div class="form-group mb-4">
            <div id="containerInputImage" class="position-relative" data-toggle="tooltip" data-placement="top" title="Reccomended Ratio 3:1, max size 1MB">
                <div class="position-absolute w-100 h-100 bg-secondary d-flex flex-column justify-content-center align-items-center half-intangible" id="imgInputOverlay">
                    <i class="fas fa-camera fs-1"></i>
                    <p>Reccomended ratio 3:1, max size 1MB</p>
                </div>
                <img src="assets/images/CuanCademy/lessons/<?=$lesson['gambar']?>" alt="lessonimage" id="imgPreview" class="imgPreview">
            </div>
            <label class="fw-bold" for="gambar">Foto</label>
            <input disabled type="file" accept="image/*" name="gambar" id="inputImg" class="form-control d-none">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="judul">Judul</label>
            <input disabled type="text" id="judul" name="judul" class="form-control" value="<?=$lesson['judul']?>">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="idSubject">Subject</label>
            <div id="selectAuthor" class="">
                <?php $listSubject = $conn->query("SELECT id, nama_subject FROM subject")?>
                <select disabled name="idSubject" class="form-control">
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
            <input disabled type="date" name="tanggal" id="date" class="form-control" value="<?=$lesson['tanggal']?>">
            <!-- masih gabisa -->
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="text">Teks</label>
            <textarea type="text"  id="text" name="text" class="form-control" rows="10" cols="50"><?=$lesson['teks']?></textarea>
        </div>
        <button class="btn btn-danger rounded-5 align-self-end" name="submit" type="submit">Delete</button>
    </form>
</div>
<script>
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
<script src="assets/js/previewImage.js"></script>