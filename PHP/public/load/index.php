<?php

include '../../inc/config.class.php';
include '../../inc/core.class.php';


$status = $_POST['status'];

//Einloggen -> Username
if($status == 1) {
    $username = $_POST['username'];

    if(empty($username)) {
        $error = true;
        $type = 'error';
        $msg = 'Bitte gebe einen Username ein!';
    }

    if(User::CheckUsername($username) == false) {
        $error = true;
        $type = 'error';
        $msg = 'Dieser Username existiert nicht!';
    }

    if($error == false) {
        $success = true;
        $type = 'success';
        $_SESSION['login_username'] = $username;
        $msg = 'Bitte gebe dein Passwort ein';
    }
    
    $array = array(
        "type" => $type,
        "msg" => $msg
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);

}


//Einloggen -> Passwort
if($status == 11) {
    $password = $_POST['password'];

    if(empty($password)) {
        $error = true;
        $type = 'error';
        $msg = 'Bitte gebe einen Username ein!';
    }

    if(User::Check($_SESSION['login_username'], $password) == false) {
        $error = true;
        $type = 'error';
        $msg = 'Das eingegebene Passwort stimmt nicht!';
    }

    if($error == false) {
        $success = true;
        $type = 'success';

        $_SESSION['username'] = $_SESSION['login_username'];

        $msg = 'Erfolg';
    }
    
    $array = array(
        "type" => $type,
        "msg" => $msg
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);

}


//Registrieren -> Username
if($status == 2) {
    $username = $_POST['username'];

    if(empty($username)) {
        $error = true;
        $type = 'error';
        $msg = 'Bitte gebe einen Username ein!';
    }

    if(User::CheckUsername($username) == true) {
        $error = true;
        $type = 'error';
        $msg = 'Dieser Username existiert bereits!';
    }

    if($error == false) {
        $success = true;
        $type = 'success';
        $_SESSION['reg_username'] = $username;
        $msg = 'Bitte wähle ein Passwort';
    }
    
    $array = array(
        "type" => $type,
        "msg" => $msg
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);

}

if($status == 22) {
    $password = $_POST['password'];

    if(empty($password)) {
        $error = true;
        $type = "error";

        $msg = 'Bitte gebe ein Passwort ein!';
    }

    if(strlen($password) < 8) {
        $error = true;
        $type = "error";

        $msg = "Dein Passwort muss mindestens 8 Zeichen haben!";
    }

    if($error == false) {
        $success = true;
        $type = "success";

        $_SESSION["reg_password"] = $password;

        $msg = "Bitte wiederhole dein Passwort";
    }

    $array = array(
        "type" => $type,
        "msg" => $msg
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}


if($status == 222) {
    $password = $_POST['password'];

    if(empty($password)) {
        $error = true;
        $type = "error";

        $msg = 'Bitte gebe ein Passwort ein!';
    }

    if($password != $_SESSION['reg_password']) {
        $error = true;
        $type = "error";
        $msg = 'Deine Passwörter stimmen nicht überein!';
    }

    if(!isset($_SESSION['reg_username'])) {
        header('Location: '.$_SITE['path']);
        exit();
    }

    if(!isset($_SESSION['reg_password'])) {
        header('Location: '.$_SITE['path']);
        exit();
    }

    if($error == false) {
        $success = true;
        $type = "success";

        $keypair = sodium_crypto_box_keypair();
        $publicpair = sodium_crypto_box_publickey($keypair);

        $publickey = base64_encode($publicpair);
        $privatekey = base64_encode($keypair);

        User::Add($_SESSION['reg_username'], $password, $publickey);
        $_SESSION["username"] = $_SESSION['reg_username'];

        $msg = $privatekey;
    }

    $array = array(
        "type" => $type,
        "username" => $_SESSION['reg_username'],
        "msg" => $msg
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}

?>