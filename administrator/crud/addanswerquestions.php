<?php 
global $conn;

if(!isset($_GET['id'])){
    alertRedirect('Error', 'Pertanyaan tidak ditemukan', '?page=questions&action=none','Ok');
    return;
}

$idQuestion = $_GET['id'];
$question = $conn->query("SELECT * FROM lessons_question WHERE id = $idQuestion")->fetch_assoc();

if(!$question){
    alertRedirect('Error', 'Pertanyaan tidak ditemukan', '?page=questions&action=none','Ok');
    return;
}

if($question['answered']){
    alertRedirect('Error', 'Pertanyaan sudah dijawab', '?page=questions&action=none','Ok');
    return;
}

$jsonQuestion = json_encode($question);
$q = json_decode($jsonQuestion);


// submit jawaban
if(isset($_POST['submit'])){
    $answer = htmlspecialchars($_POST['text']);
    $idAdmin = $conn->query("SELECT id FROM admin WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];
    $date = date('Y-m-d');
    
    $conn->query("INSERT INTO lessons_question_answer VALUES('', '$idQuestion', '$idAdmin', '$date', '$answer')");

    // klo berhasil uplaod jawaban, update status pertanyaan mjd answered = true
    if($conn->affected_rows !== 1){
        alertError('Gagal', 'Kesalahan server, silakan coba lagi', 'Ok');
        return;
    }

    $conn->query("UPDATE lessons_question SET answered = 1 WHERE id = $idQuestion");

    if($conn->affected_rows !== 1){
        alertError('Gagal', 'Kesalahan server, silakan coba lagi', 'Ok');
        return;
    }

    alertRedirect('Berhasil', 'Pertanyaan sudah dijawab', '?page=questions&action=none','Ok');
}
?>
<div class="container mt-5 pt-5">
    <h1 class="font-green">Question <?=$q->id?></h1>
    <h3 class="text-secondary">Subject :
        <?php 
            $subject = $conn->query("SELECT nama_subject FROM subject WHERE id = (SELECT id_subject FROM lessons where id = " . $q->id_lesson .")")->fetch_assoc();
            $jsonSubject = json_encode($subject);
            $subject = json_decode($jsonSubject);

            echo $subject->nama_subject;
        ?>
    </h3>
    <br>
    <p class="fs-4"><?=$q->teks?></p>

    <form action="" method="post" class="d-flex flex-column">
        <div class="form-group mb-4">
            <label class="fw-bold" for="text">Teks</label>
            <textarea id="text" type="text" name="text" class="form-control" rows="10" cols="50"></textarea>
        </div>
        <span class="montserrat text-warning align-self-end mb-1">Jawaban tidak dapat diubah atau dihapus</span>
        <button class="btn btn-success rounded-5 align-self-end" name="submit"  id="btnSave" type="submit">Save</button>
    </form>
</div>
<script>
    // cek input
    document.getElementById('btnSave').addEventListener('click', e => {
        const text = document.getElementById('text');
        if(text.value.length < 1){
            alertError('Jawaban kosong', 'Berikan jawaban terlebih dahulu sebelum submit', 'Ok');
            e.preventDefault();
            return;
        }
    })
</script>