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

function swalConfirm(paramTitle, paramText, paramConfirmButtonText, paramCancelButtonText, paramTitleSuccess, paramTitleSuccessText, paramTitleCancel, paramTitleCancelText){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: paramTitle,
        text: paramText,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: paramConfirmButtonText,
        cancelButtonText: paramCancelButtonText,
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          swalWithBootstrapButtons.fire(
            paramTitleSuccess,
            paramTitleSuccessText,
            'success'
          )
        } else if (
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            paramTitleCancel,
            paramTitleCancelText,
            'error'
          )
        }
      })
}