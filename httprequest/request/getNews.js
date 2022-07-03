$(document).ready(function() {
  loadNews("*", 1)
  $("#inputNews").on("keyup", function() {
    const keyword = $('#inputNews').val();
    const orderBy = $('#sortNews').val()
    loadNews(keyword, orderBy);
  })

  $('#sortNews').on("change", function(){
    const keyword = $('#inputNews').val();
    const orderBy = $('#sortNews').val()
    loadNews(keyword, orderBy);
  })

  function loadNews(keyword, sort) {
    $.ajax({
      type: "GET",
      url: "httprequest/response/getNews.php",
      data: { 
        val: (keyword == null ? '*' : keyword),
        order: sort
       },
      dataType: 'JSON',
      success: function (response) {
        result = ``;
        if(response.length == 0){
          $('#newsList').html('<h1 class="text-center p-5 text-warning">Tidak ada hasil</h1>');
          return
        }
        let rowNums = Math.ceil(response.length / 4);
        // simpan response.length di variabel rowNums, karena nilainya akan berubah di setiap iterasi karena response.shift()
        for(let row = 0; row < rowNums; row++){
            result += `
            <section class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-news justify-content-start w-100 m-0">
            ${
                (function(){
                    let cols = ``;
                    // simpan response.length di dalam variabel colNum, karena nilainya akan dikurangi pada setiap iterasi(ada response.shift() untuk mendapatkan data berita)
                    let colNum = response.length;
                    for(let col = 0; col < (colNum >= 4 ? 4 : colNum); col++){
                        const newsData = response.shift()   
                        // shift() mengambil elemen terakhir dan mengurangi panjang array juga
                        cols += `
                        <div class="col p-2">
                          <a href="?page=newscontent&id=${newsData.id}" class="w-100 h-100 hvr-grow">
                            <div class="card card-news h-100">
                                <img src="assets/images/news/${newsData.gambar}" class="card-img-top" alt="cryptocurrency">
                                <div class="card-body card-news-body w-100">
                                    <h5 class="card-title news-title general-link hvr-underline-from-left">${newsData.judul_berita}</h5>
                                    <p class="card-text news-date">${newsData.tanggal_rilis}</p>
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