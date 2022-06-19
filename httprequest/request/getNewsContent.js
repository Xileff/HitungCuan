$(document).ready(function(){
    const idNews = getUrlParameter('id')

    $.ajax({
        type: 'GET',
        url: 'httprequest/response/getNewsContent.php',
        data: {id: idNews},
        dataType: 'JSON',
        success: function(response){
            let newsData = response.newsdata
            let result = `
            <p id="news-date" class="fs-6 mb-0" style="color: gray;">${newsData.tanggal_rilis}</p>
            <p id="news-author" class="fs-6" style="color: gray;">Author: ${newsData.nama}</p>
            <h1>${newsData.judul_berita}</h1>
            <div class="news-image mt-3">
                <img src="assets/images/news/${newsData.gambar}" alt="news_image" class="w-100">
            </div>
            <p id="news-caption" class="fs-6" style="color: gray;">Ilustrasi: ${newsData.judul_berita}</p>
            <div class="news-text">
                <p class="fs-6">${newsData.teks.replaceAll('\n', '<br>')}}</p>
            </div>`

            $('#newsContainer').html(result)
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