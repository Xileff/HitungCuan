<script>
    $(this).ready(function() {
        $.ajax({
            type: 'GET',
            url: 'administrator/httprequest/response/getFeedback.php',
            dataType: 'json',
            success: feedbacks => {
                let tr = ""
                $.each(feedbacks, (i, f) => {
                    tr += `
                <tr class="text-light">
                    <td>${f.id}</td>
                    <td>${f.username}</td>
                    <td>${f.tanggal}</td>
                    <td>${f.teks}</td>
                </tr>
                `
                })

                $('tbody').html(tr)
            }
        })
    })
</script>

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
        </tbody>
    </table>
</div>