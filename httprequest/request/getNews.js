$(document).ready(function() {
  loadNews()
  $("#inputNews").keyup(function() {
    const keyword = $(this).val();
    loadNews(keyword);
  })

  function loadNews(keyword) {
    $.ajax({
      type: "GET",
      url: "httprequest/response/getNews.php",
      data: { val: (keyword == null ? '*' : keyword) },
      dataType: 'JSON',
      success: function (response) {
        result = ``;
        let rowNums = Math.ceil(response.length / 4);
        // store response.length in rowNums, as the value will decrease with each iteration because of response.shift()
        for(let row = 0; row < rowNums; row++){
            result += `
            <section class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-news justify-content-start w-100 m-0">
            ${
                (function(){
                    let cols = ``;
                    // store response.length in colNum, as the value will decrease with each iteration because of response.shift()
                    let colNum = response.length;
                    for(let col = 0; col < (colNum >= 4 ? 4 : colNum); col++){
                        const newsData = response.shift()   
                        // shift() will decrease array length
                        cols += `
                        <div class="col p-2">
                            <a class="w-100" href="?page=newscontent&id=${newsData.id}">
                                <div class="card card-news w-100 h-100 hvr-grow">
                                    <img src="assets/images/news/${newsData.gambar}" class="card-img-top" alt="${newsData.gambar}">
                                    <div class="card-body card-news-body w-100">
                                        <h5 class="card-title news-title general-link">${newsData.judul_berita}</h5>
                                        <p class="card-text news-date fs-6">${newsData.tanggal_rilis}</p>
                                    </div>
                                    <span class="card-news-author montserrat align-bottom px-3 pb-2">Author : ${newsData.author}</span>
                                </div>
                            </a>
                        </div>
                        `
                    }
                    return cols;
                })()
            }
            </section>
            `

            $('#newsList').html(result);
        }
      },
    })
  }
})