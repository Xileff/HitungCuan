$(document).ready(function(){
    $.ajax({
        type: 'POST',
        url: 'httprequest/response/postUserData.php',
        dataType: 'JSON',
        success: function(response) {
            console.log(response)
            if(response){
                $('#ajaxNavbar').html(`
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle d-flex flex-row align-items-center" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="ratio ratio-1x1 d-inline-block mx-2" style="width: 2.1rem;">
                                <img src="assets/images/users-profile/${response.foto}" alt="navbar-profile-image" class="img-fluid article-img rounded-circle" style="height: 2.1rem; object-fit:cover">
                            </div>
                            ${
                                (function(){
                                    return `<span class="montserrat text-center mx-1 mb-0 d-inline-block" ${response.premium === true ? `style="color:yellow"` : ''}>${response.username}</span>`
                                })()
                            }
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownDarkMenuLink">
                            <li>
                                <a class="dropdown-item navbar-dropdown-menu montserrat" href="?page=userprofile">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item navbar-dropdown-menu montserrat" href="?page=logout">Log Out</a>
                            </li>
                            ${
                                (function(){
                                    return response.id_packet ? `
                                    <li>
                                        <a href="?page=virtualaccount&packetId=${response.id_packet}&payment=${response.payment}" class="dropdown-item navbar-dropdown-menu montserrat">
                                        Transaction
                                    <span class="badge rounded-pill bg-danger">Pending</span>
                                    </a></li>      
                                    ` : ``
                                })()
                            }
                        </ul>
                    </li>
                `)
            } else {
                $('#ajaxNavbar').html(`
                <li class="nav-item" id="nav-item-login">
                    <a href="?page=login" class="nav-link w-100" id="nav-link-login">Log In</a>
                </li>
                `)
            }
        }
    })
})