$(document).ready(function(){
    const idNews = getUrlParameter('id')
    loadComments(idNews)

    $('#btnComment').click(function(e){
        e.preventDefault()
        saveComment()
    })

    function saveComment(){
        const formComment = $('#txtComment').val()
        $.ajax({
            type: 'GET',
            url: 'httprequest/response/saveCommentNews.php',
            data: {id_news: idNews, comment: formComment},
            dataType: 'JSON',
            success: function(response){
                let status = response.status
                if(status == 0){
                    alertError('Belum Login', 'Anda harus login dulu untuk komentar','Ok')
                }
                else if(status == 1){
                    alertError('Gagal komentar', 'Komentar anda gagal diupload, silahkan coba lagi.', 'Ok')
                }
                else if(status == 2){
                    alertSuccess('Berhasil komentar', 'Komentar anda telah terupload', 'Ok')
                    loadComments(idNews)
                }
            }
        })
    }

    function loadComments(id_news){
        $.ajax({
            type: 'GET',
            url: 'httprequest/response/getNewsComment.php',
            data: { newsId: id_news },
            dataType: 'JSON',
            success: function(listComments){
                let template = ``
                if(listComments.count > 0){
                    comments = listComments.comments
                    $.each(comments, (i, c) => {
                        template += `
                        <div class="row posted-comment pt-4 px-2">
                            <div class="wrapper-comment">
                                <div class="user-img">
                                    <img src="assets/images/users-profile/${c.foto_user}" alt="user" class="img-fluid" style="border-radius: 100%;">
                                </div>
                                <div class="px-3 pt-1 pb-1">
                                    <p class="comment-author mb-0">${c.username}</p>
                                    <p class="comment-date mb-2">At ${c.tanggal}</p>
                                    <p class="comment-text text-wrap">
                                        ${c.teks}
                                    </p>
                                </div>
                            </div>
                        </div>`
                    })
                }
                else {
                    template = `
                    <div class="pt-4 px-2">
                        <h3 style="color: gray;">There are no comments yet</h3>
                    </div>`
                }
                $('#listComment').html(template)
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