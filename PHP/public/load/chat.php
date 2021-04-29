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

            Message::Add($chat->id, '0', "Hinzugefuegt!", "Hinzugefuegt!");

            $array = array(
                "id" => $chat->id
            );

            header("Content-Type: application/json");
            echo json_encode($array, JSON_PRETTY_PRINT);
        }
    }
}


if ($type == 'getlist') {

    $array = array();

    foreach (Chat::GetAll() as $as => $chat) {
        $message = Message::GetLastMessage($chat->id);

        if ($chat->first == $user->id) {
            $row = new User($chat->second);
        } else {
            $row = new User($chat->first);
        }

        $array[] = array(
            "id" => (int) $chat->id,
            "avatar" => $row->avatar,
            "username" => $row->username,
            "message" => date('d.m.Y H:i', $message)
        );
    }

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}


if ($type == "send") {
    $chat = $_POST['chat'];
    $text = $_POST['message'];

    if (empty($text)) {
        $error = true;
        $msg = 'Bitte gebe einen Text ein!';
    }

    if (Chat::CheckID($chat) == false) {
        $error = true;
        $msg = 'Chat existiert nicht!';
    }

    $chat = new Chat($chat);

    if ($chat->first != $user->id and $chat->second != $user->id) {
        $error = true;
        $msg = 'Keine Berechtigung';
    }

    if ($error == false) {
        if ($chat->first == $user->id) {
            $row = new User($chat->second);
        } else {
            $row = new User($chat->first);
        }

        $message1 = Message::Encrypt($text, $row->pubkey);
        $message2 = Message::Encrypt($text, $user->pubkey);



        Message::Add($chat->id, 1, base64_encode($message1), base64_encode($message2));

        $success = true;
        $msg = 'Erfolg';
    }

    $time = date('d.m.Y H:i', time());

    if ($error == true) {
        $status = 'error';
    } elseif ($success == true) {
        $status = 'success';
    }

    $array = array(
        "type" => $status,
        "time" => $time,
        "msg" => $msg
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}
