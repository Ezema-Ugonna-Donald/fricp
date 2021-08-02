<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?= URLROOT ?>/css/lib/fontawesome/css/all.css">
        <link rel="stylesheet" href="<?= URLROOT ?>/css/lib/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?= URLROOT ?>/css/cms/main.css">
        <link rel="icon" href="<?= URLROOT ?>/img/logo/dztechLogo2.png">
        <script src="<?= URLROOT ?>/js/lib/jquery.js"></script>
        <title><?= SITENAME ?></title>
    </head>
    <body>
        <main>
        <?php require_once APPROOT . '\views\inc\cms\navbar.inc.php'; ?>
            <article>
                <div class="page-container">
                    <div class="page-content">
                    <?php require_once APPROOT . '\views\inc\cms\sidebar.inc.php'; ?>