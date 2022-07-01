<script src="administrator/httprequest/request/requests.js" type="module"></script>
<div class="container mt-5 pt-5">
    <h1 class="fw-bold text-center">Requests</h1>
    <select name="" id="selectSubject" class="form-select mb-2">
        <option value="-1">All</option>
        <option value="1">Income Management</option>
        <option value="2">Expenses</option>
        <option value="3">Investment</option>
    </select>
    <table class="table table-hover table-dark text-center">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Username</th>
                <th>Subject</th>
                <th>Date Posted</th>
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