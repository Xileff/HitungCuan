<?php 
global $conn;

$feedbacks = $conn->query("SELECT * FROM feedback");
?>

<div class="container mt-5 pt-5 montserrat">
    <h1>Feedback</h1>
    <table class="table bg-dark">
    <thead>
        <tr class="text-info">
            <th>ID</th>
            <th>Username</th>
            <th>Tanggal</th>
            <th>Teks</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($feedback = $feedbacks->fetch_assoc()):?>
        <tr class="text-light">
            <td><?=$feedback['id']?></td>
            <td><?=$feedback['username']?></td>
            <td><?=tgl_indo($feedback['tanggal'])?></td>
            <td><?=$feedback['teks']?></td>
        </tr>
        <?php endwhile?>
    </tbody>
    </table>
</div>