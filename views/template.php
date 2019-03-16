<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/public/css/style.css">
        <meta charset='utf-8' />
        <title><?= $title ?></title>
    </head>
    <body>
        <header>
            <?php require_once('layout/header.php'); ?>
        </header>
        <?= $content ?>
        <footer>
            <?php require_once('layout/footer.php'); ?>
        </footer>
    </body>
</html>