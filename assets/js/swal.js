function alertError(title, text, confirmButtonText){
    Swal.fire({
        title: title.toString(),
        text: text.toString(),
        icon: 'error',
        confirmButtonText: confirmButtonText.toString()
    })
}

function alertErrorRefresh(title, text, confirmButtonText){
    Swal.fire({
        title: title.toString(),
        text: text.toString(),
        icon: 'error',
        confirmButtonText: confirmButtonText.toString().then(function(){
            window.location.reload();
        })
    })
}

function alertSuccess(title, text, confirmButtonText){
    Swal.fire({
        title: title.toString(),
        text : text.toString(),
        icon : 'success',
        confirmButtonText : confirmButtonText.toString()
    })
}

function successRedirect(title, text, confirmButtonText, link){
    Swal.fire({
        title: title.toString(),
        text : text.toString(),
        icon : 'success',
        confirmButtonText : confirmButtonText.toString()
    }).then(function() {
        window.location = link.toString();
    })
}

function alertRedirect(title, text, link, confirmButtonText){
    Swal.fire({
        title: title.toString(),
        text: text.toString(),
        confirmButtonText : confirmButtonText.toString()
      }).then(function() {
        window.location = link.toString();
      })
}

function errorRedirect(title, text, confirmButtonText, link){
    Swal.fire({
        title: title.toString(),
        text : text.toString(),
        icon : 'error',
        confirmButtonText : confirmButtonText.toString()
    }).then(function() {
        window.location = link.toString();
    })   
}