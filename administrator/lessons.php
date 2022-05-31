<?php 

global $conn;
$lessons = $conn->query("SELECT * FROM lessons");
?>
<div class="container mt-5 pt-5 montserrat">
    <h1 class="fw-bold text-center">Lessons</h1>
    <a href="?page=lessons&action=add">
        <button class="btn btn-success m-1">Add New</button>
    </a>
    <table class="table table-hover table-dark text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Subject</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($lesson = $lessons->fetch_assoc()):?>
                <tr>
                    <td><?=$lesson["id"]?></td>
                    <td><?=$lesson["id_subject"]?></td>
                    <td><?=$lesson["judul"]?></td>
                    <td><?=$lesson["tanggal"]?></td>
                    <td class="p-2">
                        <a href="?page=lessons&action=edit&id=<?=$lesson["id"]?>">
                            <button class="btn btn-warning rounded w-100 mx-auto mb-1 p-1 px-3 text-center">Edit</button>
                        </a>
                        <a href="?page=lessons&action=delete&id=<?=$lesson["id"]?>">
                            <button class="btn btn-danger rounded w-100 mx-auto mb-1 p-1 px-3 text-center">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile;?>
        </tbody>
    </table>
</div>