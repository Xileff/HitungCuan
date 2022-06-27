import { getUrlParameter } from './mixins.js'

$(document).ready(function(){
    let url_idsubject = getUrlParameter('subject')
    loadLessons()
    $("#searchLesson").keyup(function() {
        const keyword = $(this).val()
        loadLessons(keyword)
     })

    //  $(this).on("keyup", "#searchLesson")

    function loadLessons(keyword = '*'){
        $.ajax({
            type: 'GET',
            url: 'httprequest/response/getLessonList.php',
            data: {kw : keyword, idSubject: url_idsubject},
            dataType: 'JSON',
            success: function(response){
                $('#subjectName').html(response.lessonName)
                let lessons = ``

                if(response.success == true){
                    $.each(response.lessons, (i, r) => {
                        lessons+=`
                        <a href="?page=lesson&subject=${r.id_subject}&idlesson=${r.id}" class="m-4 sidebar-lesson-link fw-bold">
                            <div class="row row-lessons w-100 mx-auto position-relative mt-2 mb-2">
                                <div class="background-zoom bgLesson w-100 h-100 m-0 p-0 position-absolute start-0 top-0 bg-dark"></div>
                                <div class="blackOverlay w-100 h-100 m-0 p-0 position-absolute top-0 start-0"></div>
                                <p class="text-center pt-2 pb-2 m-0 fs-4" style="z-index: 2;">${r.judul}</h1>
                            </div>
                        </a>
                        `
                    })
                }
                else {
                    lessons = `<p class="montserrat fs-6 p-3 text-light">Lesson not found<p>`
                }

                $('#lessonList').html(lessons)
            }
        })
    }
})