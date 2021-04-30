<?php

include '../../inc/config.class.php';
include '../../inc/core.class.php';

if (!isset($_SESSION['username'])) {
    exit();
}


$type = $_POST['type'];

if ($type == 'resetkey') {

    $keypair = sodium_crypto_box_keypair();
    $publicpair = sodium_crypto_box_publickey($keypair);

    $publickey = base64_encode($publicpair);
    $privatekey = base64_encode($keypair);

    $user->Update('pubkey', $publickey);
    
    $i = 0;
    foreach(Chat::GetAll() as $as => $chat) {
        
       if($chat->first == $user->id) {
           $row = new User($chat->second);
       } else {
           $row = new User($chat->first);
       }
       
       $message = Message::Encrypt("Sicherheitscode geändert", $row->pubkey);
       $message2 = Message::Encrypt("Sicherheitscode geändert", $user->pubkey);
       
        Message::Add($chat->id, 1,  base64_encode($message), base64_encode($message2));
        $i++;
    }

    $array = array(
        "key" => $privatekey,
        "count" => $i
    );

    header("Content-Type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);

}
?>