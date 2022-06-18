$("#ajaxNavbar").ready(function(){
    $.ajax({
        type: 'GET',
        url: 'httprequest/response/getUserVa.php',
        dataType: 'JSON',
        success: function(vaData){
            console.log(vaData)
            result = `
            <li>
                <a href="?page=virtualaccount&idpacket=${vaData.id_packet}&payment=${vaData.payment}" class="dropdown-item navbar-dropdown-menu montserrat">
                Transaction
            <span class="badge rounded-pill bg-danger">Pending</span>
            </a></li>      
            `
            $(result).insertAfter("#navbarLogout")
        }
    })
})