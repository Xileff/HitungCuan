$(document).ready(function () {
  loadNews();
  $("#inputNews").keyup(function () {
    const keyword = $(this).val();
    console.log(keyword);
    loadNews(keyword);
  });

  function loadNews(keyword = "*") {
    $.ajax({
      type: "GET",
      url: "httprequest/response/getNews.php",
      data: { val: keyword },
      success: function (response) {
        $("#newsmaincontainer").html(response);
      },
    });
  }
});

// loadNews('*');

// function loadNews(keyword = '*'){
//     const ajax = new XMLHttpRequest();
//     ajax.onreadystatechange = function () {
//         if(this.status === 200 && this.readyState === 4) {
//             const result = this.responseText;

//             const container = document.getElementById('newsmaincontainer');
//             container.innerHTML = result;
//         }
//     }

//     ajax.open("GET", "httprequest/response/getNews.php", true)
//     ajax.send()
// }
