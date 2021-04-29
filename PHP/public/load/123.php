<?php

$keypair = sodium_crypto_box_keypair();

$key = base64_encode($keypair);

$second = base64_decode($key);

$publicKey = sodium_crypto_box_publickey($second);

$plaintextMessage = "mehmet ist ein kek";


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

echo $decrypted;

