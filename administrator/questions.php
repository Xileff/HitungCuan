<?php
global $conn;
$questions = $conn->query("SELECT id, id_lesson, tanggal, teks FROM tbl_lessons_question WHERE answered = 0");
?>
<div class="container mt-5 pt-5">
    <?php if ($questions->num_rows === 0) : ?>
        <h1>There are no unanswered questions.</h1>
    <?php else : ?>
        <h1 class="fw-bold text-center">Questions</h1>
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
                <?php foreach ($questions as $q) :
                    $jsonQuestion = json_encode($q);
                    $question = json_decode($jsonQuestion);
                    $idQuestion = $question->id;
                ?>
                    <tr>
                        <td><?= $question->id ?></td>
                        <td>
                            <?php
                            $idLesson = $question->id_lesson;
                            $subject = $conn->query("SELECT nama_subject FROM subject WHERE id = (SELECT id_subject FROM lessons where id = $idLesson)")->fetch_assoc();
                            $jsonSubject = json_encode($subject);
                            $subject = json_decode($jsonSubject);

                            echo $subject->nama_subject;
                            ?>
                        </td>
                        <td><?= $question->tanggal ?></td>
                        <td><?= $question->teks ?></td>
                        <td class="p-2">
                            <a href="<?= "?page=answerquestions&action=add&id=$idQuestion" ?>" class="w-50">
                                <button class="btn btn-warning rounded mx-auto mb-1 p-1 px-3 text-center">See more</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>