<?php 
require '../../logic/dbconn.php';
global $conn;

$lessonName = $_GET['lesson'];
$idSubject = $_GET['idSubject'];

if ($lessonName === '') {
    $lessonList = $conn->query("SELECT * FROM lessons WHERE id_subject = $idSubject");
} else {
    $lessonList = $conn->query("SELECT * FROM lessons WHERE id_subject = $idSubject AND judul LIKE '%$lessonName%'");
}
?>

<?php if(mysqli_num_rows($lessonList) > 0):?>
    <?php while($lesson = $lessonList->fetch_assoc()):?>
        <a href="?page=lesson&subject=<?=$lesson['id_subject']?>&idlesson=<?=$lesson['id']?>" class="m-4 sidebar-lesson-link fw-bold">
            <div class="row row-lessons w-100 mx-auto position-relative">
                <div class="background-zoom bgLesson w-100 h-100 m-0 p-0 position-absolute start-0 top-0" style="background-image: url('assets/images/CuanCademy/Subject-Containers/lessonbg.jpg')"></div>
                <div class="blackOverlay w-100 h-100 m-0 p-0 position-absolute top-0 start-0"></div>
                <p class="text-center pt-2 pb-2 m-0 fs-4" style="z-index: 2;"><?=$lesson['judul']?></h1>
            </div>
        </a>
    <?php endwhile;?>
<?php else:?>
    <div class="p-5">
        <p class="fs-3">No lessons with such name found</p>
    </div>
<?php endif?>