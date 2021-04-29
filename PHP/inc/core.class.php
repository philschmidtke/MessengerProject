<?php

//CORE

ini_set('max_execution_time', 5);
//error_reporting(0);
session_start();
date_default_timezone_set("Europe/Berlin");
header('Content-Type: text/html; charset=UTF-8');
header("X-XSS-Protection: 1; mode=block");


function protect($string, $output = false) {
    $string = str_replace("'", "", $string);
    $string = str_replace("alert(", "", $string);
    $string = str_replace("prompt(", "", $string);
    $string = str_replace("/*", "", $string);
    $string = str_replace("document.cookie", "", $string);
    $string = str_replace('document["cookie"]', '', $string);
    $string = str_replace('window["alert"', '', $string);

    $string = strip_tags($string);

    return $string;
}

if ($_POST) {
    foreach ($_POST as $key => $val) {
        if ($key == 'password' OR $key == 'key') {

        } else {
            $_POST[$key] = $mysqli->real_escape_string(protect(htmlspecialchars($val)));
        }
    }
}

if ($_GET) {
    foreach ($_GET as $key => $val) {
            $_GET[$key] = $mysqli->real_escape_string(protect(htmlspecialchars($val)));
    }
}
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php';
});


if(isset($_SESSION['username'])) {
    $user = new User(User::GetID($_SESSION['username']));
}
