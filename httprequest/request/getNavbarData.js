$(document).ready(function(){
    let vaData = {}
    $.ajax({
        type: 'POST',
        url: 'httprequest/response/postUserData.php',
        dataType: 'JSON',
        success: function(response) {
            console.log(response)
            result = ``
            if(!response){
                result = `
                <li class="nav-item" id="nav-item-login">
                    <a href="?page=login" class="nav-link w-100" id="nav-link-login">Log In</a>
                </li>`
            }
            else {
                result = `
                <li class="nav-item px-2 pb-1 pt-1">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex flex-row align-items-center" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="ratio ratio-1x1 d-inline-block mx-2" style="width: 2.1rem;">
                                <img src="assets/images/users-profile/${response.foto}" alt="navbar-profile-image" class="img-fluid article-img rounded-circle" style="height: 2.1rem; object-fit:cover">
                            </div>
                            <span class="montserrat text-center mx-1 mb-0 d-inline-block">${response.username}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownDarkMenuLink">
                            <li><a class="dropdown-item navbar-dropdown-menu montserrat" href="?page=userprofile">Profile</a></li>
                            <li><a class="dropdown-item navbar-dropdown-menu montserrat" href="?page=logout">Log Out</a></li>
                            ${
                                (function(){
                                    liVirtualAccount = ``
                                    if(response.id_packet){
                                        liVirtualAccount = `
                                        <li>
                                            <a href="?page=virtualaccount&idpacket=${response.id_packet}&payment=${response.payment}" class="dropdown-item navbar-dropdown-menu montserrat">
                                            Transaction
                                        <span class="badge rounded-pill bg-danger">Pending</span>
                                        </a></li>      
                                        `
                                    }

                                    return liVirtualAccount
                                })()
                            }
                        </ul>
                    </li>
                </li>
                `
            }

            $('#ajaxNavbar').html(result)
        }
    })

    // query buat cek apakah user punya VA atau tidak
    function getUserVa(param){
        $.ajax({
            type: 'GET',
            url: 'httprequest/response/getUserVa.php',
            data: {id: param},
            dataType: 'JSON',
            success: function(response){
                // console.log(response)
                // ubah variabel global
                vaData = response
            }
        })
    }

    function getAjaxInnerValue(varToBeFilled, ajaxResponse){
        console.log(ajaxResponse)
        varToBeFilled = ajaxResponse
    }
})