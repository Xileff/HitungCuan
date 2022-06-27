import { disableForm, enableForm } from './mixins.js'

$(this).ready(function(){
    loadNews()
    $('#search').on("keyup", function(){
        loadNews($(this).val())
    })

    // Ubah komponen modal
    const btnSubmit = $('.modal-footer .btn')
    $(this).on("click", ".btn-add", function(){
        $('.modal-title').html('Tambah berita baru')
        btnSubmit.addClass('btn-success')
        btnSubmit.removeClass('btn-warning')
        btnSubmit.removeClass('btn-danger')
        btnSubmit.html('Upload')
        btnSubmit.attr('id', 'confirmAdd')
        resetForm()
        enableForm()
    })

    $(this).on("click", ".btn-edit", function(){
        const newsId = $(this).data('newsid')
        $('.modal-title').html(`Edit berita ${newsId}`)
        btnSubmit.removeClass('btn-success')
        btnSubmit.addClass('btn-warning')
        btnSubmit.removeClass('btn-danger')
        btnSubmit.html('Simpan perubahan')
        btnSubmit.attr('id', 'confirmEdit')
        
        populateForm(newsId)
        enableForm()
    })

    $(this).on("click", ".btn-delete", function(){
        const newsId = $(this).data('newsid')
        $('.modal-title').html(`Hapus berita ${newsId}`)
        btnSubmit.removeClass('btn-success')
        btnSubmit.removeClass('btn-warning')
        btnSubmit.addClass('btn-danger')
        btnSubmit.html('Hapus')
        btnSubmit.attr('id', 'confirmDelete')
        populateForm(newsId)
        disableForm()
    })

    // tombol submit
    $(this).on("click", "#confirmAdd", function(){
        alert('add')
        const formData = new FormData(document.getElementById('form'))
        let gambar = $('#inputImg').files
        if(gambar != undefined){
            gambar = gambar[0]
            formData.append('gambar', gambar)
        }
        $.ajax({
            type: 'POST',
            url: 'administrator/httprequest/response/postAddNews.php',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: response => {
                console.log(response)
                if(response.success){
                    alertSuccess('Berhasil', 'Berita Terupload', 'Ok')
                }
                else {
                    alertError('Gagal', 'Berita tidak terupload', 'Ok')
                }
                loadNews()
            }
        })
    })
    $(this).on("click", "#confirmEdit", function(){
        alert('edit')
        $('.btn-close').click()
    })
    $(this).on("click", "#confirmDelete", function(){
        alert('delete')
        $('.btn-close').click()
    })

    // functions
    function loadNews(keyword = "*"){
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getNews.php',
            data: { kw: keyword },
            dataType: 'json',
            success: news => {
                let newsList = ''
                $.each(news, (i, n) => {
                    newsList += `
                    <tr>
                        <td>${n.id}</td>
                        <td>${n.judul_berita}</td>
                        <td>${n.nama_author}</td>
                        <td>${n.tanggal_rilis}</td>
                        <td class="p-2">
                            <button data-newsid="${n.id}" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-edit btn-warning rounded w-100 mx-auto mb-1 p-1 px-3 text-center">Edit</button>
                            <button data-newsid="${n.id}" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-delete btn-danger rounded w-100 mx-auto mb-1 p-1 px-3 text-center">Hapus</button>
                        </td>
                    </tr>
                    `
                })

                $('tbody').html(newsList)
            }
        })
    }

    function populateForm(newsId){
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getNewsDetail.php',
            data: { id: newsId },
            dataType: 'json',
            success: r => {
                $('#imgPreview').attr('src', `assets/images/news/${r.gambar}`)
                $('#judul').val(r.judul_berita)
                $('#date').val(r.tanggal_rilis)
                $('#text').val(r.teks)
                
                $.ajax({
                    type: 'GET',
                    url: 'administrator/httprequest/response/getNewsAuthor.php',
                    dataType: 'json',
                    success: authors => {
                        let option = ''
                        $.each(authors, (i, a) => {
                            option += `
                            <option ${a.id == r.id_author ? "selected" : ""} value="${a.id}">${a.nama}</option>
                            `
                        })
                        $('#listAuthor').html(option)
                    }
                })
            }
        })
    }

    function resetForm(){
        $('form input').val('')
        $('form img').attr('src', 'assets/images/news/cryptocurrency1.jpg')
        $('form textarea').val('')
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getNewsAuthor.php',
            dataType: 'json',
            success: authors => {
                let option = ''
                $.each(authors, (i, a) => {
                    option += `
                    <option value="${a.id}">${a.nama}</option>
                    `
                })
                $('#listAuthor').html(option)
            }
        })
    }
})