$(document).ready(function(){
    $.ajax({
        type: 'GET',
        url: 'httprequest/response/getHomepageNews.php',
        dataType: 'JSON',
        success: function(response){
            let result = ``
            $.each(response, (i, r) => {
                result += `
                <div class="col p-2 mx-auto">
                    <a href="?page=newscontent&id=${r.id}" class="h-100 hvr-grow">
                        <div class="card card-news h-100">
                            <img src="assets/images/news/${r.gambar}" class="card-img-top" alt="cryptocurrency">
                            <div class="card-body card-news-body w-100">
                                <h5 class="card-title news-title general-link hvr-underline-from-left">${r.judul_berita}</h5>
                                <p class="card-text news-date">${r.tanggal_rilis}</p>
                            </div>
                            <span class="card-news-author montserrat align-bottom px-3 pb-2">Author : ${r.author}</span>
                        </div>
                    </a>
                </div>
                `
            })
            $('#homepageNewsContainer').html(result)
        }
    })
})