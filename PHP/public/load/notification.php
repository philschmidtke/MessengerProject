<?php

include '../../inc/config.class.php';
include '../../inc/core.class.php';


if(!isset($_SESSION['username'])) {
    exit();
}

$array = array();
foreach(Friend::getRequest() as $as => $friend) {
   $row = new User($friend->one);
    $array[] = array(
        "id" => (int)$friend->id,
        "username" => $row->username,
        "avatar" => $_SITE['path'].'/public/img/main/'.$row->avatar,
    );

}

header("Content-Type: application/json");
echo json_encode($array, JSON_PRETTY_PRINT);
?>