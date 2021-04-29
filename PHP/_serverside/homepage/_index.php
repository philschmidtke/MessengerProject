<?php

//Wenn der User bereits eingeloggt ist
if(isset($_SESSION['username'])) {
    header('Location: '.$_SITE['path'].'/chat');
    exit();
}



?>