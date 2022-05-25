<?php 
global $conn;

$idsubject = $_GET['subject']; 
$idlesson = $_GET['idlesson'];

$subjectName = $conn->query("SELECT nama_subject FROM subject WHERE id = $idsubject")->fetch_assoc()['nama_subject'];
$lessonsList = $conn->query("SELECT * FROM lessons WHERE id_subject = $idsubject");
$thisLesson = $conn->query("SELECT * FROM lessons WHERE id = $idlesson AND id_subject = $idsubject")->fetch_assoc();
?>

<body>
    <div class="mt-5 pt-5">
        <div class="overlay d-none" onclick="showLessons()"></div>
        <!-- New sidebar -->
        <div id="lesson-side-bar" class="position-fixed h-100 top-0 left-0 bottom-0 sidebar-hide">
            <button class="position-absolute" style="background: none; right: 0; border: none; color: white;" onclick="showLessons()"><span class="fw-bold montserrat">X</span></button>
            <div class="w-75 mx-auto">
                <h3 class="poppins text-center m-3"><?=$subjectName?></h1>
                <?php while($lesson = $lessonsList->fetch_assoc()):?>
                    <a href="#" class="m-4 sidebar-lesson-link fw-bold">
                        <div class="row row-lessons w-100 mx-auto position-relative">
                            <div class="bgLesson background-zoom w-100 h-100 m-0 p-0 position-absolute start-0 top-0"></div>
                            <div class="blackOverlay w-100 h-100 m-0 p-0 position-absolute top-0 start-0"></div>
                            <p class="text-center pt-2 pb-2 m-0 fs-4" style="z-index: 2;"><?=$lesson['judul']?></h1>
                        </div>
                    </a>
                <?php endwhile;?>
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
                        <img src="images/CuanCademy/lessons/<?=$thisLesson['gambar']?>" alt="news_image" class="w-100">
                    </div>
                    <p class="montserrat fs-5" style="color: gray;"><?=$thisLesson['teks']?></p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'pages/components/html-top.php'?>
    <!-- Other scripts -->
    <script src="js/sidenav.js"></script>
</body>