import { getUrlParameter, loadQuestions } from './mixins.js'

$(document).ready(function(){
    let url_subject = getUrlParameter('subject')
    let url_idlesson = getUrlParameter('idlesson')

    $.ajax({
        type: 'POST',
        url: 'httprequest/response/checkAccount.php',
        dataType: 'JSON',
        success: function(response){
            const code = response.code
            if(code === 2){
                loadLessonDetail()
                loadQuestions(url_idlesson)
            }
            else {
                $('#lessonContainerAll').html(`<h1 class="m-5 p-5 montserrat">Hanya untuk user premium<h1>`)
                $('#footer').hide()
            }
        }
    })
    
    function loadLessonDetail(){
        $.ajax({
            type: 'GET',
            url: 'httprequest/response/getLessonDetail.php',
            data: {subject: url_subject, idlesson: url_idlesson},
            dataType: 'JSON',
            success: function(response){
                let lesson = response.data
                $('#containerLesson').html(`
                <div class="row">
                        <h1 class="poppins">${lesson.judul}</h1>
                        <p class="fs-6 mb-0" style="color: gray;">${lesson.tanggal}</p>
                        <div class="news-image mt-3 mb-4">
                            <img src="assets/images/CuanCademy/lessons/${lesson.gambar}" alt="news_image" class="w-100">
                        </div>
                        <p class="montserrat fs-5" style="color: gray;">${lesson.teks.replaceAll('\b', '<br>').replaceAll('\n','<br><br>')}</p>
                </div>`)

                $('input#idlesson').val(lesson.id)
            }
        })
    }
})