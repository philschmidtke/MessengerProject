<?php


include '../../inc/config.class.php';
include '../../inc/core.class.php';

if (!isset($_SESSION['username'])) {
    exit();
}


$type = $_POST['type'];


if ($type == 'create') {
    $id = $_POST['id'];

    if (User::CheckID($id) == false) {
        $error = true;
        $msg = 'Dieser User existiert nicht!';
    }

    if (Friend::Check($user->id, $id) == false) {
        $error = true;
        $msg = 'Du bist mit diesem User nicht befreundet!';
    }

    if ($error == false) {
        if (Chat::Check($id) == true) {
            $chat = new Chat(Chat::GetID($id));

            $array = array(
                "id" => $chat->id
            );

            header("Content-Type: application/json");
            echo json_encode($array, JSON_PRETTY_PRINT);
        } else {
            Chat::Create($id);
            $chat = new Chat(Chat::GetID($id));

            Message::Add($chat->id, '0', "Hinzugefuegt!");

            $array = array(
                "id" => $chat->id
            );

            header("Content-Type: application/json");
            echo json_encode($array, JSON_PRETTY_PRINT);
        }
    }
}


if($type == 'getlist') {

    $array = array();

    foreach(Chat::GetAll() as $as => $chat) {
        $message = Message::GetLastMessage($chat->id);

        if($chat->first == $user->id) {
            $row = new User($chat->second);
        } else {
            $row = new User($chat->first);
        }

        $array[] = array(
            "id" => (int) $chat->id,
            "avatar" => $row->avatar,
            "username" => $row->username,
            "message" => $message 
        );
    }

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);

}