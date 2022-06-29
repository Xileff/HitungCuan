import { getUrlParameter } from './mixins.js'

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
            url: 'httprequest/response/postCommentNews.php',
            data: {id_news: idNews, comment: formComment},
            dataType: 'JSON',
            success: function(response){
                console.log(response)
                if(response.success){
                    alertSuccess('Berhasil komentar', 'Komentar anda telah terupload', 'Ok')
                    loadComments(idNews)
                }
                else {
                    alertError('Gagal', response.msg, 'Ok')
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
                    let comments = listComments.comments
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
})