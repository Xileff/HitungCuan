<?php 

function renderPageOrHome($page = 'homepage'){
    if ($page === 'login' || $page === 'logout') {
        include 'pages/' . $page . '.php';    
    } else {
        include 'pages/components/html-navbar.php';
        include 'pages/' . $page . '.php';
        include 'pages/components/html-footer.php';   
    }
}

function alertError($heading, $message, $button){
    echo "
    <script>
        alertError('$heading', '$message', '$button');
    </script>";
    return false;
}

function alertSuccess($heading, $message, $button){
    echo "
    <script>
        alertSuccess('$heading', '$message', '$button');
    </script>";
    return false;
}

function alertRedirect($title, $text, $link, $confirmButtonText){
    echo "
    <script>
        alertRedirect('$title', '$text', '$link', '$confirmButtonText');
    </script>
    ";
}

function register($name, $username, $email, $password){
    global $conn;

    $name = htmlspecialchars($name);
    $username = htmlspecialchars($username);
    $email = htmlspecialchars($email);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users VALUES ('','$name','$username','$email','$password','','','','')");

    return $conn->affected_rows;
}

function login($table, $username, $password){
    global $conn;
    $hash = $conn->query("SELECT password FROM $table WHERE username = '$username'")->fetch_assoc()['password'];

    return password_verify($password, $hash);
}
?>