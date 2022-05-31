<?php 
function uploadImage($image, $dir){
    $nameWithExtension = $image['name'];
    $size = $image['size'];
    $tmpName = $image['tmp_name'];
    $result = false;

    if($image['error'] === 4){
        alertRedirect('Error', 'Tidak ada gambar yang diupload','','Ok');
        return $result;
    }

    if($size > 1048576){
        alertRedirect('Error', 'Ukuran melebihi 1MB!', '', 'Ok');
        return $result;
    }

    $extension = strtolower(end(explode(".",$nameWithExtension)));
    $imageExtensions = ['jpg', 'png', 'jpeg'];

    if(!in_array($extension, $imageExtensions)){
        alertRedirect('Error', 'File bukan gambar!', '', 'Ok');
        return $result;
    }

    $name = uniqid() . "." . $extension;
    if(move_uploaded_file($tmpName, $dir . $name)){
        $result = $name;
    }

    return $result;
}

function remember($username) {
    global $conn;
    $user = $conn->query("SELECT id, username FROM users WHERE username = '$username'")->fetch_assoc();
    setcookie('id', $user['id'], time() + 3600);
    setcookie('key', hash('sha256', $user['username']), time() + 3600);
}

function alertError($heading, $message, $button){
    echo "
    <script>
        alertError('$heading', '$message', '$button');
    </script>";
    return false;
}

function alertErrorRefresh($heading, $message, $button){
    echo "
    <script>
        alertErrorRefresh('$heading', '$message', '$button');
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

    $conn->query("INSERT INTO users VALUES ('','$name','$username','$email','$password','','','nophoto.jpg','" . date('Y-m-d') ."')");

    return $conn->affected_rows;
}

function login($table, $username, $password){
    global $conn;
    $hash = $conn->query("SELECT password FROM $table WHERE username = '$username'")->fetch_assoc()['password'];

    return password_verify($password, $hash);
}

function refresh($delay = 0){
    header("refresh:$delay; url=" . $_SERVER['REQUEST_URI']);
}

function delayedRedirect($url, $delay = 0){
    header("refresh:$delay; url=$url");   
}

function tgl_indo($date){
	$months = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$dateParts = explode('-', $date);
 
	return $dateParts[2] . ' ' . $months[(int)$dateParts[1]] . ' ' . $dateParts[0];
}
?>