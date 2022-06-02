<?php 
global $conn;
if(!isset($_SESSION['username'])){
    alertRedirect('Belum login', 'Anda harus login sebelum menggunakan fitur ini', '?page=login', 'Ok');
    return;
}

$user = getLoggedUserData();
if(!isPremiumUser($user['id'])){
    alertRedirect('Anda bukan premium user', 'Fitur ini hanya tersedia untuk premium user', './', 'Ok');
    return;
}
?>
<body>
    <div class="container p-5 mt-5">
        <div class="container-fluid" data-aos="fade-up">
            <a href="?page=lesson&subject=1&idlesson=1" class="link-unstyled">
                <div class="row p-5 mt-5 mb-5 row-subjects position-relative">
                    <div id="bgSubjectIncome" class="w-100 h-100 position-absolute background-zoom start-0 top-0 border-radius-10"></div>
                    <div class="blackOverlay w-100 h-100 mx-0 mt-0 mb-0 p-0 position-absolute top-0 start-0">
                    </div>
                    <h1 class="text-center">Income Management</h1>
                </div>
            </a>
            <a href="?page=lesson&subject=2&idlesson=1"  class="link-unstyled">
                <div class="row p-5 mt-5 mb-5 row-subjects position-relative">
                    <div id="bgSubjectExpenses" class="w-100 h-100 position-absolute background-zoom start-0 top-0 border-radius-10"></div>
                    <div class="blackOverlay w-100 h-100 mx-0 mt-0 mb-0 p-0 position-absolute top-0 start-0">
                    </div>
                    <h1 class="text-center">Expenses</h1>
                </div>
            </a>
            <a href="?page=lesson&subject=3&idlesson=1"  class="link-unstyled">
                <div class="row p-5 mt-5 mb-5 row-subjects position-relative">
                    <div id="bgSubjectInvestment" class="w-100 h-100 position-absolute background-zoom start-0 top-0 border-radius-10"></div>
                    <div class="blackOverlay w-100 h-100 mx-0 mt-0 mb-0 p-0 position-absolute top-0 start-0">
                    </div>
                    <h1 class="text-center">Investment</h1>
                </div>
            </a>
        </div>
    </div>
</body>