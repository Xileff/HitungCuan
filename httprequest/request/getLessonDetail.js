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
                loadQuestions()
            }
            else {
                $('#lessonContainerAll').html(`<h1 class="m-5 p-5 montserrat">Hanya untuk user premium<h1>`)
                $('#footer').hide()
            }
        }
    })

    function loadQuestions(){
        $.ajax({
            type: 'GET',
            url: 'httprequest/response/getQuestions.php',
            dataType: 'JSON',
            data: { idlesson: url_idlesson },
            success: function(response){
                console.log(response)
                $('#containerQuestions').html(`
                ${(function(){
                    let content = ``;
                    if(!response.isEmpty){
                        const questions = response.questions
                        $.each(questions, (i, q) => {
                            userData = q.userData
                            content += `
                            <div class="row posted-comment pt-4 px-2">
                                <div class="wrapper-comment">
                                    <div class="user-img">
                                        <img src="assets/images/users-profile/${userData.foto}" alt="user" class="img-fluid" style="border-radius: 100%;">
                                    </div>
                                    <div class="px-3 pt-1 pb-1">
                                        <p class="comment-author mb-0">${userData.username}</p>
                                        <p class="comment-date mb-2">Pada ${q.tanggal}</p>
                                        <p class="comment-text text-wrap">
                                            ${q.teks}
                                        </p>
                                    </div>
                                </div>

                                ${(function(){
                                    if(q.answered == 1){
                                        answerData = q.answerData
                                        return `
                                        <div class="row lesson-answer border-hitungcuan rounded-3 p-2" style="background-color: #1f1f1e;">
                                            <p class="fs-6 mb-0">Admin ${answerData.username}'s answer</p>
                                            <p class="fs-6">Pada ${answerData.tanggal}</p>
                                            <p class="fs-6">${answerData.teks}</p>
                                        </div>
                                        `
                                    }

                                    else {
                                        return ``
                                    }
                                })()}
                            </div>
                            `
                        })
                    }
                    else {
                        content = `
                        <div class="pt-4 px-2">
                            <h3 style="color: gray;">There are no questions yet</h3>
                        </div>`
                    }
                    return content
                })()}
                `)
            }
        })
    }
    
    function loadLessonDetail(){
        $.ajax({
            type: 'GET',
            url: 'httprequest/response/getLessonDetail.php',
            data: {subject: url_subject, idlesson: url_idlesson},
            dataType: 'JSON',
            success: function(response){
                lesson = response.data
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

    function getUrlParameter(sParam) {
        let sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
    
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
    
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    }
})