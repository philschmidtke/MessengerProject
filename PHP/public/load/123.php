<?php

//Client Key
$keypair = sodium_crypto_box_keypair();


//Server Key
$publicKey = sodium_crypto_box_publickey($second);

$plaintextMessage = "mehmet ist ein kek";

echo $publicKey;

// ...
$encrypted = sodium_crypto_box_seal(
    $plaintextMessage,
    $publicKey
);

$mytext = base64_encode($encrypted);

$the = base64_decode($mytext);

// ...
$decrypted = sodium_crypto_box_seal_open(
    $the,
    $second
);

