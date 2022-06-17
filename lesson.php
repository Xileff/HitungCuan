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

$idsubject = $_GET['subject']; 
$idlesson = $_GET['idlesson'];

$subjectName = $conn->query("SELECT nama_subject FROM subject WHERE id = $idsubject")->fetch_assoc()['nama_subject'];
$lessonsList = $conn->query("SELECT * FROM lessons WHERE id_subject = $idsubject");
$thisLesson = $conn->query("SELECT * FROM lessons WHERE id = $idlesson AND id_subject = $idsubject")->fetch_assoc();

// input pertanyaan
if(isset($_POST['submit'])){
    $inputQuestion = htmlspecialchars($_POST['question']);
    $userId = $user['id'];
    $date = date('Y-m-d');

    $conn->query("INSERT INTO lessons_question VALUES('', $userId, $idlesson, '$date', '$inputQuestion', 0)");

    if($conn->affected_rows === 1) {
        alertSuccess('Berhasil', 'Pertanyaan anda sudah terupload', 'Ok');
    }

    else {
        alertRedirect('Kesalahan server', 'Pertanyaan anda tidak terupload, silakan coba lagi', '', 'Ok');
        echo $conn->error;
        return;
    }
}
?>

<body>
    <div class="mt-5 pt-5">
        <div class="overlay d-none" onclick="showLessons()"></div>
        <!-- New sidebar -->
        <div id="lesson-side-bar" class="position-fixed h-100 top-0 left-0 bottom-0 sidebar-hide">
            <button class="position-absolute" style="background: none; right: 0; border: none; color: white;" onclick="showLessons()"><span class="fw-bold montserrat">X</span></button>
            <div class="w-75 mx-auto">
                <h3 class="poppins text-center m-3"><?=$subjectName?></h1>
                <div class="bg-light rounded-1">
                    <input type="text" id="inputSubject" hidden value="<?=$_GET['subject']?>">
                    <input type="text" class="form-control montserrat" id="searchLesson" placeholder="Search lessons here">
                </div>
                <div id="lessonList">
                    <?php while($lesson = $lessonsList->fetch_assoc()):?>
                        <a href="?page=lesson&subject=<?=$lesson['id_subject']?>&idlesson=<?=$lesson['id']?>" class="m-4 sidebar-lesson-link fw-bold">
                            <div class="row row-lessons w-100 mx-auto position-relative mt-2 mb-2">
                                <div class="background-zoom bgLesson w-100 h-100 m-0 p-0 position-absolute start-0 top-0" style="background-image: url('assets/images/CuanCademy/Subject-Containers/lessonbg.jpg')"></div>
                                <div class="blackOverlay w-100 h-100 m-0 p-0 position-absolute top-0 start-0"></div>
                                <p class="text-center pt-2 pb-2 m-0 fs-4" style="z-index: 2;"><?=$lesson['judul']?></h1>
                            </div>
                        </a>
                    <?php endwhile;?>
                </div>
            </div>
        </div>
        <!-- New sidebar -->
        <div class="container-fluid px-0">
            <span id="spanToggleMateri" onclick="showLessons()" style="border-top-right-radius: 1rem; border-bottom-right-radius: 1rem;" class="pt-3 pb-3 px-4 position-fixed">
                <i class="fas fa-list"></i>
            </span>
            <div class="container pt-2">
                <div class="row">
                    <h1 class="poppins"><?=$thisLesson['judul']?></h1>
                    <p class="fs-6 mb-0" style="color: gray;"><?=tgl_indo($thisLesson['tanggal'])?></p>
                    <div class="news-image mt-3 mb-4">
                        <img src="assets/images/CuanCademy/lessons/<?=$thisLesson['gambar']?>" alt="news_image" class="w-100">
                    </div>
                    <p class="montserrat fs-5" style="color: gray;"><?=$thisLesson['teks']?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container container-comment">
        <!-- Input komentar -->
        <form action="" method="POST">
            <div class="row new-comment pt-1 pb-2">
                <div class="col-sm col-md-10 col-lg-10">
                    <input class="form-control montserrat w-100" id="txtComment" placeholder="Write Comment Here" name="question"></input>
                </div>
                <div class="col-sm col-md-2 col-lg-2">
                    <button type="submit" name="submit" id="btnComment" class="w-100 h-100 montserrat btn-sm btn-lg">Tanya</button>
                </div>
            </div>
        </form>

        <!-- List komentar -->
        <?php 
            $questions = $conn->query("SELECT * FROM lessons_question WHERE id_lesson = '$idlesson'")
        ?>
        <?php if(mysqli_num_rows($questions) === 0):?>
            <div class="pt-4 px-2">
                <h3 style="color: gray;">There are no questions yet</h3>
            </div>
        <?php else:?>
            <?php while($question = $questions->fetch_assoc()):?>
                <?php $user = $conn->query("SELECT username, foto FROM users WHERE id=" . $question['id_user'])->fetch_assoc()?>
                <div class="row posted-comment pt-4 px-2">
                    <div class="wrapper-comment">
                        <div class="user-img">
                            <img src="assets/images/users-profile/<?=$user['foto']?>" alt="user" class="img-fluid" style="border-radius: 100%;">
                        </div>
                        <div class="px-3 pt-1 pb-1">
                            <p class="comment-author mb-0"><?=$user['username']?></p>
                            <p class="comment-date mb-2">At <?=$question['tanggal']?></p>
                            <p class="comment-text text-wrap">
                                <?=$question['teks']?>
                            </p>
                        </div>
                    </div>
                    <?php if($question['answered']):
                        $jsonAnswer = json_encode($conn->query("SELECT * FROM lessons_question_answer WHERE id_question = " . $question['id'])->fetch_assoc());
                        echo $question['id'];
                        $a = json_decode($jsonAnswer);
                        ?>
                        <div class="row lesson-answer border-hitungcuan rounded-3 p-2" style="background-color: #1f1f1e;">
                            <p class="fs-6 mb-0">Admin 
                                <?php 
                                $jsonAdmin = json_encode($conn->query("SELECT username FROM admin WHERE id = " . $a->id_admin)->fetch_assoc());
                                
                                echo json_decode($jsonAdmin)->username;
                                ?>'s answer
                            </p>
                            <p class="fs-6">At <?=tgl_indo($a->tanggal)?></p>
                            <p class="fs-6"><?=$a->teks?></p>
                        </div>
                    <?php endif?>
                </div>
            <?php endwhile?>
        <?php endif?>
    </div>
</body>
<!-- Ajax script for side nav lesson list -->
<script src="assets/js/sidenav.js"></script>
<script>
    const searchLesson = document.getElementById('searchLesson');
    const inputSubject = document.getElementById('inputSubject');
    const lessonList = document.getElementById('lessonList');

    searchLesson.addEventListener('keyup', function(){
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                lessonList.innerHTML = xhr.responseText;
            }
        }

        xhr.open("GET", `logic/ajax/lessonList.php?lesson=${searchLesson.value}&idSubject=${inputSubject.value}`, true);
        xhr.send();
    })
</script>

<!-- Script for asking question -->
<script>
    document.getElementById('btnComment').addEventListener('click', e => {
        if(document.getElementById('txtComment').value.length < 1 /** kurang dari 1 huruf, maka preventdefault */) {
            alertError('Pertanyaan kosong', 'Ketiklah sesuatu sebelum anda mengupload pertanyaan ini','Ok');
            e.preventDefault();
        }
    });
</script>