import { validateUsername, validateEmail, validateName }from './mixins.js'

$(this).ready(function(){
    const txtNamaLengkap = $('input[name="nama"]')
    const txtUsername = $('input[name="username"]')
    const txtEmail = $('input[name="email"]')
    const txtPassword = $('input[name="password"]')
    const txtConfirmPassword = $('input[name="confirmPassword"]')

    $('#btnLogin').click(function(e){
        e.preventDefault()
        if(!validateName(txtNamaLengkap.val())) {
            alertError('Error', 'Format nama tidak benar', 'Ok')
            return
        }
        if(!validateUsername(txtUsername.val()) || txtUsername.val().length < 8){
            alertError('Error', 'Format username tidak valid' ,'Ok')
            return
        }
        if(!validateEmail(txtEmail.val())) {
            alertError('Error', 'Format email tidak valid,' ,'Ok')
            return
        }
        if(txtPassword.val().length < 8){
            alertError('Error', 'Password terlalu singkat' ,'Ok')
            return
        }
        if(txtPassword.val().length > 16){
            alertError('Error', 'Password terlalu panjang' ,'Ok')
            return
        }
        if(txtPassword.val() !== txtConfirmPassword.val()){
            alertError('Error', 'Password tidak sama dengan konfirmasi password','Ok')
            return
        }
        
        $.ajax({
            type: 'POST',
            url: 'httprequest/response/postRegister.php',
            data: $('#formRegister').serialize(),
            dataType: 'json',
            success: response => {
                console.log(response)
                if(response.success){
                    successRedirect('Success', 'Anda berhasil registrasi, silakan login dengan akun baru Anda', 'Login', '?page=login')
                }
                else {
                    alertError('Error', response.msg, 'Ok');
                }
            }
        })
    })
})