<script src="httprequest/request/getLessonDetail.js" type="module"></script>
<script src="httprequest/request/getLessonList.js" type="module"></script>
<script src="httprequest/request/postAskQuestion.js" type="module"></script>
<script src="httprequest/request/postRequestMateri.js" type="module"></script>

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
                        <input type="text" class="form-control montserrat" id="searchLesson" placeholder="Search lessons here">
                    </div>
                    <div id="lessonList">
                        <!--D adad !-->

                    </div>
                    <section class="w-100 d-flex justify-content-center">
                        <button id="btnRequest" class="montserrat btn-sm btn-lg fw-bold rounded-pill px-5" style="background-color: rgb(117, 249, 145);" data-bs-toggle="modal" data-bs-target="#modal">
                            <span class="fs-6">Request</span>
                        </button>
                    </section>
                </div>
            </div>
            <!-- Lesson details -->
            <div class="container-fluid px-0">
                <span id="spanToggleMateri" onclick="showLessons()" style="border-top-right-radius: 1rem; border-bottom-right-radius: 1rem;" class="pt-3 pb-3 mb-3 px-4 position-fixed">
                    <i class="fas fa-list"></i>
                </span>
                <div class="container pt-2 mb-2" id="containerLesson">
                    <!-- Ajax -->
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark px-2" style="border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 0.8rem">
                        <div class="modal-header">
                            <h5 class="modal-title poppins font-green" id="exampleModalLabel">Request Materi</h5>
                            <button type="button" class="btn-close color-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body montserrat">
                            <form id="form" action="" method="post" class="d-flex flex-column">
                                <h5>Subject</h5>
                                <select name="subject" id="selectSubject" class="form-select mb-3" style="border-radius: 0.5rem;">
                                    <option value="1">Income Management</option>
                                    <option value="2">Expenses Management</option>
                                    <option value="3">Investment</option>
                                </select>
                                <div class="form-group mb-4">
                                    <p class="montserrat fs-6 mb-0">Apa yang ingin anda pelajari lebih lanjut?</p>
                                    <textarea id="text" type="text" name="text" class="form-control" rows="5" cols="50" style="border-radius: 0.5rem;"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btnSubmitRequest" class="btn montserrat rounded-pill px-4 align-self-end" style="background-color: rgb(117, 249, 145);">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
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