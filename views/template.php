<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/public/css/style.css">
        <link rel="stylesheet" type="text/css" href="/public/css/camera.css">
        <meta charset='utf-8' />
        <title><?= $title ?></title>
    </head>
    <body>
        <header>
            <?php require_once('layout/header.php'); ?>
        </header>
        <div class="view-div">
            <?= $content ?>
        </div>
        <footer>
            <?php require_once('layout/footer.php'); ?>
        </footer>
    </body>
</html>