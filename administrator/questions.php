<script src="administrator/httprequest/request/questions.js" type="module"></script>
<div class="container mt-5 pt-5">
    <h1 class="fw-bold text-center">Questions</h1>
    <select name="" id="selectSubject" class="form-select mb-2 rounded-pill">
        <option value="-1">All</option>
        <option value="1">Income Management</option>
        <option value="2">Expenses</option>
        <option value="3">Investment</option>
    </select>
    <table class="table table-hover table-dark text-center montserrat">
        <thead>
            <tr>
                <th>Question ID</th>
                <th>Username</th>
                <th>Lesson</th>
                <th>Subject</th>
                <th>Tanggal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <!--  -->
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark" style="border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 0.8rem">
                <div class="modal-header">
                    <h5 class="modal-title font-green" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="username" class="text-info mb-1"></p>
                    <p id="questionLesson" class="mb-1"></p>
                    <p id="questionDate" class="mb-1"></p>
                    <br>
                    <p class="mb-0 text-info">Question : </p>
                    <p id="questionText" class="mb-2"></p>
                    <form id="form" action="" method="post" class="d-flex flex-column">
                        <div class="form-group mb-4">
                            <label class="fw-bold" for="text">Answer</label>
                            <textarea id="text" type="text" name="answer" class="form-control" rows="10" cols="50" style="border-radius: 0.8rem"></textarea>
                        </div>
                        <span class="montserrat text-warning align-self-end mb-1">Jawaban tidak dapat diubah atau dihapus</span>
                        <input type="hidden" name="questionId" id="questionId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btnAnswer" class="btn btn-success rounded-5 align-self-end rounded-pill px-4 montserrat">Answer</button>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
</div>