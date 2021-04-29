<?php
if (!isset($_SESSION['username'])) {

    header('Location: ' . $_SITE['path'] . '/index');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">


    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <?php include('./inc/template/homepage/style.php'); ?>

    <title><?php echo $_SITE['name'] ?></title>
</head>

<div class="container">
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <nav>
                <a href="<?php echo $_SITE['path'] ?>/chat">
                    <i class="fas fa-home"></i>
                </a>
                <a style="color:white;cursor:pointer;" data-bs-toggle="modal" data-bs-target="#notification">
                    <i class="fas fa-bell"></i>
                    <span class="badge bg-dark" style="font-size:10px;" id="count_notification">0</span>
                </a>
                
                <a href="<?php echo $_SITE['path'] ?>/logout" style="float:right;margin-right:0px;margin-left:20px;">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
                <a href="<?php echo $_SITE['path'] ?>/settings" style="float:right;margin-right:0px;margin-left:20px;">
                    <i class="fas fa-cog"></i>
                </a>
            </nav>
        </div>
    </div>
</div>