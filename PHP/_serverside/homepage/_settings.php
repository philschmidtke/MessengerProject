<?php

//Passwort ändern
if (isset($_POST['submit'])) {
    $old = $_POST['old'];
    $new = $_POST['new'];
    $wdh = $_POST['wdh'];


    if (empty($old) or empty($new) or empty($wdh)) {
        $error = true;
        $msg = 'Bitte fülle alles aus!';
    }

    if ($new != $wdh) {
        $error = true;
        $msg = 'Die Passwörter stimmen nicht überein!';
    }

    if (User::Check($user->username, $old) == false) {
        $error = true;
        $msg = 'Dein Passwort ist falsch!';
    }

    if (strlen($new) < 8) {
        $error = true;
        $msg = 'Dein Passwort muss mindestens 8 Zeichen lang sein!';
    }

    if ($error == false) {
        $user->Update("password", $new);

        $success = true;
        $msg = 'Erfolgreich geändert!';
    }
}


//Profilbild ändern
if (isset($_POST['upload'])) {
    $time = time();
    $filename = $user->id . '_' . $time;

    if($_FILES['file']['name'] == "") {
        $error = true;
        $msg = 'Bitte wähle ein Bild!';
    }

    $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
    $allowed_extensions = array('png', 'jpg', 'jpeg');

    if (!in_array($extension, $allowed_extensions)) {
        $error = true;
        $msg = 'Ungültiges Dateiformat';
    }


    if ($error == false) {
        $upload_folder = './public/img/main/';
        $name = $filename . '.' . $extension;
        $new_path = $upload_folder . $name;
        move_uploaded_file($_FILES['file']['tmp_name'], $new_path);

        $user->Update('avatar', $name);

        $success = true;
        $msg = 'Erfolgreich hochgeladen';
    }
}
?>