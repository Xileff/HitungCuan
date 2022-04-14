<?php 

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

?>