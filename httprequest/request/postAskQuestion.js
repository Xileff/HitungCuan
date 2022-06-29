import { getUrlParameter, loadQuestions } from './mixins.js'

$(document).ready(function(){
    let url_idlesson = getUrlParameter('idlesson')
    $('#btnComment').click(function(e){
        if($('#txtComment').val().length < 1){
            alertError('Pertanyaan kosong', 'Ketiklah sesuatu sebelum anda mengupload pertanyaan ini', 'Ok');
            e.preventDefault()
        }
        else {
            e.preventDefault()
            postQuestion()
        }
    })

    function postQuestion(){
        const formQuestion = $('#formQuestion').serialize()
        $.ajax({
            type: 'POST',
            url: 'httprequest/response/postAskQuestion.php',
            data: formQuestion,
            dataType: 'JSON',
            success: function(response){
                if(response.success){
                    alertSuccess('Berhasil', 'Pertanyaan anda sudah terupload', 'Ok');
                    loadQuestions(url_idlesson)
                    $('#txtComment').val('')
                }
                else {
                    alertError('Gagal', response.msg, 'Ok');
                }
            }
        })
    }
})