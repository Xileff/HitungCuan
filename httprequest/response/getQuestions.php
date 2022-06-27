<?php
require '../../logic/dbconn.php';
require '../../logic/functions.php';
$idlesson = $_GET['idlesson'];

$result = [
    'isEmpty' => true,
    'questions' => []
];

$questions = $conn->query("SELECT * FROM tbl_lessons_question WHERE id_lesson = $idlesson ORDER BY tanggal DESC");

if ($questions->num_rows > 0) {
    $result['isEmpty'] = false;

    // Untuk setiap pertanyaan
    while ($question = $questions->fetch_assoc()) {
        $userData = $conn->query("SELECT username, foto FROM tbl_users WHERE id = " . $question['id_user'])->fetch_assoc();

        // tambahkan indeks baru di question untuk menampung data user(username & foto)
        $question['userData'] = $userData;
        $question['tanggal'] = tgl_indo($question['tanggal']);

        if ($question['answered']) {
            // ambil data jawaban dan admin yang menjawab
            $answer = $conn->query("SELECT id_admin, tanggal, teks FROM tbl_lessons_question_answer WHERE id_question = " . $question['id'])->fetch_assoc();
            $answer['tanggal'] = tgl_indo($answer['tanggal']);
            $adminUsername = $conn->query("SELECT username FROM tbl_admin WHERE id = " . $answer['id_admin'])->fetch_assoc();

            // tambahkan indeks baru di question utk menampung jawaban & admin
            $question['answerData'] = array_merge($answer, $adminUsername);
        }

        // masukin question ke array questions di dalam result
        $result['questions'][] = $question;
    }
}
echo json_encode($result);
