$(this).ready(function(){
    loadRequests()

    // function
    function loadRequests(subject_id = -1){
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getRequests.php',
            data: { subjectId : subject_id, action: load },
            dataType: 'json',
            success: requests => {
                let rows = ""
                

                $('tbody').html(rows)
            }
        })
    }

    function deleteRequest(){
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getRequests.php',
            data: { subjectId : subject_id, action: dismiss },
            dataType: 'json',
            success: response => {
                
            }
        })
    }
})