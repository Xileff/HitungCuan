$(document).ready(function(){
    let url_subject = getUrlParameter('subject')
    let url_idlesson = getUrlParameter('idlesson')
    
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
        }
    })

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