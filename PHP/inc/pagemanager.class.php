<?php

$GET = explode("/", $_GET['page']);

if ($GET[0] == '')
    $GET[0] = 'index';

if ($GET[0] == 'acp' AND $GET[1] == '')
    $GET[1] = 'index';



switch ($GET[0]) {
    case 'logout':
        session_start();
        session_destroy();
        header('Location:' . $_SITE['path'] . '/index');
        exit;
    break;

    case '404':
      header('Location:' . $_SITE['path'] . '/index');
      exit;
    break;
    case 'acp':
        $pagename = $GET[1];
        $folder = 'acp';
        break;

    default:
        $pagename = $GET[0];
        $folder = 'homepage';
        break;
}


$check_page = $mysqli->query("SELECT * FROM hp_pages WHERE link = '" . $pagename . "' AND content = '" . $folder . "' ");
if ($check_page->num_rows > 0) {
    $page = $check_page->fetch_object();

    if (!file_exists('./_files/' . $page->content . '/_' . $page->name . '.php')) {
        $pagename = '404';
        $folder = 'homepage';
    }
} else {
    $pagename = '404';
    $folder = 'homepage';
}

include('./_serverside/' . $folder . '/_' . $pagename . '.php'); //Included den PHP Teil

if ($page->header == 1) {
    include('./inc/template/' . $folder . '/header.php'); //Included den Header
}

include('./_files/' . $folder . '/_' . $pagename . '.php'); //Included den Seiteninhalt

if ($page->header == 1) {
    include('./inc/template/' . $folder . '/footer.php'); //Included den Footer
}


?>
