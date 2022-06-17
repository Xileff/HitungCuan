$(document).ready(function () {
  $("#btnLogin").click(function (e) {
    e.preventDefault();
    const dataSend = $("#formLogin").serialize();
    $.ajax({
      type: "POST",
      url: "httprequest/response/postLogin.php",
      data: dataSend,
      dataType: "json",
      success: function (response) {
        console.log(response);
      },
    });
  });
});
