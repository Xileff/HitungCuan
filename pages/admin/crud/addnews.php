<div class="container pt-5 mt-5 montserrat">
    <h1>Add news</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="px-2 d-flex flex-column">
        <div class="form-group mb-4">
            <div id="containerInputImage" class="position-relative" data-toggle="tooltip" data-placement="top" title="Reccomended Ratio 3:1, max size 1MB">
                <div class="position-absolute w-100 h-100 bg-secondary d-flex flex-column justify-content-center align-items-center half-intangible" id="imgInputOverlay">
                    <i class="fas fa-camera fs-1"></i>
                    <p>Reccomended ratio 3:1, max size 1MB</p>
                </div>
                <img src="images/news/cryptocurrency1.jpg" alt="newsimage" id="imgPreview" class="imgPreview">
            </div>
            <label class="fw-bold" for="foto">Foto</label>
            <input type="file" name="foto" id="inputImg" class="form-control d-none">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="judul_berita">Judul Berita</label>
            <input type="text" name="judul_berita" class="form-control">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="id_author">Author</label>
            <div class="d-block">
                <input type="checkbox" class="form-check-input" name="newAuthor" id="chkNewAuthor">
                <label for="chkNewAuthor">New Author</label>
            </div>
            <div id="selectAuthor" class="">
                <select name="id_author" class="form-control">
                    <option value="1">Felix</option>
                    <option value="2">Vincent</option>
                    <option value="3">Ferry</option>
                </select>
            </div>
            <div id="newAuthor" class="intangible">
                <div class="row">
                    <div class="col">
                        <label for="first_name">Nama depan</label>
                        <input type="text" class="form-control" name="first_name">
                    </div>
                    <div class="col">
                        <label for="last_name">Nama belakang</label>
                        <input type="text" class="form-control" name="last_name">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="tanggal_rilis">Release Date</label>
            <input type="date" name="tanggal_rilis" id="tanggal" class="form-control">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="teks">Teks</label>
            <input type="text" name="teks" class="form-control">
        </div>
        <button class="btn btn-success rounded-5 align-self-end">Save</button>
    </form>
</div>
<script>
    const chkNewAuthor = document.getElementById('chkNewAuthor');
    const authorInputField = [document.getElementById('selectAuthor'), document.getElementById('newAuthor')];
    chkNewAuthor.addEventListener('click', () => authorInputField.forEach(e => e.classList.toggle('intangible')));

    // // cek value tanggal
    // const tanggal = document.getElementById('tanggal');
    // tanggal.addEventListener('change', function(){console.log(this.value)});
</script>
<script src="js/previewImage.js"></script>