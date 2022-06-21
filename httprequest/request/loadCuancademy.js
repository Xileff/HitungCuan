$(document).ready(function(){
    $.ajax({
        type: 'POST',
        url: 'httprequest/response/checkAccount.php',
        dataType: 'JSON',
        success: function(response){
            const code = response.code
            switch(code){
                case 0:
                    $('#footer').hide()
                    $('#containerCuancademy').html(`<h1 class="p-5">Belum login<h1>`)
                    errorRedirect('Oops', 'Anda harus login terlebih dahulu', 'Ok', '?page=login', )
                    break
                case 1:
                    $('#footer').hide()
                    $('#containerCuancademy').html(`<h1 class="p-5">Hanya untuk user premium<h1>`)
                    errorRedirect('Oops', 'Fitur ini hanya tersedia untuk akun premium', 'Ok', '?page=homepage')
                    break
                case 2:
                    getNewestLessons().then((response) => {
                        $('#containerSubjectIncome').attr('href', `?page=lesson&subject=1&idlesson=${response.s1NewestLesson}`)
                        $('#containerSubjectExpenses').attr('href', `?page=lesson&subject=2&idlesson=${response.s2NewestLesson}`)
                        $('#containerSubjectInvestment').attr('href', `?page=lesson&subject=3&idlesson=${response.s3NewestLesson}`)
                    })
            }
        }
    })

    function getNewestLessons(){
        return $.ajax({
            type: 'POST',
            url: 'httprequest/response/getNewestLesson.php',
            dataType: 'JSON'
        })
    }
})