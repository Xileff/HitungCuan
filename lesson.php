<script src="httprequest/request/getLessonDetail.js" type="module"></script>
<script src="httprequest/request/getLessonList.js" type="module"></script>
<script src="httprequest/request/postAskQuestion.js" type="module"></script>

<body>
    <div id="lessonContainerAll">
        <div class="mt-5 pt-5">
            <div class="overlay d-none" onclick="showLessons()"></div>
            <!-- New sidebar -->
            <div id="lesson-side-bar" class="position-fixed h-100 top-0 left-0 bottom-0 sidebar-hide">
                <button class="position-absolute" style="background: none; right: 0; border: none; color: white;" onclick="showLessons()"><span class="fw-bold montserrat">X</span></button>
                <div class="w-75 mx-auto">
                    <h3 class="poppins text-center m-3" id="subjectName"></h3>
                    </h1>
                    <div class="bg-light rounded-1">
                        <input type="text" id="inputSubject" hidden value="<?= $_GET['subject'] ?>">
                        <input type="text" class="form-control montserrat" id="searchLesson" placeholder="Search lessons here">
                    </div>
                    <div id="lessonList">
                        <!--D adad !-->

                    </div>
                </div>
            </div>
            <!-- Lesson details -->
            <div class="container-fluid px-0">
                <span id="spanToggleMateri" onclick="showLessons()" style="border-top-right-radius: 1rem; border-bottom-right-radius: 1rem;" class="pt-3 pb-3 px-4 position-fixed">
                    <i class="fas fa-list"></i>
                </span>
                <div class="container pt-2" id="containerLesson">
                    <!-- Ajax -->
                </div>
            </div>
        </div>

        <div class="container container-comment">
            <!-- Input pertanyaan -->
            <form action="" method="POST" id="formQuestion">
                <div class="row new-comment pt-1 pb-2">
                    <div class="col-sm col-md-10 col-lg-10">
                        <input class="form-control montserrat w-100" id="txtComment" placeholder="Write Comment Here" name="question" autocomplete="off"></input>
                        <!-- Begitu diload, input ini lgsg diset valuenya dgn jquery, supaya valuenya sesuai get yg di url. getLessonDetail(103) -->
                        <input type="text" id="idlesson" name="idlesson" hidden>
                    </div>
                    <div class="col-sm col-md-2 col-lg-2">
                        <button type="submit" name="submit" id="btnComment" class="w-100 h-100 montserrat btn-sm btn-lg">Tanya</button>
                    </div>
                </div>
            </form>

            <!-- List pertanyaan -->
            <div id="containerQuestions">

            </div>
        </div>
    </div>
</body>
<!-- Ajax script for side nav lesson list -->
<script src="assets/js/sidenav.js"></script>