$(document).ready(function(){
    $('#btnLogin').click(function(e){
        e.preventDefault();
        let dataSend = $('#formLogin').serialize();
        // console.log(dataSend)
        $.ajax({
            type: 'POST',
            url: 'httprequest/response/postLogin.php',
            data: dataSend,
            dataType: 'json',
            success: function(response){
                console.log(response)
                // response dari echo di addBook.php
                // if(response == 1){
                //     alert('Berhasil input buku');
                // }
                // else {
                //     alert('Gagal input buku, silakan coba lagi')
                // }
                // // refresh buku
                // getBooks();
                // $('#btnCloseModal').click();
            }
        })
    })
})