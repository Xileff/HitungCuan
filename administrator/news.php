<script src="administrator/httprequest/request/news.js" type="module"></script>
<div class="container mt-5 pt-5 montserrat">
    <h1 class="fw-bold text-center">News</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-add btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modal">Add new</button>
    <input type="text" id="search" class="form-control mb-2 rounded-pill" placeholder="Cari berita berdasarkan judul">
    <table class="table table-hover table-dark text-center table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Author</th>
                <th>Release Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark rounded-5" style="border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 0.8rem">
                <div class="modal-header">
                    <h5 class="modal-title font-green" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="form" method="POST" enctype="multipart/form-data" class="px-2 d-flex flex-column" enctype="multipart/form-data">
                        <div class="form-group mb-4">
                            <div id="containerInputImage" class="position-relative" data-toggle="tooltip" data-placement="top" title="Reccomended Ratio 3:1, max size 1MB">
                                <div class="position-absolute w-100 h-100 bg-secondary d-flex flex-column justify-content-center align-items-center half-intangible" id="imgInputOverlay">
                                    <i class="fas fa-camera fs-1"></i>
                                    <p>Reccomended ratio 3:1, max size 1MB</p>
                                </div>
                                <img src="assets/images/news/cryptocurrency1.jpg" alt="newsimage" id="imgPreview" class="imgPreview">
                            </div>
                            <label class="fw-bold" for="gambar">Foto</label>
                            <input type="file" name="gambar" id="inputImg" class="form-control d-none">
                        </div>
                        <div class="form-group mb-4">
                            <label class="fw-bold" for="judul">Judul Berita</label>
                            <input type="text" id="judul" name="judul" class="form-control">
                        </div>
                        <div class="form-group mb-4">
                            <label class="fw-bold" for="idAuthor">Author</label>
                            <div class="d-block">
                                <input type="checkbox" class="form-check-input" name="newAuthor" id="chkNewAuthor">
                                <label for="chkNewAuthor">New Author</label>
                            </div>
                            <div id="selectAuthor" class="">
                                <select name="idAuthor" id="listAuthor" class="form-select">

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
                            <textarea id="text" type="text" name="text" class="form-control" rows="10" cols="50"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success rounded-5 align-self-end">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const chkNewAuthor = document.getElementById('chkNewAuthor');
    const authorInputField = [document.getElementById('selectAuthor'), document.getElementById('newAuthor')];
    chkNewAuthor.addEventListener('click', () => authorInputField.forEach(e => e.classList.toggle('intangible')));

    // // cek value tanggal
    const tanggal = document.getElementById('date');
    tanggal.valueAsDate = new Date();
</script>
<script src="assets/js/previewImage.js"></script>