<?php

$url = $GET[1];

if($url == "" OR $url == " ") {
    $url = 'index';
}

if($url != 'index') {
    $cid = $GET[1];
    if($cid == '' OR $cid == ' ' OR Chat::CheckID($cid) == false) {
        header('Location: '.$_SITE['path'].'/chat');
        exit();
    }

    $chat = new Chat($cid);

    if($chat->CheckChat() == false) {
        header('Location: '.$_SITE['path'].'/chat');
        exit();
    }

    if($chat->first == $user->id) {
        $uid = $chat->second;
    } else {
        $uid = $chat->first;
    }
    
    $row = new User($uid);
}

?>