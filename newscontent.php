<script src="httprequest/request/getNewsContent.js"></script>

<body>
    <div class="container mt-5 pt-5" id="newsContainer">
    </div>
    <hr>

    <div class="container container-comment">
        <!-- Input komentar -->
        <form action="" method="POST" id="formComment">
            <div class="row new-comment pt-1 pb-2">
                <div class="col-sm col-md-10 col-lg-10">
                    <input class="form-control montserrat w-100" id="txtComment" placeholder="Write Comment Here" name="txtComment"></input>
                </div>
                <div class="col-sm col-md-2 col-lg-2">
                    <button type="submit" name="submit" id="btnComment" class="w-100 h-100 montserrat btn-sm btn-lg">Comment</button>
                </div>
            </div>
        </form>

        <script src="httprequest/request/getNewsComment.js"></script>
        <!-- List komentar -->
        <section id="listComment">
        </section>
    </div>
</body>
<script>
    document.getElementById('btnComment').addEventListener('click', e => {
        if (document.getElementById('txtComment').value.length < 1 /** kurang dari 1 huruf, maka preventdefault */ ) {
            alertError('Komentar kosong', 'Ketiklah sesuatu sebelum anda mengupload komentar ini', 'Ok');
            e.preventDefault();
        }
    });
</script>

</html>