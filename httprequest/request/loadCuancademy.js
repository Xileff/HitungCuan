$(document).ready(function(){
    $.ajax({
        type: 'POST',
        url: 'httprequest/response/checkAccount.php',
        dataType: 'JSON',
        success: function(response){
            const code = response.code
            switch(code){
                case 0:
                    $('#containerCuancademy').html(`<h1 class="p-5">Belum login<h1>`)
                    alertRedirect('Belum Login', 'Anda harus login terlebih dahulu', '?page=login', 'Ok')
                    break
                case 1:
                    $('#containerCuancademy').html(`<h1 class="p-5">Hanya untuk user premium<h1>`)
                    alertRedirect('Maaf', 'Fitur ini hanya tersedia untuk akun premium', 'Ok')
                    break
                case 2:
                    $('#containerCuancademy').html(`
                    <div class="container-fluid" data-aos="fade-up">
                        <a href="?page=lesson&subject=1&idlesson=1" class="link-unstyled">
                            <div class="row p-5 mt-5 mb-5 row-subjects position-relative">
                                <div id="bgSubjectIncome" class="w-100 h-100 position-absolute background-zoom start-0 top-0 border-radius-10"></div>
                                <div class="blackOverlay w-100 h-100 mx-0 mt-0 mb-0 p-0 position-absolute top-0 start-0">
                                </div>
                                <h1 class="text-center">Income Management</h1>
                            </div>
                        </a>
                        <a href="?page=lesson&subject=2&idlesson=1" class="link-unstyled">
                            <div class="row p-5 mt-5 mb-5 row-subjects position-relative">
                                <div id="bgSubjectExpenses" class="w-100 h-100 position-absolute background-zoom start-0 top-0 border-radius-10"></div>
                                <div class="blackOverlay w-100 h-100 mx-0 mt-0 mb-0 p-0 position-absolute top-0 start-0">
                                </div>
                                <h1 class="text-center">Expenses</h1>
                            </div>
                        </a>
                        <a href="?page=lesson&subject=3&idlesson=1" class="link-unstyled">
                            <div class="row p-5 mt-5 mb-5 row-subjects position-relative">
                                <div id="bgSubjectInvestment" class="w-100 h-100 position-absolute background-zoom start-0 top-0 border-radius-10"></div>
                                <div class="blackOverlay w-100 h-100 mx-0 mt-0 mb-0 p-0 position-absolute top-0 start-0">
                                </div>
                                <h1 class="text-center">Investment</h1>
                            </div>
                        </a>
                    </div>
                </div>
                    `)
                    break
            }
        }
    })
})