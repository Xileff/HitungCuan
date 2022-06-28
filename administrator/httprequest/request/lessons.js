import { disableForm, enableForm } from './mixins.js'

$(this).ready(function(){
    loadLessons()
    $('#search').keyup(function(){
        loadLessons($(this).val())
    })

    // Ubah komponen modal
    const btnSubmit = $('.modal-footer .btn')
    const form = $('#form')
    $(this).on("click", ".btn-add", function(){
        $('.modal-title').html('Tambah materi baru')
        btnSubmit.addClass('btn-success')
        btnSubmit.removeClass('btn-warning')
        btnSubmit.removeClass('btn-danger')
        btnSubmit.html('Upload')
        btnSubmit.attr('id', 'confirmAdd')
        resetForm()
        enableForm()
    })
    $(this).on("click", ".btn-edit", function(){
        const lessonId = $(this).data('lessonid')
        $('.modal-title').html(`Edit materi ${lessonId}`)
        btnSubmit.removeClass('btn-success')
        btnSubmit.addClass('btn-warning')
        btnSubmit.removeClass('btn-danger')
        btnSubmit.html('Simpan perubahan')
        btnSubmit.attr('id', 'confirmEdit')
        
        form.data('lessonid', lessonId)
        populateForm(lessonId)
        enableForm()
    })

    $(this).on("click", ".btn-delete", function(){
        const lessonId = $(this).data('lessonid')
        $('.modal-title').html(`Hapus materi ${lessonId}`)
        btnSubmit.removeClass('btn-success')
        btnSubmit.removeClass('btn-warning')
        btnSubmit.addClass('btn-danger')
        btnSubmit.html('Hapus')
        btnSubmit.attr('id', 'confirmDelete')
        populateForm(lessonId)
        $(form).data('lessonid', lessonId)
        disableForm()
    })

    // Submit dipencet
    $(this).on("click", "#confirmAdd", function(){
        const formData = new FormData(document.getElementById('form'))
        let gambar = $('#inputImg').files
        if(gambar != undefined){
            gambar = gambar[0]
            formData.append('gambar', gambar)
        }
        $.ajax({
            type: 'POST',
            url: 'administrator/httprequest/response/postAddLessons.php',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: response => {
                if(response.success){
                    alertSuccess('Berhasil', 'Materi Terupload', 'Ok')
                }
                else {
                    let msg = ''
                    switch(response.error){
                        case 1:
                            msg = "Judul atau teks tidak boleh kosong"
                            break
                        case 2:
                            msg = "Konten tidak valid"
                            break
                        case 3:
                            msg = "File mungkin bukan gambar, atau ukuran file melebihi 1MB"
                            break
                        default:
                            msg = "Kesalahan server"
                            break
                    }
                    alertError('Gagal', msg, 'Ok')
                }
                loadLessons()
                $('.btn-close').click()
            }
        })
    })

    let changed = false
    $('input, select, textarea').on("change", () => {
        changed = true
    })
    $(this).on("click", "#confirmEdit", function(){
        const formData = new FormData(document.getElementById('form'))
        let gambar = $('#inputImg').files
        if(!changed){
            alertError('Tidak ada perubahan', '', 'Ok')
            $('.btn-close').click()
            return;
        }
        changed = false

        if(gambar != undefined){
            gambar = gambar[0]
            formData.append('gambar', gambar)
        }

        formData.append('id', form.data('lessonid'))

        $.ajax({
            type: 'POST',
            url: 'administrator/httprequest/response/postEditLessons.php',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: response => {
                if(response.success){
                    alertSuccess('Berhasil', 'Materi Terupdate', 'Ok')
                }
                else {
                    let msg = ''
                    switch(response.error){
                        case 1:
                            msg = "Judul atau teks tidak boleh kosong"
                            break
                        case 2:
                            msg = "Konten tidak valid"
                            break
                        case 3:
                            msg = "File mungkin bukan gambar, atau ukuran file melebihi 1MB"
                            break
                        default:
                            msg = "Kesalahan server"
                            break
                    }
                    alertError('Gagal', msg, 'Ok')
                }
                loadLessons()
                $('.btn-close').click()
            }
        })
    })

    // functions
    function populateForm(lessonId){
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getLessonDetail.php',
            data: { id: lessonId },
            dataType: 'json',
            success: l => {
                $()
                $('#judul').val(l.judul)
                $('#tanggal').val(l.tanggal)
                $('#text').val(l.teks)
                $('#imgPreview').attr('src', `assets/images/CuanCademy/lessons/${l.gambar}`)
                $.ajax({
                    type: 'GET',
                    url: 'administrator/httprequest/response/getSubjectOptions.php',
                    dataType: 'json',
                    success: subject => {
                        let options = ''
                        $.each(subject, (i, s) => {
                            options += `
                            <option value="${s.id}" ${l.id_subject == s.id ? "selected" : ""}>${s.nama_subject}</option>
                            `
                        })
                        $('#listSubject').html(options)
                    }
                })
            }
        })
    }

    function loadLessons(keyword = "*"){
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getLessons.php',
            data: { kw: keyword },
            dataType: 'json',
            success: lesson => {
                let lessonList = ''
                $.each(lesson, (i, n) => {
                    lessonList += `
                    <tr>
                        <td>${n.id}</td>
                        <td>${n.judul}</td>
                        <td>${n.subject}</td>
                        <td>${n.tanggal}</td>
                        <td class="p-2">
                            <button data-lessonid="${n.id}" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-edit btn-warning rounded w-100 mx-auto mb-1 p-1 px-3 text-center">Edit</button>
                            <button data-lessonid="${n.id}" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-delete btn-danger rounded w-100 mx-auto mb-1 p-1 px-3 text-center">Hapus</button>
                        </td>
                    </tr>
                    `
                })

                $('tbody').html(lessonList)
            }
        })
    }

    function resetForm(){
        $('form input').val('')
        $('form img').attr('src', 'assets/images/news/cryptocurrency1.jpg')
        $('form textarea').val('')

        const now = new Date();
        const day = ("0" + now.getDate()).slice(-2);
        const month = ("0" + (now.getMonth() + 1)).slice(-2);
        const today = now.getFullYear()+"-"+(month)+"-"+(day) ;
        $('input#tanggal').val(today)
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getSubjectOptions.php',
            dataType: 'json',
            success: subject => {
                let option = ''
                $.each(subject, (i, s) => {
                    option += `
                    <option value="${s.id}">${s.nama_subject}</option>
                    `
                })
                $('#listSubject').html(option)
            }
        })
    }
})