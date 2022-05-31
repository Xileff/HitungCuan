<?php 

global $conn;

if(isset($_POST['submit'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $idSubject = htmlspecialchars($_POST['idSubject']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $teks = htmlspecialchars($_POST['text']);
    $gambar = 'cryptocurrency1.jpg';

    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== 4){
        $gambar = uploadImage($_FILES['gambar'], 'images/CuanCademy/lessons/');
        if(!$gambar){
            refresh(2);
            return;
        }
    }

    $conn->query("INSERT INTO lessons VALUES ('', $idSubject, '$judul', '$tanggal', '$gambar', '$teks')");

    if($conn->affected_rows === 1){
        alertRedirect('Berhasil', 'Materi sudah terinput ke sistem','?page=lessons&action=none','Ok');
    } else {
        if($gambar !== 'cryptocurrency1.jpg'){
            unlink('images/CuanCademy/lessons/' . $gambar);
        }
        alertError('Gagal', 'Materi tidak terinput ke sistem', 'Ok');
        echo "<script>alert('" . $conn->error ."')</script>";
    }
    
}

?>

<div class="container pt-5 mt-5 montserrat">
    <h1>Add Lesson</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="px-2 d-flex flex-column" enctype="multipart/form-data">
        <div class="form-group mb-4">
            <div id="containerInputImage" class="position-relative" data-toggle="tooltip" data-placement="top" title="Reccomended Ratio 3:1, max size 1MB">
                <div class="position-absolute w-100 h-100 bg-secondary d-flex flex-column justify-content-center align-items-center half-intangible" id="imgInputOverlay">
                    <i class="fas fa-camera fs-1"></i>
                    <p>Reccomended ratio 3:1, max size 1MB</p>
                </div>
                <img src="images/news/cryptocurrency1.jpg" alt="lessonImage" id="imgPreview" class="imgPreview">
            </div>
            <label class="fw-bold" for="gambar">Foto</label>
            <input type="file" name="gambar" id="inputImg" class="form-control d-none">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="judul">Judul</label>
            <input type="text" id="judul" name="judul" class="form-control">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="idSubject">Subject</label>
            <div id="selectSubject" class="">
                <?php $listSubject = $conn->query("SELECT id, nama_subject FROM subject")?>
                <select name="idSubject" class="form-control">
                    <?php while($subject = $listSubject->fetch_assoc()):?>
                        <option selected value="<?=$subject['id']?>"><?=$subject['nama_subject']?></option>
                    <?php endwhile;?>
                </select>
            </div>
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="tanggal">Release Date</label>
            <input type="date" name="tanggal" id="date" class="form-control">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="text">Teks</label>
            <textarea id="text" type="text" name="text" class="form-control" rows="10" cols="50"></textarea>
        </div>
        <button class="btn btn-success rounded-5 align-self-end" name="submit"  id="btnSave" type="submit">Save</button>
    </form>
</div>
<script>
    // // cek value tanggal
    const tanggal = document.getElementById('date');
    tanggal.valueAsDate = new Date();

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