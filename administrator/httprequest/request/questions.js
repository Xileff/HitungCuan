$(this).ready(function(){
    loadQuestions()
    $('#selectSubject').on("change", function(){
        loadQuestions($(this).val())
    })

    const form = $('#form')
    $(this).on("click", ".btn-showquestion", function(){
        const questionId = $(this).data('questionid')
        fillForm(questionId)
        $('#questionId').val(questionId)
    })

    $(this).on("click", "#btnAnswer", function(){
        $.ajax({
            type: 'POST',
            url: 'administrator/httprequest/response/postAnswer.php',
            data: $('#form').serialize(),
            dataType: 'json',
            success: response => {
                console.log(response)
                if(response.success){
                    alertSuccess('Berhasil', response.msg, 'Ok')
                }
                else {
                    alertError('Gagal', response.msg, 'Ok')
                }

                $('.btn-close').click()
                loadQuestions()
            }
        })
    })

    // function
    function loadQuestions(subject_id = -1){
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getQuestions.php',
            data: { subjectId : subject_id },
            dataType: 'json',
            success: questions => {
                let rows = ""
                $.each(questions, (i, q) => {
                    rows += `
                    <tr>
                        <td>${q.id}</td>
                        <td>${q.username}</td>
                        <td>${q.lesson}</td>
                        <td>${q.subject}</td>
                        <td>${q.tanggal}</td>
                        <td>
                            <button data-questionid="${q.id}" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-showquestion btn-success rounded-pill w-100 mx-auto mb-1 p-1 px-3 text-center">Show</button>
                        </td>
                    </tr>
                    `
                })

                $('tbody').html(rows)
            }
        })
    }

    function fillForm(paramId){
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getQuestionDetail.php',
            data: { id : paramId },
            dataType: 'json',
            success: formData => {
                $('.modal-title').html(`Question ${formData.id}`)
                $('.modal #username').html(`By : ${formData.username}`)
                $('.modal #questionLesson').html(`Lesson : ${formData.judul}`)
                $('.modal #questionDate').html(`Asked on : ${formData.tanggal}`)
                $('.modal #questionText').html(formData.teks.replaceAll('\\r\\n', '\r\n'))
            }
        })
    }
})