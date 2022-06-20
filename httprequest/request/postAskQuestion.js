$(document).ready(function(){
    let url_idlesson = getUrlParameter('idlesson')
    $('#btnComment').click(function(e){
        if($('#txtComment').val().length < 1){
            alertError('Pertanyaan kosong', 'Ketiklah sesuatu sebelum anda mengupload pertanyaan ini', 'Ok');
            e.preventDefault()
        }
        else {
            e.preventDefault()
            postQuestion()
        }
    })

    function postQuestion(){
        const formQuestion = $('#formQuestion').serialize()
        $.ajax({
            type: 'POST',
            url: 'httprequest/response/postAskQuestion.php',
            data: formQuestion,
            dataType: 'JSON',
            success: function(response){
                console.log(response)
                if(response.status){
                    alertSuccess('Berhasil', 'Pertanyaan anda sudah terupload', 'Ok');
                    loadQuestions()
                }
                else {
                    alertError('Gagal', 'Kesalahan server, silakan coba lagi', 'Ok');
                }
            }
        })
    }


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