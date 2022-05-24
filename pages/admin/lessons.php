<?php global $conn;?>
<div class="container mt-5 pt-5 montserrat">
    <h1 class="fw-bold text-center">Lessons</h1>
    <a href="?page=news&action=addnews">
        <button class="btn btn-success m-1">Add New</button>
    </a>
    <table class="table table-hover table-dark text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>ID Author</th>
                <th>Release Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $allNews = $conn->query("SELECT * FROM news")?>
            <?php while($news = $allNews->fetch_assoc()):?>
                <tr>
                    <td><?=$news['id']?></td>
                    <td><?=$news['judul_berita']?></td>
                    <td>
                        <?php $idAuthor = $news['id_author']; echo $conn->query("SELECT nama FROM author WHERE id = $idAuthor")->fetch_assoc()['nama'];?>
                    </td>
                    <td><?=$news['tanggal_rilis']?></td>
                    <td class="p-2">
                        <a href="?page=news&action=editnews&id=<?=$news['id']?>">
                            <button class="btn btn-warning rounded w-100 mx-auto mb-1 p-1 px-3 text-center">Edit</button>
                        </a>
                        <a href="?page=news&action=deletenews&id=<?=$news['id']?>">
                            <button class="btn btn-danger rounded w-100 mx-auto mb-1 p-1 px-3 text-center">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile;?>
        </tbody>
    </table>
</div>