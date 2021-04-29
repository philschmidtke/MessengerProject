<?php


include '../../inc/config.class.php';
include '../../inc/core.class.php';


$type = $_POST['type'];


if ($type == 'all') {
    $username = $_POST['username'];

    $array = array();

    //Alle User abrufen
    foreach (User::GetAll($username) as $as => $row) {
        if (Friend::Check($user->id, $row->id) == false) {
            $status = 0;
        } else {
            $friend = new Friend(Friend::GetID($user->id, $row->id));

            $status = $friend->status;
        }
        $array[] = array(
            "id" => (int)$row->id,
            "username" => $row->username,
            "avatar" => $row->avatar,
            "status" => (int)$status,
        );
    }

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}


if ($type == 'add') {
    $id = $_POST['id'];

    if (User::CheckID($id) == false) {
        $error = true;
        $msg = 'Dieser User existiert nicht!';
    }

    if ($user->id == $id) {
        $error = true;
        $msg = 'Du kannst dir keine Freundschaftsanfrage senden!';
    }

    if (Friend::Check($user->id, $id) == true) {
        $error = true;
        $msg = 'Du hast diesem User bereits eine Freundschaftsanfrage gesendet!';
    }

    if ($error == false) {
        Friend::Add($user->id, $id);

        $success = true;
        $msg = 'Erfolgreich gesendet!';
    }

    if ($error == true) {
        $type = 'error';
    } elseif ($success == true) {
        $type = 'success';
    }

    $array = array(
        "type" => $type,
        "msg" => $msg
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}


if ($type == 'remove') {
    $id = $_POST['id'];

    if (User::CheckID($id) == false) {
        $error = true;
        $msg = 'Dieser User existiert nicht!';
    }

    if ($user->id == $id) {
        $error = true;
        $msg = 'ERROR';
    }

    if (Friend::Check($user->id, $id) == false) {
        $error = true;
        $msg = 'Du bist mit diesen User nicht befreundet!';
    }

    $friend = new Friend(Friend::GetID($user->id, $id));

    if ($friend->status == 1) {
        $error = true;
        $msg = 'Du kannst eine Freundschaftsanfrage nicht abbrechen';
    }

    if ($error == false) {
        $friend->Delete();

        $success = true;
        $msg = 'Erfolgreich gelöscht!';
    }

    if ($error == true) {
        $type = 'error';
    } elseif ($success == true) {
        $type = 'success';
    }

    $array = array(
        "type" => $type,
        "msg" => $msg
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}


if ($type == 'accept_friend') {
    $id = $_POST['id'];

    if (Friend::CheckID($id) == false) {
        $error = true;
        $msg = 'Fehler!';
    }

    $friend = new Friend($id);

    if ($friend->two != $user->id) {
        $error = true;
        $msg = 'Fehler!';
    }

    if ($friend->status != 1) {
        $error = true;
        $msg = 'Fehler!';
    }

    if ($error == false) {
        $friend->Update('status', 2);

        $success = true;
        $msg = 'Erfolg';
    }

    if ($error == true) {
        $type = 'error';
    } elseif ($success == true) {
        $type = 'success';
    }

    $array = array(
        "type" => $type,
        "msg" => $msg
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}

if ($type == 'decline_friend') {
    $id = $_POST['id'];

    if (Friend::CheckID($id) == false) {
        $error = true;
        $msg = 'Fehler!';
    }

    $friend = new Friend($id);

    if ($friend->two != $user->id) {
        $error = true;
        $msg = 'Fehler!';
    }

    if ($friend->status != 1) {
        $error = true;
        $msg = 'Fehler!';
    }

    if ($error == false) {
        $friend->Delete();

        $success = true;
        $msg = 'Erfolg';
    }

    if ($error == true) {
        $type = 'error';
    } elseif ($success == true) {
        $type = 'success';
    }

    $array = array(
        "type" => $type,
        "msg" => $msg
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}
