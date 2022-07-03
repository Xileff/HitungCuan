function getUrlParameter(sParam){
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

function loadQuestions(url_idlesson){
    $.ajax({
        type: 'GET',
        url: 'httprequest/response/getQuestions.php',
        dataType: 'JSON',
        data: { idlesson: url_idlesson },
        success: function(response){
            $('#containerQuestions').html(`
            ${(function(){
                let content = ``;
                if(!response.isEmpty){
                    const questions = response.questions
                    $.each(questions, (i, q) => {
                        const userData = q.userData
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
                                    const answerData = q.answerData
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

function checkLoginStatus(){
    return $.ajax({
        type: 'POST',
        url: 'httprequest/response/checkAccount.php',
        dataType: 'JSON'
    })
}

function getUserData(){
    return $.ajax({
        type: 'POST',
        url: 'httprequest/response/postUserData.php',
        dataType: 'JSON'
    })
}

function disableForm(){
    $('form input').attr('disabled', 'disabled')
    $('form textarea').attr('disabled', 'disabled')
    $('form select').attr('disabled', 'disabled')
}

function enableForm(){
    $('form input').removeAttr('disabled')
    $('form textarea').removeAttr('disabled')
    $('form select').removeAttr('disabled')
}

export { getUrlParameter, loadQuestions, checkLoginStatus, getUserData, disableForm, enableForm }
