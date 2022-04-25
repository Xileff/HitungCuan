<div class="container pt-5 mt-5 montserrat">
    <h1>Add news</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="px-2">
        <div class="form-group mb-4">
            <div id="containerInputImage">
                <img src="" alt="newsimage" id="imgPreview">
            </div>
            <label class="fw-bold" for="foto">Foto</label>
            <input type="file" name="foto" id="inputImg" class="form-control">
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
            <input type="date" name="tanggal_rilis" class="form-control">
        </div>
        <div class="form-group mb-4">
            <label class="fw-bold" for="teks">Teks</label>
            <input type="text" name="teks" class="form-control">
        </div>
    </form>
</div>
<script>
    const chkNewAuthor = document.getElementById('chkNewAuthor');
    const authorInputField = [document.getElementById('selectAuthor'), document.getElementById('newAuthor')];
    chkNewAuthor.addEventListener('click', () => authorInputField.forEach(e => e.classList.toggle('intangible')));
</script>
<script src="js/previewImage.js"></script>