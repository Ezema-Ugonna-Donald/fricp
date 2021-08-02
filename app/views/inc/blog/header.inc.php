<?php 
// ini_set ("error_reporting", E_ALL | E_STRICT);
// ini_set ("display_errors", "Off");
// ini_set ("log_errors", "On");
// ini_set ("error_logs", URLROOT . "logs/error_log");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="<?= URLROOT ?>/css/lib/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= URLROOT ?>/css/blog/main.css">
    <script src="<?= URLROOT ?>/js/lib/jquery.js"></script>
    <script src="<?= URLROOT ?>/js/engines/phaser/phaser.min.js"></script>
    <link rel="icon" href="<?= URLROOT ?>/img/logo/fricp.png">
    <title><?= SITENAME ?></title>
</head>
<body>
   <main>
   <?php require_once APPROOT . '\views\inc\blog\navbar.inc.php'; ?>