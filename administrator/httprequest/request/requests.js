$(this).ready(function(){
    loadRequests()
    // function
    let subjectId = $('#selectSubject').val()
    let sortDate = $('#selectSortDate').val()

    $('#selectSubject').on("change", function(){
        subjectId = $(this).val()
        loadRequests(subjectId, sortDate)
    })
    $('#selectSortDate').on("change", function(){
        sortDate = $(this).val()
        loadRequests(subjectId, sortDate)
    })

    // $('.btn-view').on("click", function(){
    //     fillForm($(this).data('requestid'))
    // })

    $(this).on("click", ".btn-view", function(){
        const subjectId = $(this).data('requestid')
        fillForm(subjectId)
    })

    function loadRequests(paramSubjectId = 0, paramSort="asc"){
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getRequests.php',
            data: { 
                subjectId : paramSubjectId, 
                sort: paramSort
             },
            dataType: 'json',
            success: response => {
                let rows = ""
                if(response.success){
                    const reqList = response.requests
                    $.each(reqList, (i, req) => {
                        rows += `
                        <tr>
                            <td>${req.id}</td>
                            <td>${req.username}</td>
                            <td>${req.nama_subject}</td>
                            <td>${req.tanggal}</td>
                            <td>
                                <button data-requestId="${req.id}" class="montserrat btn-view btn-sm btn-lg fw-bold rounded-pill px-5" style="background-color: rgb(117, 249, 145); border: none" data-bs-toggle="modal" data-bs-target="#modal">
                                    <span class="fs-6">View</span>
                                </button>
                            </td>
                        </tr>
                        `
                    })
                }

                $('tbody').html(rows)
            }
        })
    }

    function fillForm(requestId){
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getRequestDetail.php',
            data: { id: requestId },
            dataType: 'json',
            success: response => {
                if(response.success) {
                    const data = response.data
                    $('#modalSelectSubject').html(`
                        <option selected value="${data.id_subject}">${data.nama_subject}</option>
                    `)

                    $('.modal #text').html(data.teks)
                }
            }
        })

    }

    // function deleteRequest(){
    //     $.ajax({
    //         type: 'GET',
    //         url: 'administrator/httprequest/response/getRequests.php',
    //         data: { subjectId : subject_id, action: dismiss },
    //         dataType: 'json',
    //         success: response => {
                
    //         }
    //     })
    // }
})