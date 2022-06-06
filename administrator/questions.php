<?php 
global $conn;
?>

<div class="container mt-5 pt-5">
    <h1 class="fw-bold text-center">Lessons</h1>
    <table class="table table-hover table-dark text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Tanggal</th>
                <th>Teks</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $questions = $conn->query("SELECT id, id_lesson, tanggal, teks FROM lessons_question")?>
            <?php foreach($questions as $q):
                $jsonQuestion = json_encode($q);
                $question = json_decode($jsonQuestion);
                ?>
                <tr>
                    <td><?=$question->id?></td>
                    <td>
                        <?php 
                        $idLesson = $question->id_lesson;
                        $subject = $conn->query("SELECT nama_subject FROM subject WHERE id = (SELECT id_subject FROM lessons where id = $idLesson)")->fetch_assoc();
                        $jsonSubject = json_encode($subject);
                        $subject = json_decode($jsonSubject);

                        echo $subject->nama_subject;
                        ?>
                    </td>
                    <td><?=$question->tanggal?></td>
                    <td><?=$question->teks?></td>
                    <td class="p-2">
                        <a href="#" class="w-50">
                            <button class="btn btn-warning rounded mx-auto mb-1 p-1 px-3 text-center">See more</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>